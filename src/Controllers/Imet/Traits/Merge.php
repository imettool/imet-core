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

namespace ImetCore\Controllers\Imet\Traits;

use ImetCore\Controllers\Imet\Controller;
use ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\View\View;
use function redirect;


trait Merge
{
    /**
     * Open the merge tool view
     *
     * @param $item
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function merge_view($item)
    {
        $form = (static::$form_class)::find($item);
        $this->authorize('edit', $form);

        return view(Controller::$form_view_prefix . '.merge.list', [
            'controller' => static::class,
            'primary_form' => $form,
            'duplicated_forms' => $form->getDuplicates()
        ]);
    }

    /**
     * Execute the merge of the given module
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function merge(Request $request): RedirectResponse
    {
        $module_class = $request->input('module');
        $source_form_id = $request->input('source_form');
        $destination_form_id = $request->input('destination_form');

        $records = $module_class::exportModule($source_form_id);
        $records = array_map(function ($item) use ($module_class, $destination_form_id) {
            $item[(new $module_class())->getKeyName()] = null;
            $item[$module_class::$foreign_key] = $destination_form_id;
            return $item;
        }, $records);

        $request = new Request();
        $request->merge(['records_json' => Payload::encode($records)]);
        $request->merge(['form_id' => $destination_form_id]);

        $module_class::updateModule($request);

        return redirect()->route($this::ROUTE_PREFIX.'merge_view', ['item' => $destination_form_id]);
    }
}