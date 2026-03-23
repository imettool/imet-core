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

final class IntelligenceImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_intelligence_implementation';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.evaluation.edit.modules.intelligence_implementation';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.evaluation.show.modules.intelligence_implementation';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('imet-core::v2_evaluation.IntelligenceImplementation.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'text-area',          'label' => trans('imet-core::v2_evaluation.IntelligenceImplementation.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Adequacy',  'type' => 'rating-0to3WithNA',  'label' => trans('imet-core::v2_evaluation.IntelligenceImplementation.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.IntelligenceImplementation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.IntelligenceImplementation.groups.group0'),
            'group0b' => trans('imet-core::v2_evaluation.IntelligenceImplementation.groups.group0b'),
            'group1' => trans('imet-core::v2_evaluation.IntelligenceImplementation.groups.group1'),
            'group1b' => trans('imet-core::v2_evaluation.IntelligenceImplementation.groups.group1b'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.IntelligenceImplementation.predefined_values.group0'),
                'group0b' => trans('imet-core::v2_evaluation.IntelligenceImplementation.predefined_values.group0b'),
                'group1' => trans('imet-core::v2_evaluation.IntelligenceImplementation.predefined_values.group1'),
                'group1b' => trans('imet-core::v2_evaluation.IntelligenceImplementation.predefined_values.group1b'),
            ],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.IntelligenceImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.IntelligenceImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.IntelligenceImplementation.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_terrestrial_groups(): array
    {
        $groups = (new self)->module_groups;

        return [
            $groups['group0'],
            $groups['group1'],
        ];
    }

    public static function get_marine_groups(): array
    {
        $groups = (new self)->module_groups;

        return [
            $groups['group0b'],
            $groups['group1b'],
        ];
    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = self::replacePredefinedValue($record, 'Element',
            'Intelligence and investigations units orienting ranger patrols actions ',
            'Intelligence and investigations units orienting and supporting ranger patrols actions');
        $record = self::replacePredefinedValue($record, 'Element',
            'Unités de renseignement et d’enquête orientant les actions des patrouilles de surveillants',
            'Unités de renseignement et d’enquête orientant et soutenant les actions des patrouilles de surveillants');
        $record = self::replacePredefinedValue($record, 'Element',
            'Unidades de inteligência e investigação que orientam as acções de patrulhamento dos fiscais',
            'Unidades de inteligência e investigação que orientam e apoiam as acções de patrulhamento dos fiscais');

        return self::replacePredefinedValue($record, 'Element',
            'Las unidades de seguimiento de indicios y cruce de información orientan las acciones de las patrullajes de los guardaparques',
            'Las unidades de seguimiento de indicios y cruce de información orientan y apoyan las acciones de las patrullajes de los guardaparques');
    }
}
