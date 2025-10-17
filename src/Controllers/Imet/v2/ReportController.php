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

namespace ImetCore\Controllers\Imet\v2;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Str;
use ImetCore\Controllers\Imet\ReportController as BaseReportController;
use ImetCore\Helpers\ImetEnv;
use ImetCore\Models\Imet\v2\Imet;
use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ImetCore\Models\Species;
use ImetCore\Services\Scores\ImetScores;
use ReflectionException;

final class ReportController extends BaseReportController
{
    protected static ?string $form_class = Imet::class;

    protected static ?string $form_view_prefix = 'imet-core::v2.report';

    /**
     * Retrieve data to populate report view
     *
     * @throws ConnectionException
     */
    protected function __retrieve_report_data(Imet $item): array
    {
        $form_id = $item->getKey();

        $show_general_info = false;

        $connection = ImetEnv::isConnectionAvailable();

        if (! ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
            $show_general_info = true;
        } else {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::query()->find($item->wdpa_id)->toArray();
        }

        $general_info = Modules\Context\GeneralInfo::getModuleRecords($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);

        return [
            'item' => $item,
            'key_elements' => [
                'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)
                    ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                    ->pluck('Aspect')
                    ->map(fn ($item) => Str::contains('|', $item) ? Species::getByTaxonomy($item)->binomial : $item)
                    ->toArray(),
                'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)
                    ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                    ->pluck('Aspect')
                    ->toArray(),
                'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)
                    ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                    ->pluck('Aspect')
                    ->toArray(),
                'ecosystem_services' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)
                    ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                    ->pluck('Aspect')
                    ->toArray(),
                'threats' => Modules\Evaluation\Menaces::getModule($form_id)
                    ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                    ->pluck('Aspect')
                    ->toArray(),
            ],
            'scores' => ImetScores::get_all($item),
            'labels' => ImetScores::indicators_labels(\ImetCore\Models\Imet\Imet::IMET_V2),
            'report' => \ImetCore\Models\Imet\v2\Report::getByForm($form_id),
            'connection' => $connection,
            'show_general_info' => $show_general_info,
            'show_non_wdpa' => $show_non_wdpa ?? false,
            'non_wdpa' => $non_wdpa ?? null,
            'general_info' => $general_info['records'][0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id),
        ];
    }
}
