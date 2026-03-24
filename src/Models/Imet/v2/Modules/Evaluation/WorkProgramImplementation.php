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
    public static string $virtual_group_key_field = '__groupKey';

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

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.WorkProgramImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.WorkProgramImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.WorkProgramImplementation.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Calculate the $virtual_group_key_field for each record based, add it to the record array and generate the groups
     * array based on the unique values of $group_key_field
     */
    public static function getModuleRecords(?int $form_id, ?Collection $collection = null): array
    {
        $data = parent::getModuleRecords($form_id, $collection);

        // Initialize $groups array (up to group20)
        $groups = [];
        $group_index = 1;
        while($group_index <= 20) {
            $group_key = 'group'.$group_index;
            $groups[$group_key] = null;
            $group_index++;
        }

        // Loop through records to assign group keys
        foreach ($data['records'] as $i => $record) {

            // Retrieve the group_key for the record
            $group_key = array_search($record[self::$group_key_field], $groups);
            if($group_key === false) {
                $group_key = array_search(null, $groups);
            }

            // Add the group_key to the groups array if it's not already there
            $groups[$group_key] = $record[self::$group_key_field];

            // Add the group_key to the record into $virtual_group_key_field
            $record[self::$virtual_group_key_field] = $group_key;

            // Update the record in the data array
            $data['records'][$i] = $record;
        }
        $data['groups'] = $groups;

        return $data;
    }

    public static function getDefinitions(?int $form_id = null): array
    {
        $items = parent::getDefinitions($form_id);
        $records = self::getModuleRecords($form_id);

        $items['groups'] = $records['groups'];
        return $items;
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

        // Trick UI to use $virtual_group_key_field instead of the $group_key_field for grouping records in the view,
        // while keeping the original $group_key_field as the one stored in the database and used for grouping in the backend
        $return['group_key_field'] = self::$virtual_group_key_field;
        $return['original_group_key_field'] = self::$group_key_field;

        return $return;
    }

}
