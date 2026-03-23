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

final class Missions extends Modules\Component\ImetModule
{
    protected $table = 'context_missions';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;
    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.missions';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.missions';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.5';
        $this->module_title = trans('imet-core::v2_context.Missions.title');
        $this->module_fields = [
            ['name' => 'LocalVision',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalVision')],
            ['name' => 'LocalMission',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalMission')],
            ['name' => 'LocalObjective',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalObjective')],
            ['name' => 'LocalSource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalSource')],
            ['name' => 'LocalManagementPlan',  'type' => 'upload',   'label' => trans('imet-core::v2_context.Missions.fields.LocalManagementPlan')],
            ['name' => 'InternationalVision',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalVision')],
            ['name' => 'InternationalMission',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalMission')],
            ['name' => 'InternationalObjective',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalObjective')],
            ['name' => 'InternationalSource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalSource')],
            ['name' => 'InternationalManagementPlan',  'type' => 'upload',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalManagementPlan')],
            ['name' => 'Observation',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.Observation')],
        ];

        $this->module_info = trans('imet-core::v2_context.Missions.module_info');

        parent::__construct($attributes);

    }
}
