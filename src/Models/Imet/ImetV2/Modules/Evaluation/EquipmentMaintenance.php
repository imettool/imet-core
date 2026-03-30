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

namespace ImetCore\Models\Imet\ImetV2\Modules\Evaluation;

use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleTypes;

final class EquipmentMaintenance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_equipment_maintenance';

    public bool $fixed_rows = true;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.evaluation.edit.modules.equipment_maintenance';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.evaluation.show.modules.equipment_maintenance';

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'PR6';
        $this->module_title = trans('imet-core::v2_evaluation.EquipmentMaintenance.title');
        $this->module_fields = [
            ['name' => 'Equipment',         'type' => 'text-area',                'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.Equipment')],
            ['name' => 'AdequacyLevel',     'type' => 'disabled',             'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.AdequacyLevel')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',                'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',                                                         // Comes from context->Equipments
            'values' => array_keys(trans('imet-core::v2_context.Equipments.groups')),
            'labels' => array_values(trans('imet-core::v2_context.Equipments.groups')),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.EquipmentMaintenance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.EquipmentMaintenance.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.EquipmentMaintenance.ratingLegend');

        parent::__construct($attributes);

    }

    #[\Override]
    protected static function arrange_records(?array $predefined_values, array $records, array $empty_record): array
    {
        $records = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        $new_records = [];
        $adequacy = self::calculateEquipementAdequacy($form_id);
        foreach ($predefined_values['values'] as $i => $predefined_value) {
            if ($adequacy[$i] != null) {
                $records[$i]['AdequacyLevel'] = $adequacy[$i];
                $new_records[] = $records[$i];
            }
        }

        return $new_records;
    }

    /**
     * @return list<(float | null)>
     */
    private static function calculateEquipementAdequacy(?int $form_id): array
    {
        $adequacy = array_keys(trans('imet-core::v2_context.Equipments.groups'));
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
        foreach (array_keys($adequacy) as $i) {
            $result[] = $adequacy[$i]['count'] > 0
                ? round($adequacy[$i]['sum'] / $adequacy[$i]['count'], 2)
                : null;
        }

        foreach ($result as $i => $r) {
            if ($r !== null) {
                $result[$i] = round($r, 2);
            }
        }

        return $result;
    }

    #[\Override]
    protected function customValue(array $record, array $field): string|array|null
    {
        if ($field['name'] === 'Equipment') {
            return $record['__predefined_label'];
        }

        return $record[$field['name']] ?? null;
    }
}
