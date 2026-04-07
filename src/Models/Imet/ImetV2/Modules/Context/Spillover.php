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
use ModularForms\Enums\ModuleTypes;

final class Spillover extends Modules\Component\ImetModule
{
    protected $table = 'context_spillover';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.spillover';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.spillover';

    public function __construct(array $attributes = [])
    {
        $this->module_type = ModuleTypes::SIMPLE;
        $this->module_code = 'CTX 2.6';
        $this->module_title = trans('imet-core::v2_context.Spillover.title');
        $this->module_fields = [
            ['name' => 'SupportingEvidence',                'type' => 'custom::radio-ImetV2_SupportingEvidence',                 'label' => trans('imet-core::v2_context.Spillover.fields.SupportingEvidence')],
            ['name' => 'SupportingKeyObservations',         'type' => 'custom::radio-ImetV2_SupportingKeyObservations',          'label' => trans('imet-core::v2_context.Spillover.fields.SupportingKeyObservations')],
            ['name' => 'SupportingOtherObservation',        'type' => 'text',                                                       'label' => trans('imet-core::v2_context.Spillover.fields.SupportingOtherObservation')],
            ['name' => 'SupportingPerceivedSpeciesChange',  'type' => 'custom::radio-ImetV2_SupportingPerceivedSpeciesChange',   'label' => trans('imet-core::v2_context.Spillover.fields.SupportingPerceivedSpeciesChange')],
            ['name' => 'SupportingPerceivedSizeChange',     'type' => 'custom::radio-ImetV2_SupportingPerceivedSizeChange',      'label' => trans('imet-core::v2_context.Spillover.fields.SupportingPerceivedSizeChange')],
            ['name' => 'SupportingComments',                'type' => 'text-area',                                                  'label' => trans('imet-core::v2_context.Spillover.fields.SupportingComments')],

            ['name' => 'ProvisioningEvidence',              'type' => 'custom::radio-ImetV2_ProvisioningEvidence',               'label' => trans('imet-core::v2_context.Spillover.fields.ProvisioningEvidence')],
            ['name' => 'ProvisioningKeyObservations',       'type' => 'custom::radio-ImetV2_ProvisioningKeyObservations',        'label' => trans('imet-core::v2_context.Spillover.fields.ProvisioningKeyObservations')],
            ['name' => 'ProvisioningOtherObservation',      'type' => 'text',                                                       'label' => trans('imet-core::v2_context.Spillover.fields.ProvisioningOtherObservation')],
            ['name' => 'ProvisioningPerceivedCatchChange',  'type' => 'custom::radio-ImetV2_ProvisioningPerceivedCatchChange',   'label' => trans('imet-core::v2_context.Spillover.fields.ProvisioningPerceivedCatchChange')],
            ['name' => 'ProvisioningPerceivedSpillover',    'type' => 'custom::radio-ImetV2_ProvisioningPerceivedSpillover',     'label' => trans('imet-core::v2_context.Spillover.fields.ProvisioningPerceivedSpillover')],
            ['name' => 'ProvisioningComments',              'type' => 'text-area',                                                  'label' => trans('imet-core::v2_context.Spillover.fields.ProvisioningComments')],

        ];

        $this->module_info = trans('imet-core::v2_context.Spillover.module_info');
        parent::__construct($attributes);
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.3 -> v3.0 ####
        // TODO: add fields ?

        return $record;
    }
}
