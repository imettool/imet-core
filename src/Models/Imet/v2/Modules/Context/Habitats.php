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

namespace ImetCore\Models\Imet\v2\Modules\Context;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

final class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'context_habitats';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ImportanceHabitats::class, 'EcosystemType'],
        [Modules\Evaluation\InformationAvailability::class, 'EcosystemType'],
        [Modules\Evaluation\KeyConservationTrend::class, 'EcosystemType'],
        [Modules\Evaluation\ManagementActivities::class, 'EcosystemType'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3';
        $this->module_title = trans('imet-core::v2_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'suggestion-ImetV2_Habitats',   'label' => trans('imet-core::v2_context.Habitats.fields.EcosystemType')],
            ['name' => 'Value',                     'type' => 'text-area',   'label' => trans('imet-core::v2_context.Habitats.fields.Value')],
            ['name' => 'Area',                      'type' => 'numeric',   'label' => trans('imet-core::v2_context.Habitats.fields.Area')],
            ['name' => 'DesiredConservationStatus', 'type' => 'numeric',   'label' => trans('imet-core::v2_context.Habitats.fields.DesiredConservationStatus')],
            ['name' => 'Sectors',                   'type' => 'text-area',   'label' => trans('imet-core::v2_context.Habitats.fields.Sectors')],
            ['name' => 'Comments',                  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Habitats.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v2_context.Habitats.module_info');

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.8 -> v2.10 (revised habitat list)  ####
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Forest temperate', 'forest_temperate_boreal');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Forest boreal', 'forest_temperate_boreal');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical moist lowland', 'forest_moist_lowland');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical moist montane', 'forest_moist_montane');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical dry', 'forest_dry');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical swamp', 'swamp');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Savanna-moist', 'savanna_moist');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Savanna-dry', 'savanna_dry');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Shrubland-Subtropical/tropical dry', 'shrubland_dry_moist');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Shrubland-Subtropical/tropical moist', 'shrubland_dry_moist');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Shrubland-Subtropical/tropical high altitude', 'shrubland_high_altitude');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Shrubland temperate', 'shrubland_temperate_boreal');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Shrubland boreal', 'shrubland_temperate_boreal');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Grassland Temperate', 'grassland_temperate');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Grassland subtropical/tropical dry', 'grassland_dry_moist');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Wetlands (inland)-Permanent freshwater lakes', 'wetlands_lakes');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Desert – Temperate', 'desert');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Desert – Cold', 'desert');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Desert - Hot', 'desert');
        $record = self::replacePredefinedValue($record, 'EcosystemType', 'Plantations', 'artificial');

        // ####  v2.13.7 -> v3.*  ####
        return self::dropField($record, 'TerrestrialOrMarine');
    }

    /**
     *  Update 2.7 -> v2.8 (marine pas): merge CTX 4.3.2 into 4.3 ####
     */
    public static function mergeFromCTX432(array $data): array
    {
        if (array_key_exists('HabitatsMarine', $data) && filled($data['HabitatsMarine'])) {

            foreach ($data['HabitatsMarine'] as $record) {

                // #### Updates inherited from CTX4.3.2 ####
                $record['Presence'] = in_array($record['Presence'], [
                    'Present', 'Absent', 'Dominant', // EN
                    'Présent', 'Absent', 'Dominant', // FR
                    'Presente', 'Ausente', 'Dominante', // PT
                ]) ? $record['Presence'] : null;

                $data[self::getShortClassName()][] = [
                    self::UPDATED_AT => $record[self::UPDATED_AT],
                    self::UPDATED_BY => $record[self::UPDATED_BY],
                    'EcosystemType' => $record['HabitatType'],
                    'Value' => $record['Presence'],
                    'Area' => $record['Area'],
                    'Comments' => $record['Source'].'. '.$record['Description'],
                ];
            }
        }

        return $data;
    }

    /**
     * Update 2.7 -> v2.8 (marine pas): merge CTX 4.4 into 4.3 ####
     */
    public static function mergeFromCTX44(array $data): array
    {
        if (array_key_exists('LandCover', $data) && filled($data['LandCover'])) {
            foreach ($data['LandCover'] as $record) {
                $data[self::getShortClassName()][] = [
                    self::UPDATED_AT => $record[self::UPDATED_AT],
                    self::UPDATED_BY => $record[self::UPDATED_BY],
                    'EcosystemType' => $record['CoverType'],
                    'Area' => $record['HistoricalArea'],
                    'DesiredConservationStatus' => $record['ConservationStatusArea'] ?? null,
                    'Comments' => $record['Notes'],
                ];
            }
        }

        return $data;
    }
}
