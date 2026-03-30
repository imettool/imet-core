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

use Illuminate\Http\Request;
use ImetCore\Models\Imet\ImetOecm\Modules;
use ImetCore\Models\User\Role;
use ModularForms\Models\Traits\Payload;
use ModularForms\Enums\ModuleTypes;

final class WorkPlan extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_work_plan';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::SIMPLE;
        $this->module_code = 'P5';
        $this->module_title = trans('imet-core::oecm_evaluation.WorkPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistence',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanExistence')],
            ['name' => 'PrintedCopy',           'type' => 'toggle-yes_no',          'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PrintedCopy')],
            ['name' => 'KnowledgePercentage',   'type' => 'rating-0to3', 'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.KnowledgePercentage')],
            ['name' => 'PlanUptoDate',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanUptoDate')],
            ['name' => 'PlanApproved',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanApproved')],
            ['name' => 'PlanImplemented',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanImplemented')],
            ['name' => 'PlanAdequacyScore',     'type' => 'rating-0to3',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanAdequacyScore')],
            ['name' => 'Comments',              'type' => 'text-area',           'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.WorkPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.WorkPlan.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.WorkPlan.ratingLegend');

        parent::__construct($attributes);
    }

    private static function ensureNullValues(array $data): array
    {
        if ($data['PlanExistence'] === false || $data['PlanExistence'] === 'false') {
            $data['PlanUptoDate'] = false;
            $data['PlanApproved'] = false;
            $data['PlanImplemented'] = false;
            $data['PlanAdequacyScore'] = 0;
        }

        return $data;
    }

    #[\Override]
    public static function updateModule(Request $request): array
    {
        $records = Payload::decode($request->input('records_json'));
        $records[0] = self::ensureNullValues($records[0]);
        $request->merge(['records_json' => Payload::encode($records)]);

        return parent::updateModule($request);
    }

    #[\Override]
    public static function importModule(int $form_id, ?array $data): void
    {
        $data = self::ensureNullValues($data);
        parent::importModule($form_id, $data);
    }
}
