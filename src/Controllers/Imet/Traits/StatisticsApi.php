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

use ImetCore\Models\Country;
use ImetCore\Models\Imet\API\Statistics\GlobalStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use function abort;

trait StatisticsApi
{

    /**
     * @param string|null $year
     */
    public function get_global_statistics(Request $request, string $lang, string $slug): object
    {
        $api = [];
        $type = $request->input("type");
        $year = $request->input("year");
        $country = $request->input("country");
        $version = $request->input("version");
        $region = $request->input("region");

        if($region){
            $country = Country::getByRegion($region);
        } else {
            $country = [$country];
        }

        App::setLocale($lang);
        $slug = str_replace('-', '_', $slug);
        $func = "get_" . $slug;
        if (method_exists(GlobalStatistics::class, $func)) {
            $form_ids = GlobalStatistics::from_year_get_form_ids($request, $year, $version, $country, $type);
            if (in_array($func, ['get_assessments_performed_by_country', 'get_pas_rating'])) {
                $api = GlobalStatistics::$func($form_ids, $lang);
            } else {
                $api = GlobalStatistics::$func($form_ids);
            }

        } else {
            abort(404, trans('imet-core::api.error_messages.page_not_found'));
        }

        return static::sendAPIResponse( $api);
    }




}
