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

use Illuminate\Http\Request;
use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\ProtectedArea;
use ModularForms\Models\Traits\Payload;

final class Create extends Modules\Component\ImetModule
{
    protected $table = 'forms';

    protected $primaryKey = 'FormID';

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.create';

    public static array $rules = [
        'Year' => 'required',
        'wdpa_id' => 'required',
        'language' => 'required',
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_title = trans('imet-core::common.Create.title');
        $this->module_fields = [
            ['name' => 'version',   'type' => 'blade-imet-core::v2.context.fields.version', 'label' => trans('imet-core::common.version')],
            ['name' => 'language',  'type' => 'toggle-ImetV2_languages',                    'label' => trans('imet-core::common.language')],
            ['name' => 'Year',      'type' => 'yearMaxCurrent',                             'label' => trans('imet-core::common.Create.fields.Year')],
            ['name' => 'wdpa_id',   'type' => 'imet-core::selector-wdpa',                   'label' => trans_choice('imet-core::common.protected_area.protected_area', 1)],
        ];

        parent::__construct($attributes);
    }

    #[\Override]
    public static function updateModule(Request $request): array
    {
        $records = Payload::decode($request->input('records_json'));

        $pa = ProtectedArea::getByWdpa($records[0]['wdpa_id']);
        $records[0]['Country'] = $pa->country;
        $records[0]['wdpa_id'] = $pa->wdpa_id;
        $records[0]['name'] = $pa->name;

        $records[0]['version'] = Imet::$version;

        $request->merge(['records_json' => Payload::encode($records)]);

        return parent::updateModule($request);
    }
}
