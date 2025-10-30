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

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

final class ImportanceEcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c16';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect'],
        [Modules\Evaluation\EcosystemServices::class, 'Aspect'],
    ];

    protected static array $extra_raw_fields = ['rank' => '_rank',
        'Importance' => '_Importance',
        'ImportanceRegional' => '_ImportanceRegional',
        'ImportanceGlobal' => '_ImportanceGlobal'];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.5';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Aspect', 'type' => 'blade-imet-core::v2.evaluation.fields.importance_ecosystem_services_aspect',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => null,
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Prefill from CTX
     */
    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? self::getEcosystemServices($form_id)
                    ->map(fn (Modules\Context\EcosystemServices $item): mixed => $item['Element'])
                : [],
        ];
    }

    protected static function arrange_records(?array $predefined_values, array $records, array $empty_record): array
    {
        $records = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        // Inject rankings
        foreach (self::getEcosystemServices($form_id)->values()->toArray() as $index => $record) {
            $records[$index]['_rank'] = $record['_rank'];
            $records[$index]['_Importance'] = $record['Importance'];
            $records[$index]['_ImportanceRegional'] = $record['ImportanceRegional'];
            $records[$index]['_ImportanceGlobal'] = $record['ImportanceGlobal'];
        }

        return $records;
    }

    private static function getEcosystemServices(?int $form_id): Collection
    {
        return Modules\Context\EcosystemServices::getModule($form_id)
            ->filter(fn ($item): bool => $item['Importance'] !== null)
            ->map(function (Modules\Context\EcosystemServices $item): Modules\Context\EcosystemServices {
                $item['_rank'] = (floatval($item['Importance'])
                        + ($item['ImportanceRegional'] / 3)
                        + ((2 - $item['ImportanceGlobal']) / 4)) / 3 * 100;

                return $item;
            })
            ->sortByDesc('_rank');
    }
}
