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

use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ImetCore\Models\User\Role;

/**
 * @property string $Type
 */
final class GeneralInfo extends Modules\Component\ImetModule
{
    protected $table = 'context_general_info';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.1';
        $this->module_title = trans('imet-core::v2_context.GeneralInfo.title');
        $this->module_fields = [
            ['name' => 'CompleteName',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.CompleteName')],
            ['name' => 'UsedName',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.UsedName')],
            ['name' => 'CompleteNameWDPA',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.CompleteNameWDPA')],
            ['name' => 'WDPA',  'type' => 'code',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.WDPA')],
            ['name' => 'Type',  'type' => 'blade-imet-core::v2.context.fields.ctx11_type',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Type')],
            ['name' => 'NationalCategory',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.NationalCategory')],
            ['name' => 'IUCNCategory1',  'type' => 'dropdown-ImetV2_IUCNDesignation',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.IUCNCategory1')],
            ['name' => 'IUCNCategory2',  'type' => 'dropdown-ImetV2_IUCNDesignation',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.IUCNCategory2')],
            ['name' => 'IUCNCategory3',  'type' => 'dropdown-ImetV2_IUCNDesignation',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.IUCNCategory3')],
            ['name' => 'MarineDesignation',  'type' => 'suggestion_multiple-ImetV2_MarineDesignation',
                'label' => Template::module_scope(self::MARINE).trans('imet-core::v2_context.GeneralInfo.fields.MarineDesignation')],
            ['name' => 'Country',  'type' => 'dropdown-ImetV2_Country',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Country')],
            ['name' => 'CreationYear',  'type' => 'year',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.CreationYear')],
            ['name' => 'Institution',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Institution')],
            ['name' => 'Biome',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Biome')],
            ['name' => 'Ecoregions',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Ecoregions')],
            ['name' => 'Ecotype',  'type' => 'dropdown_multiple-ImetV2_EcoType',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Ecotype')],
            ['name' => 'ReferenceText',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.ReferenceText')],
            ['name' => 'ReferenceTextValues',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.ReferenceTextValues')],
        ];

        $this->module_info = trans('imet-core::v2_context.GeneralInfo.module_info');

        parent::__construct($attributes);
    }

    #[\Override]
    public static function getVueData(?int $form_id, array $records, array $definitions): array
    {
        $vue_data = parent::getVueData($form_id, $records, $definitions);

        $imet = Imet::query()->find($vue_data['form_id']);
        $pa = Imet::getProtectedArea($imet->wdpa_id);

        $vue_data['records'][0]['CompleteName'] ??= $pa->name;
        $vue_data['records'][0]['WDPA'] ??= ProtectedAreaNonWdpa::isNonWdpa($pa->wdpa_id) ? null : $pa->wdpa_id;
        $vue_data['records'][0]['IUCNCategory1'] ??= $pa->iucn_category;
        $vue_data['records'][0]['Country'] ??= $pa->country;
        $vue_data['records'][0]['CreationYear'] ??= $pa->creation_date !== null ? substr($pa->creation_date, 0, 4) : null;

        return $vue_data;
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = self::replacePredefinedValue($record, 'Type', 'Terrestrial', 'terrestrial');
        $record = self::replacePredefinedValue($record, 'Type', 'Marine', 'marine_and_coastal');
        $record = self::replacePredefinedValue($record, 'Type', 'Mixed', 'marine_and_coastal');
        $record = self::replacePredefinedValue($record, 'Type', 'Terrestre', 'terrestrial');
        $record = self::replacePredefinedValue($record, 'Type', 'Maritime', 'marine_and_coastal');
        $record = self::replacePredefinedValue($record, 'Type', 'Mixte', 'marine_and_coastal');
        $record = self::replacePredefinedValue($record, 'Type', 'Terrestre', 'terrestrial');
        $record = self::replacePredefinedValue($record, 'Type', 'Marinho', 'marine_and_coastal');

        return self::replacePredefinedValue($record, 'Type', 'Misturado', 'marine_and_coastal');
    }
}
