<?php

/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Controllers\Imet;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use ImetCore\Controllers\__Controller;
use ImetCore\Controllers\Imet\Traits\Backup;
use ImetCore\Controllers\Imet\Traits\ConvertSQLite;
use ImetCore\Controllers\Imet\Traits\ImportExportJSON;
use ImetCore\Controllers\Imet\Traits\Merge;
use ImetCore\Controllers\Imet\Traits\Pame;
use ImetCore\Models\Imet\Imet;
use ModularForms\Helpers\HTTP;

use Throwable;
use function view;

abstract class Controller extends __Controller
{
    use Backup;
    use ConvertSQLite;
    use ImportExportJSON;
    use Merge;
    use Pame;

    public const ROUTE_PREFIX = 'imet-core::';

    protected static ?string $form_class = Imet::class;

    protected static ?string $form_view_prefix = 'imet-core::';

    protected const bool PAGINATE = false;

    public const array sanitization_rules = [
        'search' => 'custom_text|nullable',
        'year' => 'digits:4|integer|nullable',
        'country' => 'min:3|max:3|alpha|nullable',
    ];

    /**
     * Override index route
     * @throws Throwable
     */
    #[\Override]
    public function index(Request $request): View
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, static::sanitization_rules);

        // set filter status
        $filter_selected = filled(array_filter($request->except('_token')));

        /** @var class-string<Imet> $form_class */
        $form_class = static::$form_class;

        // retrieve IMET list
        $filtered_list = $form_class::get_assessments_list_with_extras($request);
        $full_list = $form_class::get_assessments_list(new Request, ['country']);
        $years = $full_list->pluck('Year')->sort()->unique()->values()->toArray();
        $countries = $full_list->pluck('country.name', 'country.iso3')->sort()->unique()->toArray();

        return view(Controller::$form_view_prefix.'list', [
            'controller' => static::class,
            'list' => $filtered_list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => $countries,
            'years' => $years,
            'index_url' => URL::route(static::ROUTE_PREFIX.'index'),
        ]);
    }

    /**
     * Manage "destroy" route
     *
     * @throws AuthorizationException
     */
    #[\Override]
    public function destroy($item): RedirectResponse
    {
        $this->authorize('destroy', (static::$form_class)::find($item));
        $form = new static::$form_class;
        $form = $form->find($item);
        $form->delete();

        return to_route(static::ROUTE_PREFIX.'index');
    }
}
