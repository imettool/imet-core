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

namespace ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders;

use ImetCore\Helpers\ScalingUp\Common;
use ImetCore\Models\Country;
use ImetCore\Models\Imet\ImetV2\Modules;
use ModularForms\Helpers\Locale;

final readonly class GeneralInfoDataProvider implements DataProviderInterface
{
    public function __construct(
        private ?int $scalingId = null
    ) {}

    /**
     * Get general information aggregated from multiple protected areas
     */
    public function getGeneralInfo(array $formIds): array
    {
        $generalElements = $this->initializeGeneralElements();

        foreach ($formIds as $formId) {
            $this->processFormData($formId, $generalElements);
        }

        $this->finalizeData($generalElements);

        return $generalElements;
    }

    /**
     * Initialize the general elements structure
     */
    private function initializeGeneralElements(): array
    {
        return [
            'network' => [],
            'eco_regions' => [],
            'countries' => [],
            'total_surface_protected_areas' => 0,
            'local_mission' => [],
            'local_objective' => [],
            'local_vision' => [],
        ];
    }

    /**
     * Process data for a single form/protected area
     */
    private function processFormData(int $formId, array &$generalElements): void
    {
        $generalInfoData = $this->getGeneralInfoData($formId);
        $visionData = $this->getVisionData($formId);

        $generalElements['total_surface_protected_areas'] += $this->getProtectedAreaSurface($formId);

        if ($generalInfoData !== null && $generalInfoData !== []) {
            $this->processGeneralInfo($generalInfoData, $generalElements);
        }

        if ($visionData !== null && $visionData !== []) {
            $this->processVisionData($visionData, $generalInfoData, $generalElements);
        }
    }

    /**
     * Get general info data for a form
     */
    private function getGeneralInfoData(int $formId): ?array
    {
        $records = Modules\Context\GeneralInfo::getModuleRecords($formId)['records'];

        return $records[0] ?? null;
    }

    /**
     * Get vision/mission data for a form
     */
    private function getVisionData(int $formId): ?array
    {
        $records = Modules\Context\Missions::getModuleRecords($formId)['records'];

        return $records[0] ?? null;
    }

    /**
     * Get a protected area surface
     */
    private function getProtectedAreaSurface(int $formId): int|float|null
    {
        return Modules\Context\Areas::getArea($formId);
    }

    /**
     * Process general information data
     */
    private function processGeneralInfo(array $generalInfo, array &$generalElements): void
    {
        $this->addCountry($generalInfo, $generalElements);
        $this->addNetwork($generalInfo, $generalElements);
        $this->addEcoregions($generalInfo, $generalElements);
    }

    /**
     * Add country to the list if not already present
     */
    private function addCountry(array $generalInfo, array &$generalElements): void
    {
        if (! $generalInfo['Country']) {
            return;
        }

        $countryName = $this->getCountryName($generalInfo['Country']);

        if ($countryName && ! in_array($countryName, $generalElements['countries'], true)) {
            $generalElements['countries'][] = $countryName;
        }
    }

    /**
     * Get localized country name
     */
    private function getCountryName(string $isoCode): ?string
    {
        $country = Country::getByISO($isoCode);

        if (! $country instanceof Country) {
            return null;
        }

        $lang = Locale::lower();
        $nameField = 'name_'.(trim((string) $lang) === '' ? 'en' : $lang);

        return $country->$nameField ?? null;
    }

    /**
     * Add network/complete name to the list
     */
    private function addNetwork(array $generalInfo, array &$generalElements): void
    {
        if (filled($generalInfo['CompleteName'])) {
            $generalElements['network'][] = $generalInfo['CompleteName'];
        }
    }

    /**
     * Add ecoregions to the list
     */
    private function addEcoregions(array $generalInfo, array &$generalElements): void
    {
        if (filled($generalInfo['Ecoregions'])) {
            $generalElements['eco_regions'][] = $generalInfo['Ecoregions'];
        }
    }

    /**
     * Process vision, mission, and objective data
     */
    private function processVisionData(array $visionData, ?array $generalInfoData, array &$generalElements): void
    {
        if (! $generalInfoData || blank($generalInfoData['CompleteName'])) {
            return;
        }

        $completeName = $generalInfoData['CompleteName'];

        if (filled($visionData['LocalMission'])) {
            $generalElements['local_mission'][] = $completeName;
        }

        if (filled($visionData['LocalObjective'])) {
            $generalElements['local_objective'][] = $completeName;
        }

        if (filled($visionData['LocalVision'])) {
            $generalElements['local_vision'][] = $completeName;
        }
    }

    /**
     * Finalize data (rounding, formatting, etc.)
     */
    private function finalizeData(array &$generalElements): void
    {
        $generalElements['total_surface_protected_areas'] = Common::round_number(
            $generalElements['total_surface_protected_areas']
        );
    }
}
