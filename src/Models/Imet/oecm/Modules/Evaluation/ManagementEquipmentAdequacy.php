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

use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\User\Role;

final class ManagementEquipmentAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_equipment_adequacy';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Equipment';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'I5';
        $this->module_title = trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.title');
        $this->module_fields = [
            ['name' => 'Equipment',     'type' => 'blade-imet-core::oecm.evaluation.fields.management_equipment_adequacy',          'label' => trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.fields.Equipment')],
            ['name' => 'Adequacy',      'type' => 'blade-imet-core::oecm.evaluation.fields.management_equipment_adequacy_score', 'label' => trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.fields.Adequacy')],
            ['name' => 'PresentNeeds',  'type' => 'rating-0to2', 'label' => trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.fields.PresentNeeds')],
            ['name' => 'Comments',      'type' => 'text-area',              'label' => trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',                                                                     // Comes from CTX 3.3
            'values' => array_keys(trans('imet-core::oecm_context.Equipments.groups')),
            'labels' => array_values(trans('imet-core::oecm_context.Equipments.groups')),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ManagementEquipmentAdequacy.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function arrange_records(?array $predefined_values, array $records, array $empty_record): array
    {
        $records = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        $new_records = [];
        $adequacy = self::calculateEquipmentAdequacy($form_id);
        foreach ($predefined_values['values'] as $i => $predefined_value) {
            if ($adequacy[$i] !== null) {
                $records[$i]['__adequacy'] = $adequacy[$i];
                $new_records[] = $records[$i];
            }
        }

        return $new_records;
    }

    private static function calculateEquipmentAdequacy(?int $form_id): array
    {
        $adequacy = array_keys(trans('imet-core::oecm_context.Equipments.groups'));
        $adequacy = array_fill_keys($adequacy, [
            'sum' => 0,
            'count' => 0,
        ]);
        $collection = Modules\Context\Equipments::getModule($form_id);
        foreach ($collection as $item) {
            if ($item['AdequacyLevel'] !== null) {
                $adequacy[$item['group_key']]['sum'] += $item['AdequacyLevel'];
                $adequacy[$item['group_key']]['count']++;
            }
        }

        $result = [];
        foreach ($adequacy as $value) {
            $result[] = $value['count'] > 0
                ? round($value['sum'] / $value['count'], 2)
                : null;
        }

        return $result;
    }

    #[\Override]
    protected function customValue(array $record, array $field): string|array|null
    {
        $value = $record[$field['name']] ?? null;
        if ($field['type'] === 'blade-imet-core::oecm.evaluation.fields.management_equipment_adequacy') {
            return $record['__predefined_label'];
        }

        if ($field['type'] === 'blade-imet-core::oecm.evaluation.fields.management_equipment_adequacy_score') {
            return $record['__adequacy'];
        }

        return $value;
    }
}
