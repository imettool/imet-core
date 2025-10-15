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
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use ImetCore\Models\Imet\Imet;
use ReflectionException;

use function view;

/**
 * @method array __retrieve_report_data(Imet $imet)
 */
abstract class ReportController extends Controller
{
    /**
     * Manage "report" edit route
     *
     * @throws AuthorizationException
     */
    public function report(int $item): Factory|View
    {
        $imet = (static::$form_class)::find($item);

        $this->authorize('edit', $imet);

        return view(static::$form_view_prefix.'.edit', $this->__retrieve_report_data($imet));
    }

    /**
     * Manage "report" edit route
     *
     * @throws AuthorizationException
     * @throws ReflectionException
     */
    public function report_show(int $item): Factory|View
    {
        $imet = (static::$form_class)::find($item);

        $this->authorize('view', $imet);

        return view(static::$form_view_prefix.'.show', $this->__retrieve_report_data($imet));
    }

    /**
     * Manage "report" update route
     *
     * @throws AuthorizationException
     */
    public function report_update(int $item, Request $request): array
    {
        $this->authorize('edit', (static::$form_class)::find($item));

        \ImetCore\Models\Imet\v1\Report::updateByForm($item, $request->input('report'));

        return ['status' => 'success'];
    }
}
