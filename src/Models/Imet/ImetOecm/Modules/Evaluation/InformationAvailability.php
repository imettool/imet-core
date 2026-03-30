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
use ModularForms\Enums\ModuleTypes;

final class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_information_availability';

    public bool $fixed_rows = true;

    public $titles = [];

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Element';

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::oecm_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.InformationAvailability.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Override
     */
    #[\Override]
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        if ($record['EvaluationScore'] !== null || $record['Comments'] !== null) {
            return false;
        }

        return true;
    }

    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        $key_elements = $form_id !== null
            ? array_merge(
                KeyElements::getPrioritizedElements($form_id),
                Designation::getPrioritizedElements($form_id),
                SupportsAndConstraintsIntegration::getPrioritizedElements($form_id),
                ThreatsIntegration::getPrioritizedElements($form_id)
            )
            : [];

        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $key_elements,
        ];
    }
}
