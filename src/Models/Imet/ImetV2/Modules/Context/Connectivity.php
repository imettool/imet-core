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

final class Connectivity extends Modules\Component\ImetModule
{
    protected $table = 'context_connectivity';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.connectivity';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.connectivity';

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::SIMPLE;
        $this->module_code = 'CTX 2.5';
        $this->module_title = trans('imet-core::v2_context.Connectivity.title');
        $this->module_fields = [
            ['name' => 'DocumentedConnectivity',    'type' => 'custom::radio-ImetV2_DocumentedConnectivity', 'label' => trans('imet-core::v2_context.Connectivity.fields.DocumentedConnectivity')],
            ['name' => 'EvidenceOfConnectivity',    'type' => 'custom::radio-ImetV2_EvidenceOfConnectivity', 'label' => trans('imet-core::v2_context.Connectivity.fields.EvidenceOfConnectivity')],
            ['name' => 'EvidencesListConnectivity',    'type' => 'checkbox-ImetV2_EvidencesListConnectivity', 'label' => trans('imet-core::v2_context.Connectivity.fields.EvidencesListConnectivity')],
            ['name' => 'ConnectivityIntegrationInManagementPlan',    'type' => 'custom::radio-ImetV2_ConnectivityIntegrationInManagementPlan', 'label' => trans('imet-core::v2_context.Connectivity.fields.ConnectivityIntegrationInManagementPlan')],
        ];

        $this->module_info = trans('imet-core::v2_context.Connectivity.module_info');

        parent::__construct($attributes);
    }
}
