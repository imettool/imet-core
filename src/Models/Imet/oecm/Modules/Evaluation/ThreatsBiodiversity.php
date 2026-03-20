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

namespace ImetCore\Models\Imet\oecm\Modules\Evaluation;

use ImetCore\Exceptions\MissingDependencyConfigurationException;
use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\User\Role;
use ImetCore\Services\ThreatsService;

final class ThreatsBiodiversity extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_threats_biodiversity';

    public bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Criteria';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C3.1.1';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.title');
        $this->module_fields = [
            ['name' => 'Criteria',      'type' => 'disabled',                       'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Criteria')],
            ['name' => 'Impact',        'type' => 'rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Impact')],
            ['name' => 'Extension',     'type' => 'rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Extension')],
            ['name' => 'Duration',      'type' => 'rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Duration')],
            ['name' => 'Trend',         'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Trend')],
            ['name' => 'Probability',   'type' => 'rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Probability')],
            ['name' => 'Note',          'type' => 'text-area',                      'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Note')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group2'),
        ];

        $this->module_info = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.module_info');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Inject additional predefined values (last 3 groups) retrieved from CTX
     */
    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        parent::getPredefined($form_id);

        $predefined_values = $form_id !== null
            ? [
                'group0' => Modules\Context\AnimalSpecies::getReferenceList($form_id, 'species'),
                'group1' => Modules\Context\VegetalSpecies::getReferenceList($form_id, 'species'),
                'group2' => Modules\Context\Habitats::getReferenceList($form_id, 'EcosystemType'),
            ]
            : [];

        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $predefined_values,
        ];
    }

    /**
     * Override: ensure to removed dropped items
     *
     * @throws MissingDependencyConfigurationException
     * @throws \Throwable
     */
    protected static function arrange_records_with_predefined($form_id, $records, $empty_record): array
    {
        $predefined_values = self::getPredefined($form_id);
        $records = self::arrange_records($predefined_values, $records, $empty_record);

        // Ensure to removed dropped items
        foreach ($records as $record) {
            if (! in_array($record[self::$DEPENDENCY_ON], $predefined_values['values'][$record['group_key']])) {
                self::dropOrphansDependencyRecords($form_id, [$record[self::$DEPENDENCY_ON]]);
            }
        }

        return $records;
    }

    /**
     * Calculate threat's ranking
     */
    public static function calculateRanking(?int $form_id, ?array $records = null): array
    {
        $records ??= self::getModuleRecords($form_id)['records'];

        return ThreatsService::calculateRanking($records);
    }
}
