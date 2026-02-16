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

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;
use Illuminate\Database\Eloquent\Collection;

final class WorkProgramImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_work_program_implementation';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;
    public static string $group_key_field = 'MainCategory';
    public static string $virtual_field = 'GroupKey';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_MIXED';
        $this->module_code = 'O/P1';
        $this->module_title = trans('imet-core::v2_evaluation.WorkProgramImplementation.title');
        $this->module_fields = [
            ['name' => 'MainCategory', 'type' => 'text-area', 'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.MainCategory')],
            ['name' => 'Category', 'type' => 'text-area', 'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.Category')],
            ['name' => 'Activity', 'type' => 'text-area', 'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.Activity')],
            ['name' => 'TargetedActivity', 'type' => 'text-area', 'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.TargetedActivity')],
            ['name' => 'EvaluationScore', 'type' => 'rating-0to3', 'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.EvaluationScore')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.Comments')],
        ];

        $this->module_groups = array_fill(1, 20, [self::$group_key_field => '-', self::$virtual_field => '-']);

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.WorkProgramImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.WorkProgramImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.WorkProgramImplementation.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getModuleRecords(?int $form_id, ?Collection $collection = null): array
    {
        $return = parent::getModuleRecords($form_id, $collection);
        foreach ($return['records'] as $key => $record) {
            $return['records'][$key][self::$virtual_field] = $record[self::$group_key_field];
        }
        $model = new static;
        $groups = self::getGroupsUpdated($return['records'], $model->module_fields, $model->module_groups);
        $return['groups'] = $groups;
        return $return;
    }

    public static function getDefinitions(?int $form_id = null): array
    {
        $items = parent::getDefinitions($form_id);
        $records = self::getModuleRecords($form_id);

        $items['fields'][] = ['name' => self::$virtual_field, 'type' => 'text-area', 'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.MainCategory')];
        $items['groups'] = $records['groups'];
        $items['virtual_field'] = self::$virtual_field;
        return $items;
    }

    public static function getEmptyRecord(?int $form_id = null): array
    {
        $empty_record = parent::getEmptyRecord($form_id);
        $empty_record[self::$virtual_field] = '';

        return $empty_record;
    }

    public static function updateModuleRecords(array $records, ?int $form_id): void
    {
        $groups = [];
        $processed_records = [];

        // Group records by their MainCategory
        foreach ($records as $record) {
            $mainCategory = $record[self::$group_key_field] ?? '';
            $groups[$mainCategory][] = $record;
        }

        //Process the groups
        foreach ($groups as $mainCategory => $groupRecords) {
            $newGroupKey = null;

            // Find if a new, non-empty GroupKey was provided for this group
            foreach ($groupRecords as $record) {
                if (!empty($record[self::$virtual_field]) && $record[self::$virtual_field] !== $mainCategory) {
                    $newGroupKey = $record[self::$virtual_field];
                    break;
                }
            }

            // Update records in the group if a new GroupKey was found
            if ($newGroupKey !== null) {
                foreach ($groupRecords as $record) {
                    $record[self::$group_key_field] = $newGroupKey;
                    unset($record[self::$virtual_field]);
                    unset($record['index']);
                    $processed_records[] = $record;
                }
            } else {
                // Otherwise, keep the records as they are and remove GroupKey
                foreach ($groupRecords as $record) {
                    unset($record[self::$virtual_field]);
                    unset($record['index']);
                    $processed_records[] = $record;
                }
            }
        }

        parent::updateModuleRecords($processed_records, $form_id);
    }

    public static function getGroupsUpdated(array $records, array $fields, array $groups): array
    {
        $new_groups = [];
        foreach ($records as $record) {
            foreach ($fields as $field) {
                if (!in_array($field['name'], [self::$group_key_field, self::$virtual_field], true)) {
                    continue;
                }

                $value = $record[$field['name']];

                if (!in_array($value, $new_groups, true)) {
                    $new_groups[] = $value;
                }
            }
        }

        foreach ($new_groups as $group_key => $group) {
            $index = (int)$group_key + 1;
            if (!isset($new_groups[$index])) {
                continue;
            }
            $new_element = [self::$group_key_field => $new_groups[$index], self::$virtual_field => $new_groups[$index]];
            $groups[$index] = $new_element;

        }
        return $groups;
    }

    /**
     * Generate the array of data needed by the Vue.js module's controller
     *
     * @param array<string, mixed> $records
     * @param array<string, mixed> $definitions
     * @return array<string, mixed>
     */
    public static function getVueData(?int $form_id, array $records, array $definitions): array
    {
        $return = parent::getVueData($form_id, $records, $definitions);
        $return['groups'] = self::getGroupsUpdated($records['records'], $definitions['fields'], $definitions['groups']);
        return $return;
    }

}
