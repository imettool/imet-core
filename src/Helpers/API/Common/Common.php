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

namespace ImetCore\Helpers\API\Common;

use ErrorException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use ImetCore\Controllers\Imet\ApiController;
use ImetCore\Models\Imet\oecm\Imet as ImetOecm;
use ImetCore\Models\Imet\v2\Imet;
use Throwable;

class Common
{
    private static int $max_id = 999999999;

    /**
     * @throws Throwable
     */
    private static function validate_wdpa(Request $request)
    {
        $year = Date::now()->format('Y');
        $max_wdpa_id = static::$max_id;
        $wdpa_size = '';

        if (strpos($request->path(), '/scaling-up/')) {
            $wdpa_size = '|min:2|max:15';
        }

        if (strpos($request->path(), '/details/')) {
            $wdpa_size = '|max:1';
        }

        $parameters = [
            'wdpa_id' => explode(',', $request->route('wdpa_id', null)),
            'years' => explode(',', $request->route('year', null)),
            'lang' => $request->route('lang', 'en'),
        ];

        $wdpa_ids_params_size = count($parameters['wdpa_id']);
        $years_params_size = count($parameters['years']);
        throw_if($years_params_size > 1 && $wdpa_ids_params_size !== $years_params_size, ErrorException::class, trans('imet-core::api.error_messages.mismatch_wdpa_ids_years'));

        $rules = [
            'wdpa_id' => 'required|array'.$wdpa_size,
            'wdpa_id.*' => 'required|integer|max:'.$max_wdpa_id,
            'years' => 'array',
            'years.*' => 'integer|max:'.$year,
            'lang' => ['required',
                Rule::in(['en', 'fr', 'pt', 'es']),
            ],
        ];

        return Validator::make($parameters, $rules);
    }

    /**
     * @throws ErrorException
     */
    private static function validate_group(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $year = Date::now()->format('Y');
        $parameters = [];
        $rules = [];
        $max_wdpa_id = static::$max_id;

        $parameters['lang'] = $request->route('lang', 'en');
        $rules['lang'] = ['required',
            Rule::in(['en', 'fr', 'pt', 'es']),
        ];

        for ($i = 1; $i < 10; $i++) {
            $key_group = 'group_'.$i;
            $key_year = 'years_'.$i;

            if ($request->get($key_group, null)) {
                $parameters[$key_group] = explode(',', (string) $request->get($key_group, null));
                $rules[$key_group] = 'required|array';
                $rules[$key_group.'.*'] = 'integer|max:'.$max_wdpa_id;
            }

            if ($request->get($key_year, null)) {
                $parameters[$key_year] = explode(',', (string) $request->get($key_year, null));
                $rules[$key_year] = 'array';
                $rules[$key_year.'.*'] = 'integer|max:'.$year;
            }

            if (isset($parameters[$key_group]) && isset($parameters[$key_year])) {
                $group_ids_params_size = count($parameters[$key_group]);
                $years_params_size = count($parameters[$key_year]);
                throw_if($years_params_size > 1 && $group_ids_params_size !== $years_params_size, ErrorException::class, trans('imet-core::api.error_messages.mismatch_group_ids_years'));
            }
        }

        return Validator::make($parameters, $rules);
    }

    /**
     * @throws ErrorException
     */
    public static function validateQuerystring(Request $request): array
    {
        $response = ['type' => '', 'errors' => ''];
        $errors = [];

        if (strpos($request->path(), '/groups/')) {
            $validator = static::validate_group($request);
            $response['type'] = 'group';
        } else {
            $validator = static::validate_wdpa($request);
        }

        if ($validator->fails()) {
            $messages = $validator->messages()->toArray();
            foreach ($messages as $message) {

                $errors[] = $message[0];
            }
        }

        $response['errors'] = implode(' and ', $errors);

        return $response;
    }

    /**
     * @return array[]
     *
     * @throws ErrorException
     */
    private static function get_querystring_values(Request $request): array
    {
        $years = [];
        $key = '';
        $wdpa_ids = [];
        $query_wdpa_ids = $request->route('wdpa_id', null);
        $query_form_id = $request->route('form_id', null);
        $query_years = $request->route('year', null);
        $query_key = $request->route('key', null);

        if ($query_wdpa_ids) {
            $wdpa_ids = explode(',', $query_wdpa_ids);
        } else {
            throw new ErrorException(trans('imet-core::api.error_messages.wdpa_ids_missing'));
        }

        if ($query_key && stripos($query_key, 'imet__'.\ImetCore\Models\Imet\Imet::IMET_V2.'__') > -1) {
            $key = \ImetCore\Models\Imet\Imet::IMET_V2;
        } elseif ($query_key && stripos($query_key, 'imet__'.\ImetCore\Models\Imet\Imet::IMET_V1.'__') > -1) {
            $key = \ImetCore\Models\Imet\Imet::IMET_V1;
        } elseif ($query_key && stripos($query_key, 'imet__'.\ImetCore\Models\Imet\Imet::IMET_OECM.'__') > -1) {
            $key = \ImetCore\Models\Imet\Imet::IMET_OECM;
        }

        if ($query_years) {
            $years = explode(',', $query_years);
        }

        return [$wdpa_ids, $years, $key, $query_form_id];
    }

    /**
     * @throws ErrorException
     */
    public static function wdpa_id_and_year_to_form_id(Request $request, array $ids = [], array $years = [], string $key = ''): Collection
    {
        $fields = ['FormID', 'Year', 'wdpa_id', 'Country', 'version', 'name'];
        if ($ids === []) {
            [$ids, $years, $key, $form_id] = static::get_querystring_values($request);
        }

        // form_id means oecm
        $ids = $form_id ?? $ids;

        $years_size = count($years);
        if ($years_size === 0) {
            return static::getRecordsByWdpaID($fields, $ids, $key);
        }

        if ($years_size === 1) {
            return static::getRecordsByWdpaIDAndSingleYear($fields, $ids, $key, $years);
        }

        return static::getRecordByWdpaIdsAndYears($fields, $ids, $key, $years);
    }

    private static function getRecordsByWdpaID(array $fields, array $ids, string $key): Collection
    {
        $ids_size = count($ids);
        if ($key === Imet::IMET_OECM) {
            $records = ImetOecm::query()->select($fields)->whereIn('FormID', $ids);
        } else {
            $records = Imet::query()->select($fields)->whereIn('wdpa_id', $ids);
        }

        if ($key !== '' && $key !== '0') {
            $records = $records->where(['version' => $key]);
        }

        $records = $records->get();
        static::checkIfRequestedPAHaveImetRecords($ids_size, $records->count());

        return $records;
    }

    /**
     * @return Imet[]|Collection
     */
    private static function getRecordsByWdpaIDAndSingleYear(array $fields, array $ids, string $key, array $years): Collection
    {
        $ids_size = count($ids);
        if ($key === Imet::IMET_OECM) {
            $records = ImetOecm::query()->select($fields)->whereIn('FormID', $ids)->where('Year', $years[0]);
        } else {
            $records = Imet::query()->select($fields)->whereIn('wdpa_id', $ids)->where('Year', $years[0]);
        }

        if ($key !== '' && $key !== '0') {
            $records = $records->where(['version' => $key]);
        }

        $records = $records->get();
        static::checkIfRequestedPAHaveImetRecords($ids_size, $records->count());

        return $records;
    }

    /**
     * @throws ErrorException
     */
    private static function getRecordByWdpaIdsAndYears(array $fields, array $ids, string $key, array $years): Collection
    {
        $ids_size = count($ids);
        $keys_not_match = [];
        $collection = new Collection;

        foreach ($ids as $ikey => $id) {
            if ($key === Imet::IMET_OECM) {
                $record = ImetOecm::query()->select($fields)->whereIn('FormID', $id)->where('Year', $years[$ikey]);
            } else {
                $record = Imet::query()->select($fields)->where('wdpa_id', $id)->where('Year', $years[$ikey]);
            }

            if ($key !== '' && $key !== '0') {
                $record = $record->where(['version' => $key]);
            }

            $record = $record->first();
            if ($record) {
                $collection->add($record);
            } else {
                $keys_not_match[] = str_replace('{1}', $years[$ikey], str_replace('{0}', $id, trans('imet-core::api.error_messages.ids_and_years')));
            }
        }

        static::checkIfRequestedPAHaveImetRecords($ids_size, $collection->count());

        if ($keys_not_match === []) {
            return $collection;
        }

        throw new ErrorException(trans('imet-core::api.error_messages.no_combination_found').implode(',', $keys_not_match));
    }

    private static function checkIfRequestedPAHaveImetRecords(int $requested, int $exists): void
    {
        if ($requested > 0 && $requested < $exists) {
            ApiController::sendAPIError(404, trans('imet-core::api.error_messages.more_than_one_protected_areas_found'));
        }

        if ($requested !== $exists) {
            ApiController::sendAPIError(404, trans('imet-core::api.error_messages.no_protected_areas_found'));
        }
    }

    public static function retrieve_form_ids($items): array
    {

        $records = [];
        $form_ids = [];
        foreach ($items as $item) {
            $form_ids[] = $item->FormID;
            $records[$item->wdpa_id] = $item->toArray();
        }

        if ($form_ids === []) {
            ApiController::sendAPIError(404, trans('imet-core::api.error_messages.no_protected_areas_found'));
        }

        return [$form_ids, $records];
    }

    /**
     * @throws ErrorException
     */
    public static function group_items(Request $request): array
    {
        $query = $request->collect()->all();
        $items = [];
        $group = 1;
        $records = [];

        foreach ($query as $k => $item) {
            if (str_contains((string) $k, 'group_')) {
                $years = [];
                $keys = explode('_', (string) $k);
                $years_keys = $request->get('years_'.$keys[1]);
                if ($years_keys) {
                    $years = explode(',', (string) $years_keys);
                }

                $ids = explode(',', (string) $item);

                $records = Common::wdpa_id_and_year_to_form_id($request, $ids, $years);

                foreach ($records as $record) {
                    $items[] = [
                        'id' => (int) $record->FormID,
                        'group' => $group,
                        'name' => 'Group '.$group,
                    ];
                }

                $group++;
            }
        }

        return [$items, $records];
    }

    public static function add_fields_to_response(array $response, array $records): array
    {
        foreach ($response['data'] as $k => $items) {
            if (isset($records[$items['wdpa_id']])) {
                $response['data'][$k]['year'] = $records[$items['wdpa_id']]['Year'];
            }
        }

        return $response;
    }
}
