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

use Exception;
use ImetCore\Models\Imet\v2\Modules\Context\GeneralInfo as V2GeneralInfo;
use ImetCore\Models\Imet\oecm\Modules\Context\GeneralInfo as OecmGeneralInfo;
use ImetCore\Models\Imet\v2\Imet;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ModularForms\Helpers\Input\SelectionList;
use ModularForms\Models\Traits\Payload;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Throwable;

use function view;

trait CreateAndStoreNonWdpa
{
    /**
     * Manage "create" route
     *
     * @throws AuthorizationException
     */
    public function create_non_wdpa(): View
    {
        $this->authorize('create', static::$form_class);

        return view(static::$form_view_prefix . '.create', ['is_wdpa' => false]);
    }

    /**
     *  Override:
     * - create prefilled IMET
     * - create IMET on non-WDPA site
     *
     * @throws AuthorizationException|Throwable
     */
    public function store(Request $request): View|array
    {
        $this->authorize('create', static::$form_class);

        $records = Payload::decode($request->input('records_json'));

        // #### Create a prefilled IMET (data from a previous year) ####
        if(array_key_exists('prev_year_selection', $records[0])){
            $prev_year_selection = $records[0]['prev_year_selection'] ?? null;
            unset($records[0]['prev_year_selection']);
            $request->merge(['records_json' => Payload::encode($records)]);
            if($prev_year_selection!==null && $prev_year_selection!=='no_import'){
                return $this->store_prefilled($request, $prev_year_selection);
            }
        }
        // #### Create an IMET on a non-WDPA site ####
        if(array_key_exists('name', $records[0])){
            return $this->store_non_wdpa($request);
        }

        return static::redirect_to_edit($request);
    }

    /**
     * Manage "store" route
     *
     * @throws Exception
     */
    private function store_non_wdpa(Request $request): array
    {
        $records = Payload::decode($request->input('records_json'));

        try {

            // Create new non-WDPA pa
            $nonWdpa_record = collect($records[0])
                ->except(['version', 'Year', 'language', 'FormID', 'UpdateDate', 'UpdateBy'])
                ->toArray();
            $nonWdpa_record['id'] = ProtectedAreaNonWdpa::generate_fake_wdpa();
            $new_pa = new ProtectedAreaNonWdpa();
            $new_pa->fill($nonWdpa_record);
            $new_pa->save();

            // Create Form
            $form_record = collect($records[0])
                ->only(['name', 'version', 'Year', 'language', 'FormID', 'UpdateDate', 'UpdateBy'])
                ->toArray();
            $form_record['wdpa_id'] = $new_pa->getKey();
            $form_record['Country'] = $records[0]['country'];
            $form_record['version'] = (static::$form_class)::version;
            $form_record = array_filter($form_record);
            $request->merge(['records_json' => Payload::encode([$form_record])]);

            return static::redirect_to_edit_non_wdpa($request);

        } catch (Exception $e) {
            Session::flash('message', trans('modular-forms::common.saved_error'));
            throw $e;
        }
    }

    private static function redirect_to_edit($request): array
    {
        $form = new static::$form_class();
        $result = $form->store($request);

        if($result['status'] === 'success'){
            $result['entity_label'] = $form::find($result['entity_id'])->{$form::LABEL};
            $result['edit_url'] = route(static::ROUTE_PREFIX. 'context_edit', ['item' => $result['entity_id']]);
        }
        return $result;
    }

    private static function redirect_to_edit_non_wdpa($request): array
    {
        $records = Payload::decode($request->input('records_json'));
        $form = new static::$form_class();
        $result = $form->store($request);

        $form_id = $form->getKey();
        $non_wdpa_id = Payload::decode($request->input('records_json'))[0]['wdpa_id'];
        $non_wdpa = ProtectedAreaNonWdpa::find($non_wdpa_id);

        if($records[0]['version'] == Imet::version){
            V2GeneralInfo::create([
                'FormID' => $form_id,
                'CompleteName' => $non_wdpa->name,
                'Country' => $non_wdpa->country,
                'CreationYear' => $non_wdpa->status_year
            ]);
        } else {
            OecmGeneralInfo::create([
                'FormID' => $form_id,
                'CompleteName' => $non_wdpa->name,
                'Country' => $non_wdpa->country,
                'Ownership' => SelectionList::getList('ImetV2_OwnershipType')[$non_wdpa->ownership_type],
                'CreationYear' => $non_wdpa->status_year
            ]);
        }

        if($result['status'] === 'success'){
            $result['entity_label'] = $form::find($result['entity_id'])->{$form::LABEL};
            $result['edit_url'] = route(static::ROUTE_PREFIX. 'context_edit', ['item' => $result['entity_id']]);
        }
        return $result;
    }

}
