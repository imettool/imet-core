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

final class AssistanceActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_assistance_activities';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.evaluation.edit.modules.assistance_activities';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.evaluation.show.modules.assistance_activities';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR11';
        $this->module_title = trans('imet-core::v2_evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.AssistanceActivities.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.AssistanceActivities.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.AssistanceActivities.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.AssistanceActivities.predefined_values.group1'),
            ],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_terrestrial_predefined(): array
    {
        $predefined = (new self)->predefined_values['values'];

        return [
            $predefined['group0'][17],
        ];
    }

    public static function get_marine_predefined(): array
    {
        $predefined = (new self)->predefined_values['values'];

        return [
            $predefined['group0'][18],
            $predefined['group0'][19],
            $predefined['group0'][20],
        ];
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = self::replacePredefinedValue($record, 'Activity',
            'Support for local activities (e.g. ecosystem services management, climate change mitigation, etc.)',
            'Support for local activities (e.g. ecosystem services - provisioning management, climate change adaptation, etc.)');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Soutien aux activités locales (gestion des services écosystémiques, atténuation du changement climatique, etc.)',
            'Soutien aux activités locales (gestion des services écosystémiques - gestion de l\'approvisionnement, adaptation au changement climatique, etc.)');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Apoio a actividades locais (por exemplo, gestão de serviços ecossistémicos, mitigação das alterações climáticas, etc.)',
            'Apoio a actividades locais (por exemplo, gestão de serviços ecossistémicos - gestão de aprovisionamento, adaptação às alterações climáticas, etc.)');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Apoyo a las actividades locales (por ejemplo, gestión de los servicios/funciones ecosistémicas, mitigación del cambio climático, etc.)',
            'Apoyo a las actividades locales (por ejemplo, gestión de los servicios/funciones ecosistémicas - gestión de aprovisionamiento, adaptación al cambio climático, etc.)');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Purchase of agriculture products for tourism and staff',
            'Purchase of agriculture products or seadfood for tourism and staff');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Compra de produtos agrícolas para turismo e pessoal',
            'Compra de produtos agrícolas ou frutos do mar para turismo e pessoal');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Compra de productos agrícolas para el turismo y contratación de personal',
            'Compra de productos agrícolas o del mar para el turismo y contratación de personal');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Minimisation of conflicts and strengthening of the sustainable management and use of ecosystem services',
            'Minimisation of conflicts and strengthening of the sustainable management and use of ecosystem services (provisioning and cultural)');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des services écosystémiques',
            'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des services écosystémiques (approvisionnement et culture)');
        $record = self::replacePredefinedValue($record, 'Activity',
            'Minimização dos conflitos e reforço da gestão e utilização sustentável dos serviços ecossistémicos',
            'Minimização dos conflitos e reforço da gestão e utilização sustentável dos serviços ecossistémicos (abastecimento e cultura)');

        return self::replacePredefinedValue($record, 'Activity',
            'Reducción al mínimo de los conflictos y fortalecimiento de la gestión y el uso sostenible de los servicios/funciones ecosistémicas',
            'Reducción al mínimo de los conflictos y fortalecimiento de la gestión y el uso sostenible de los servicios/funciones ecosistémicas (avituallamiento y cultura)');
    }
}
