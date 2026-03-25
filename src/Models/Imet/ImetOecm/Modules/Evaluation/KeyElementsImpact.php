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

final class KeyElementsImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_key_elements_impact';

    public bool $fixed_rows = true;

    public $titles = [];

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::oecm.evaluation.edit.modules.key_elements_impact';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::oecm.evaluation.show.modules.key_elements_impact';

    protected static $DEPENDENCY_ON = 'KeyElement';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/C2';
        $this->module_title = trans('imet-core::oecm_evaluation.KeyElementsImpact.title');
        $this->module_fields = [
            ['name' => 'KeyElement',    'type' => 'disabled',      'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.KeyElement')],
            ['name' => 'StatusSH',      'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusSH')],
            ['name' => 'TrendSH',       'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendSH')],
            ['name' => 'EffectSH',      'type' => 'disabled',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.EffectSH')],
            ['name' => 'ReliabilitySH', 'type' => 'dropdown-ImetOECM_Reliability',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.ReliabilitySH')],
            ['name' => 'CommentsSH',    'type' => 'text-area',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.CommentsSH')],
            ['name' => 'StatusER',      'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusER')],
            ['name' => 'TrendER',       'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendER')],
            ['name' => 'EffectER',      'type' => 'disabled',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.EffectER')],
            ['name' => 'ReliabilityER', 'type' => 'dropdown-ImetOECM_Reliability',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.ReliabilityER')],
            ['name' => 'CommentsER',    'type' => 'text-area',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.CommentsER')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.KeyElementsImpact.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.KeyElementsImpact.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.KeyElementsImpact.groups.group2'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.KeyElementsImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.KeyElementsImpact.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.KeyElementsImpact.ratingLegend');

        parent::__construct($attributes);
    }

    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
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
}
