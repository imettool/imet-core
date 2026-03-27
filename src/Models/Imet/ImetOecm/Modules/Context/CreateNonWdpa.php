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

namespace ImetCore\Models\Imet\ImetOecm\Modules\Context;

use ImetCore\Models\Imet\ImetOecm\Modules;

final class CreateNonWdpa extends Modules\Component\ImetModule
{
    protected $table = 'forms';

    protected $primaryKey = 'FormID';

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::oecm.context.edit.modules.create_non_wdpa';

    public static array $rules = [
        'Year' => 'required',
        'wdpa_id' => 'required',
        'language' => 'required',
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_title = trans('imet-core::oecm_context.CreateNonWdpa.title');
        $this->module_fields = [
            ['name' => 'version',       'type' => 'version-oecm', 'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.version')],
            ['name' => 'Year',          'type' => 'yearMaxCurrent',                             'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.Year')],
            ['name' => 'language',      'type' => 'toggle-ImetOECM_languages',                    'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.language')],
            ['name' => 'pa_def',        'type' => 'dropdown-ImetV2_NonWdpaPaDef',               'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.pa_def')],
            ['name' => 'country',       'type' => 'dropdown-ImetV2_Country',                           'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.country')],
            ['name' => 'name',          'type' => 'text-area',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.name')],
            ['name' => 'origin_name',   'type' => 'text-area',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.origin_name')],
            ['name' => 'designation',   'type' => 'text-area',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.designation')],
            ['name' => 'designation_eng',   'type' => 'custom::designation-eng', 'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.designation_eng')],
            ['name' => 'designation_type',  'type' => 'toggle-ImetV2_NonWdpaDesignType',        'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.designation_type')],
            ['name' => 'marine',        'type' => 'dropdown-ImetV2_NonWdpaTypology',            'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.marine')],
            ['name' => 'rep_m_area',    'type' => 'numeric',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.rep_m_area')],
            ['name' => 'rep_area',      'type' => 'numeric',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.rep_area')],
            ['name' => 'status',        'type' => 'toggle-ImetV2_NonWdpaStatus',              'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.status')],
            ['name' => 'ownership_type',  'type' => 'dropdown-ImetV2_OwnershipType',              'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.ownership_type')],
            ['name' => 'status_year',    'type' => 'year',                                      'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.status_year')],
        ];

        $this->module_info = trans('imet-core::oecm_context.CreateNonWdpa.module_info');

        parent::__construct($attributes);
    }
}
