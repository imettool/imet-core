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

namespace ImetCore\Models\Imet\ImetV1\Modules\Context;

use ImetCore\Models\Imet\ImetV1\Modules;
use ImetCore\Models\User\Role;

final class TerritorialReferenceContext extends Modules\Component\ImetModule
{
    protected $table = 'context_territorial_reference_context';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.5';
        $this->module_title = trans('imet-core::v1_context.TerritorialReferenceContext.title');
        $this->module_fields = [
            ['name' => 'FunctionalKm2',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaEstimation')],
            ['name' => 'FunctionalPopulation',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaPopulation')],
            ['name' => 'EcologicalAspects',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.EcologicalAspects')],
            ['name' => 'BenefitKm2',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.FunctionalArea')],

            ['name' => 'FunctionalAreaPopulation',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.FunctionalAreaPopulation')],
            ['name' => 'BenefitSocioEconomicAspects',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.SocioEconomicAspects')],
            ['name' => 'SpillOverEffect',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.SpillOverEffect')],
        ];

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        $record = self::renameField($record, 'ReferenceEcosystemAreaEstimation', 'FunctionalKm2');
        $record = self::renameField($record, 'ReferenceEcosystemAreaPopulation', 'FunctionalPopulation');
        $record = self::renameField($record, 'FunctionalArea', 'BenefitKm2');

        return self::renameField($record, 'SocioEconomicAspects', 'BenefitSocioEconomicAspects');
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'TerritorialReferenceContext',
            'fields' => [
                'ReferenceEcosystemAreaEstimation', 'ReferenceEcosystemAreaPopulation', 'EcologicalAspects', 'FunctionalArea',
                'FunctionalAreaPopulation', 'SocioEconomicAspects', 'SpillOverEffect',
            ],
        ];
    }
}
