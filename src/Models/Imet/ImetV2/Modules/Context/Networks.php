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

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\User\Role;
use ModularForms\Helpers\Type\JSON;

final class Networks extends Modules\Component\ImetModule
{
    protected $table = 'context_networks';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('imet-core::v2_context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'imet-core::selector-wdpa_multiple',   'label' => trans('imet-core::v2_context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.Networks.groups.group0'),
            'group1' => trans('imet-core::v2_context.Networks.groups.group1'),
            'group2' => trans('imet-core::v2_context.Networks.groups.group2'),
        ];

        $this->module_info = trans('imet-core::v2_context.Networks.module_info');

        parent::__construct($attributes);
    }

    /**
     * Override: upgrade module records during retrieving
     */
    #[\Override]
    public static function getModule(?int $form_id = null): Collection
    {
        $models = parent::getModule($form_id);

        // Upgrade existing data
        $models->map(function ($model): void {
            $model->timestamps = false;
            $model->fill(
                self::upgradeModule($model->toArray())
            )->save();
        });

        return $models;
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ### Update "ProtectedAreas" to comma-separated list of WDPA ids ###
        if ($record['ProtectedAreas'] !== null && Str::contains($record['ProtectedAreas'], '_')) {

            $pas = explode(',', $record['ProtectedAreas']);

            // Convert global_id to wdpa
            $pas = collect($pas)->map(function ($pa) {
                if (Str::startsWith($pa, 'OFAC_')) {
                    $model = ProtectedArea::query()->find($pa);  // for OFAC: global_id is 'OFAC_' + local_id

                    return $model->wdpa_id ?? null;
                }

                return explode('_', $pa)[1];
                // for other regions: global_id is region + wdpa

            })->all();

            // Convert JSON to comma-separated list
            $record['ProtectedAreas'] = implode(',', $pas);
        }

        return $record;
    }

    #[\Override]
    protected function customValue(array $record, array $field): string|array|null
    {
        $value = $record[$field['name']] ?? null;
        if ($field['name'] === 'ProtectedAreas') {
            $pas = explode(',', (string) $value);
            $value = '';
            $pas_length = count($pas);
            for ($index = 0; $index < $pas_length; $index++) {
                $model = ProtectedArea::query()->where('wdpa_id', '=', $pas[$index])->get()->toArray();
                if (filled($model)) {
                    if ($index === 0) {
                        $value .= $model[0]['name'];
                    } else {
                        $value .= ', '.$model[0]['name'];
                    }
                }
            }
        }

        return $value;
    }
}
