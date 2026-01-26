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

namespace ImetCore\Models\Imet\ScalingUp\Analysis;

use Exception;
use ImetCore\Helpers\ScalingUp\Common;
use ImetCore\Models\Country;
use ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use ImetCore\Models\Imet\v2\Modules;

/**
 * Handles protected area related analysis
 */
final class ProtectedAreaAnalysis extends BaseAnalysis
{
    public static string $template = 'protected_areas';

    public static string $title = 'imet-core::analysis_report.sections.list_of_names';

    public static string $exclude_elements = '';

    public static string $code = '0';

    public static string $info_label = 'imet-core::analysis_report.guidance.list_of_pas';

    /**
     * Get the protected area country
     *
     * @throws Exception
     */
    public static function getProtectedAreaWithCountries(array $form_ids): array
    {
        $items = [];
        foreach ($form_ids as $k => $form_id) {
            $pa = ScalingUpWdpa::getCustomNames($form_id, self::$scaling_id);
            $items[$k] = $pa->toArray();
            $items[$k]['Country_name'] = Country::getByISO($pa['Country']);
        }
        uasort($items, fn (array $a, array $b): int => strnatcmp((string) $a['name'], (string) $b['name']));

        return self::successResponse($items);
    }

    /**
     * Get protected area custom names with all the information
     */
    public static function getProtectedArea(array $form_ids, bool $show_original_names = false): array
    {
        $protected_area = [];
        $categories = [];

        foreach ($form_ids as $form_id) {
            $protected_area[$form_id] = Common::protected_areas_duplicate_fixes($form_id, $show_original_names);
            $general_info = Modules\Context\GeneralInfo::getModuleRecords($form_id);
            if ($general_info['records'][0]) {
                $categories[$form_id] = Common::get_category_of_protected_area($general_info['records'][0]);
            }
        }

        return ['models' => $protected_area, 'categories' => $categories];
    }

    /**
     * Get WDPAs by form ID
     */
    public static function getWdpasByFormId(array $form_ids): array
    {
        $protected_area = [];
        foreach ($form_ids as $k => $form_id) {
            $protected_area[$k] = ScalingUpWdpa::getByFormID(self::$scaling_id, $form_id);
        }

        return $protected_area;
    }
}

