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

use Illuminate\Support\Facades\Date;
use ImetCore\Models\Imet\Imet;
use ImetCore\Models\ProtectedArea;
use ModularForms\Models\Traits\Payload;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

trait Prefill
{
    /**
     * Retrieve existing previous forms
     *
     * @throws AuthorizationException
     */
    public function retrieve_prev_years(Request $request): Collection
    {
        $this->authorize('edit', static::$form_class);

        $year = $request->input('year');

        if($year === null){
            return collect([]);
        }
        $wdpa_id = ProtectedArea::getByWdpa($request->input('wdpa_id'))->wdpa_id;
        return (static::$form_class)::select(['FormID','Year','wdpa_id'])
            ->where('wdpa_id', $wdpa_id)
            ->where('version', Imet::IMET_V2)
            ->where('Year', '<', $year)
            ->orderByDesc('Year')
            ->get()
            ->pluck('Year', 'FormID');
    }

    /**
     * Store a prefilled IMET (data retrieved from a previous year)
     *
     * @param $prev_year_selection
     * @throws FileNotFoundException|Exception
     */
    private function store_prefilled(Request $request, $prev_year_selection): array
    {
        $records = Payload::decode($request->input('records_json'));

        $records[0]['language'] = null;
        $json = static::export((static::$form_class)::find($prev_year_selection), false, false);
        $json['Imet']['Year'] = $records[0]['Year'];
        $json['Imet']['UpdateDate'] = Date::now()->format('Y-m-d H:i:s');

        DB::beginTransaction();

        try {

            [$formID, $_] = static::import_modules($json, false);
            DB::commit();

            Session::flash('message', trans('modular-forms::common.saved_successfully'));
            return [
                'status' => 'success',
                'entity_label' => (static::$form_class)::find($formID)->{(static::$form_class)::LABEL},
                'edit_url' => action([static::class, 'edit'], ['item' => $formID])

            ];
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('message', trans('modular-forms::common.saved_error'));
            throw $e;
        }
    }

}
