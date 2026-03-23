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

namespace ImetCore\Models\Imet\ImetOecm\Modules\Evaluation;

use ImetCore\Models\Imet\ImetOecm\Modules;
use ImetCore\Models\User\Role;

final class ManagementActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_activities';

    public bool $fixed_rows = true;

    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Activity';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR6';
        $this->module_title = trans('imet-core::oecm_evaluation.ManagementActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',          'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.Activity')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.EvaluationScore')],
            ['name' => 'InManagementPlan',  'type' => 'checkbox-boolean_numeric',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.InManagementPlan')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ManagementActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ManagementActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ManagementActivities.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Override
     */
    #[\Override]
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        if ($record['EvaluationScore'] !== null || $record['InManagementPlan'] !== null || $record['Comments'] !== null) {
            return false;
        }

        return true;
    }

    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? KeyElements::getPrioritizedElements($form_id)
                : [],
        ];
    }
}
