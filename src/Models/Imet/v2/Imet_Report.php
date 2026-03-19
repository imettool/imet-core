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

namespace ImetCore\Models\Imet\v2;

use ImetCore\Models\Imet\v2\Modules\Report\ManagementContext;
use ImetCore\Models\Imet\v2\Modules\Report\ManagementEffectivenessAnalysis;
use ImetCore\Models\Imet\v2\Modules\Report\OperatingRecommendations;
use ImetCore\Models\Imet\v2\Modules\Report\KeyConservationElements;
use ImetCore\Models\Imet\v2\Modules\Report\ThreatsAffectingKCEs;
use ImetCore\Models\Imet\v2\Modules\Report\InitialPlanningOptions;
use ImetCore\Models\Imet\v2\Modules\Report\KeyQuestions;

class Imet_Report extends Imet
{
    public static ?array $modules = [
        'report' => [
            ManagementContext::class,
            ManagementEffectivenessAnalysis::class,
            OperatingRecommendations::class,
            KeyConservationElements::class,
            ThreatsAffectingKCEs::class,
            InitialPlanningOptions::class,
            KeyQuestions::class
        ]
    ];

    /**
     * Upgrade: 2.x -> 3.x
     * Legacy IMETs had analysis report not base on modules
     */
    public static function upgradeLegacy(array $records, int $formID, ?string $imet_version = null): array
    {
        $modules_imported = [];

        $legacy_report_fields = [
            'key_species_comment', 'habitats_comment', 'climate_change_comment', 'ecosystem_services_comment', 'threats_comment',
            'analysis', 'strengths_swot', 'weaknesses_swot', 'opportunities_swot', 'threats_swot',
            'recommendations',
            'priorities', 'minimum_budget', 'additional_funding',
        ];

        $legacy_field_found = !empty(array_intersect($legacy_report_fields, array_keys($records)));

        if($legacy_field_found){

            ManagementContext::importModule($formID, [
                'key_species' => $records['key_species_comment'] ?? null,
                'habitats' => $records['habitats_comment'] ?? null,
                'climate_change' => $records['climate_change_comment'] ?? null,
                'ecosystem_services' => $records['ecosystem_services_comment'] ?? null,
                'threats' => $records['threats_comment'] ?? null,
            ]);
            $modules_imported[] = ManagementContext::getShortClassName();

            ManagementEffectivenessAnalysis::importModule($formID, [
                'analysis' => $records['analysis'] ?? null,
                'strengths' => $records['strengths_swot'] ?? null,
                'weaknesses' => $records['weaknesses_swot'] ?? null,
                'opportunities' => $records['opportunities_swot'] ?? null,
                'threats' => $records['threats_swot'] ?? null,
            ]);
            $modules_imported[] = ManagementEffectivenessAnalysis::getShortClassName();

            OperatingRecommendations::importModule($formID, [
                'recommendations' => $records['recommendations'] ?? null,
            ]);
            $modules_imported[] = OperatingRecommendations::getShortClassName();

            KeyQuestions::importModule($formID, [
                'priorities' => $records['priorities'] ?? null,
                'minimum_budget' => $records['minimum_budget'] ?? null,
                'additional_funding' => $records['additional_funding'] ?? null,
            ]);
            $modules_imported[] = KeyQuestions::getShortClassName();
        }

        return $modules_imported;
    }

}
