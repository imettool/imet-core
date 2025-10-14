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

namespace ImetCore\Models\Imet\v1\Modules\Context;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\User\Role;
use ModularForms\Helpers\Type\JSON;

class Networks extends Modules\Component\ImetModule
{
    protected $table = 'context_networks';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('imet-core::v1_context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'imet-core::selector-wdpa_multiple',   'label' => trans('imet-core::v1_context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.Networks.groups.group0'),
            'group1' => trans('imet-core::v1_context.Networks.groups.group1'),
            'group2' => trans('imet-core::v1_context.Networks.groups.group2'),
        ];

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
                static::upgradeModule($model->toArray())
            )->save();
        });

        return $models;
    }

    public static function upgradeModule($record, $imet_version = null): array
    {

        if ($record['ProtectedAreas'] !== null && Str::contains($record['ProtectedAreas'], '[')) {

            $pas = json_decode($record['ProtectedAreas']);
            $pas = array_filter($pas);

            // Convert local_id to wdpa
            $pas = collect($pas)->map(function (string $pa) {
                $model = ProtectedArea::query()->find('OFAC_'.$pa);

                return $model->wdpa_id ?? null;
            })->all();
            $pas = array_filter($pas);

            // Convert JSON to comma-separated list
            $record['ProtectedAreas'] = implode(',', $pas);
        }

        return $record;
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Networks',
            'fields' => [
                'NetworkName', 'ProtectedAreas', 'NetworkType',
            ],
        ];
    }

    /**
     * Review data from SQLITE
     */
    protected static function conversionDataReview($record, $sqlite_connection): array
    {
        $record = self::convertGroupLabelToKey($record, 'NetworkType');

        if (filled($record['ProtectedAreas'])) {
            $pas = json_decode($record['ProtectedAreas']);
            $pas = array_filter($pas);
            $pas = collect($pas)->map(function ($pa) use ($sqlite_connection): ?string {
                return Modules\Component\ImetModule::wdpaBySqliteProtectedAreaID($pa, $sqlite_connection);
            })->all();
            $pas = array_filter($pas);
            $record['ProtectedAreas'] = implode(',', $pas);
        }

        return $record;
    }
}
