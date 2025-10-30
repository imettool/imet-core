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

final class NaturalResourcesMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_natural_resources_monitoring';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR15';
        $this->module_title = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.predefined_values'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = self::replacePredefinedValue($record, 'Aspect',
            'Monitoring ecosystems and habitats',
            'Monitoring habitats and related dimensions of land cover, land use, land take');
        $record = self::replacePredefinedValue($record, 'Aspect',
            'Suivi des écosystèmes et des habitats',
            'Suivi des habitats et les dimensions connexes de couverture terrestre, utilisation et occupation des sols');
        $record = self::replacePredefinedValue($record, 'Aspect',
            'Monitorização de ecossistemas e habitats',
            'Monitorização de habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação');
        $record = self::replacePredefinedValue($record, 'Aspect',
            'Monitoreo de los ecosistemas y los hábitats',
            'Monitoreo de los hábitats y las dimensiones relacionadas de la cobertura del suelo, uso del suelo y tenencia del territorio');
        $record = self::dropIfPredefinedValueObsolete($record, 'Aspect', 'Monitoring land cover–land use–land take');
        $record = self::dropIfPredefinedValueObsolete($record, 'Aspect', 'Suivi de la couverture terrestre, utilisation et occupation des sols');
        $record = self::dropIfPredefinedValueObsolete($record, 'Aspect', 'Monitorização de terrenos (cobretura do solo, uso e ocupacão)');

        return self::dropIfPredefinedValueObsolete($record, 'Aspect', 'Monitoreo de la cobertura del suelo  - uso del suelo - tenencia del territorio');
    }
}
