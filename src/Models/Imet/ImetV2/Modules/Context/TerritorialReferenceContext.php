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

namespace ImetCore\Models\Imet\ImetV2\Modules\Context;

use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;

final class TerritorialReferenceContext extends Modules\Component\ImetModule
{
    protected $table = 'context_territorial_reference_context';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.4';
        $this->module_title = trans('imet-core::v2_context.TerritorialReferenceContext.title');
        $this->module_fields = [
            ['name' => 'FunctionalHasNoTakeArea',  'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.FunctionalHasNoTakeArea')],
            ['name' => 'FunctionalKm2',  'type' => 'numeric',   'label' => ''],
            ['name' => 'FunctionalKm',  'type' => 'numeric',   'label' => ''],
            ['name' => 'FunctionalPopulation',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.FunctionalPopulation')],
            ['name' => 'BenefitKm2',  'type' => 'numeric',   'label' => ''],
            ['name' => 'BenefitKm',  'type' => 'numeric',   'label' => ''],
            ['name' => 'BenefitPopulation',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.BenefitPopulation')],
            ['name' => 'BenefitSocioEconomicAspects',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.BenefitSocioEconomicAspects')],
            ['name' => 'DocumentedConnectivity',    'type' => 'imet-core::radio-ImetV2_DocumentedConnectivity', 'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.DocumentedConnectivity')],
            ['name' => 'EvidenceOfConnectivity',    'type' => 'imet-core::radio-ImetV2_EvidenceOfConnectivity', 'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.EvidenceOfConnectivity')],
            ['name' => 'EvidencesListConnectivity',    'type' => 'checkbox-ImetV2_EvidencesListConnectivity', 'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.EvidencesListConnectivity')],
            ['name' => 'ConnectivityIntegrationInManagementPlan',    'type' => 'imet-core::radio-ImetV2_ConnectivityIntegrationInManagementPlan', 'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.ConnectivityIntegrationInManagementPlan')],
        ];

        $this->module_info = trans('imet-core::v2_context.TerritorialReferenceContext.module_info');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.2 -> v2.3 ####
        $record = self::addField($record, 'FunctionalHasNoTakeArea');
        $record = self::renameField($record, 'ReferenceEcosystemAreaEstimation', 'FunctionalKm2');
        $record = self::addField($record, 'FunctionalKm');
        $record = self::renameField($record, 'ReferenceEcosystemAreaPopulation', 'FunctionalPopulation');
        $record = self::renameField($record, 'FunctionalArea', 'BenefitKm2');
        $record = self::addField($record, 'BenefitKm');
        $record = self::addField($record, 'BenefitPopulation');
        $record = self::renameField($record, 'SocioEconomicAspects', 'BenefitSocioEconomicAspects');
        $record = self::addField($record, 'SpillOverKm2');
        $record = self::addField($record, 'SpillOverKm');

        // ####  v2.3 -> v3.0 ####
        $record = self::dropField($record, 'SpillOverKm2');
        $record = self::dropField($record, 'SpillOverKm');
        $record = self::dropField($record, 'SpillOverEvalPredatory0_500');
        $record = self::dropField($record, 'SpillOverEvalPredatory500_1000');
        $record = self::dropField($record, 'SpillOverEvalPredatory200_3000');
        $record = self::dropField($record, 'SpillOverEvalComposition0_500');
        $record = self::dropField($record, 'SpillOverEvalComposition500_1000');
        $record = self::dropField($record, 'SpillOverEvalComposition200_3000');
        $record = self::dropField($record, 'SpillOverEvalDistance0_500');
        $record = self::dropField($record, 'SpillOverEvalDistance500_1000');
        $record = self::dropField($record, 'SpillOverEvalDistance200_3000');
        $record = self::addField($record, 'DocumentedConnectivity');
        $record = self::addField($record, 'EvidenceOfConnectivity');
        $record = self::addField($record, 'EvidencesListConnectivity');
        $record = self::addField($record, 'ConnectivityIntegrationInManagementPlan');

        return $record;
    }
}
