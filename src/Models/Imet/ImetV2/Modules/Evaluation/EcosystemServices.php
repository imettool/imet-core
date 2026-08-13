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
use ModularForms\Enums\ModuleTypes;

final class EcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_ecosystem_services';

    public bool $fixed_rows = true;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.evaluation.edit.modules.ecosystem_services';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.evaluation.show.modules.ecosystem_services';

    protected static $DEPENDENCY_ON = 'Intervention';

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'PR18';
        $this->module_title = trans('imet-core::v2_evaluation.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Intervention',      'type' => 'custom::v2-ecosystem-services-intervention',  'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.Intervention')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3WithNA',      'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.EvaluationScore')],
            ['name' => 'InManagementPlan',  'type' => 'checkbox-boolean_numeric',   'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.InManagementPlan')],
            ['name' => 'Comments',          'type' => 'text-area',                   'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.EcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.EcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.EcosystemServices.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Prefill from CTX
     */
    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? ImportanceEcosystemServices::getModule($form_id)
                    ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                    ->pluck('Aspect')
                    ->filter()
                    ->toArray()
                : [],
        ];
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v3.7.3 -> v3.7.4 ####
        return self::addField($record, 'InManagementPlan');

    }
}
