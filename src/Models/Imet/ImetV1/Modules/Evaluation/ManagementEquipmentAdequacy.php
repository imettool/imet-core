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

namespace ImetCore\Models\Imet\ImetV1\Modules\Evaluation;

use ImetCore\Models\Imet\ImetV1\Modules;
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleTypes;

final class ManagementEquipmentAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_equipment_adequacy';

    public bool $fixed_rows = true;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v1.evaluation.edit.modules.management_equipment_adequacy';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v1.evaluation.show.modules.management_equipment_adequacy';

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'I5';
        $this->module_title = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.title');
        $this->module_fields = [
            ['name' => 'Equipment',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.fields.Equipment')],
            ['name' => 'Importance',  'type' => 'rating-0to2',   'label' => trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.fields.Importance')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',
            'values' => array_values(trans('imet-core::v1_context.Equipments.groups')),   // Comes from context->Equipments
        ];

        $this->module_info = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.module_info');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.ratingLegend');

        parent::__construct($attributes);

    }

    #[\Override]
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $new_records = [];

        if (count($predefined_values['values']) > 1 && count($records) === 1) {
            $records = [];
        }

        $adequacy = self::calculateEquipementAdequacy($form_id);

        foreach ($predefined_values['values'] as $p => $predefined_value) {
            $new_record = $empty_record;
            foreach ($records as $r => $record) {
                if ($record[$predefined_values['field']] == $predefined_value) {
                    $new_record = $record;
                    unset($records[$r]);
                    break;
                }
            }

            $new_record[$predefined_values['field']] = $predefined_value;
            $new_record['__adequacy'] = $adequacy[$p];
            $new_record['__predefined'] = true;
            $new_records[] = $new_record;
        }

        return $new_records;
    }

    /**
     * @return list<(float | null)>
     */
    private static function calculateEquipementAdequacy(?int $form_id): array
    {
        $adequacy = array_keys(trans('imet-core::v1_context.Equipments.groups'));
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
            $result[] = $adequacy[$i]['count'] > 0 ? round($adequacy[$i]['sum'] / $adequacy[$i]['count'], 2) : null;
        }

        return $result;
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_ManagementEquipmentAdequacy',
            'fields' => [
                'Equipment', 'Importance', 'Comments',
            ],
        ];
    }
}
