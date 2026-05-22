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

use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use ImetCore\Models\Species;

final readonly class ManagementContextDataProvider extends BaseDataProvider
{
    private const int ECOSYSTEM_SERVICES_LIMIT = 10;

    private const int THREATS_LIMIT = 5;

    private const int MIN_OCCURRENCES = 2; // Minimum occurrences to include in results

    /**
     * Get management context data for protected areas
     */
    public function getManagementContext(array $formIds): array
    {
        $keyElements = $this->initializeKeyElements();
        $counters = $this->initializeCounters();

        foreach ($formIds as $formId) {
            $protectedArea = $this->getProtectedAreaByFormId($formId);
            $elements = $this->retrieveKeyElements($formId);

            $this->processSpecies($elements['species'], $counters['species'], $keyElements, $protectedArea['name']);
            $this->processElements($elements, $counters['elements'], $keyElements, $protectedArea['name']);
        }

        $this->filterAndSort($keyElements, $counters);
        $this->attachStatistics($keyElements, $counters);

        return $keyElements;
    }

    /**
     * Initialize key elements structure
     */
    private function initializeKeyElements(): array
    {
        return [
            'species' => ['group0' => [], 'group1' => []],
            'habitats' => [],
            'climate_change' => [],
            'ecosystem_services' => [],
            'threats' => [],
            'species_statistics' => [],
        ];
    }

    /**
     * Initialize counters for tracking occurrences
     */
    private function initializeCounters(): array
    {
        return [
            'species' => ['group0' => [], 'group1' => []],
            'elements' => [
                'habitats' => [],
                'climate_change' => [],
                'ecosystem_services' => [],
                'threats' => [],
            ],
        ];
    }

    /**
     * Get protected area information by form ID
     */
    private function getProtectedAreaByFormId(int $formId): array
    {
        if ($this->getScalingId() !== null) {
            return ScalingUpWdpa::getCustomNames($formId, $this->getScalingId())->toArray();
        }

        $imet = Imet::query()->where(['FormID' => $formId])->first();

        return $imet ? $imet->toArray() : ['name' => ''];
    }

    /**
     * Retrieve key elements from modules for a form
     */
    private function retrieveKeyElements(int $formId): array
    {
        return [
            'species' => $this->getSpeciesData($formId),
            'habitats' => $this->getModuleAspects(Modules\Evaluation\ImportanceHabitats::class, $formId),
            'climate_change' => $this->getModuleAspects(Modules\Evaluation\ImportanceClimateChange::class, $formId),
            'ecosystem_services' => $this->getModuleAspects(Modules\Evaluation\ImportanceEcosystemServices::class, $formId),
            'threats' => $this->getModuleAspects(Modules\Evaluation\Menaces::class, $formId),
        ];
    }

    /**
     * Get species data with group keys
     */
    private function getSpeciesData(int $formId): array
    {
        return Modules\Evaluation\ImportanceSpecies::getModule($formId)
            ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
            ->map(fn ($item): array => [
                $item['group_key'] => Species::getPlainNameByTaxonomy($item['Aspect']),
            ])
            ->all();
    }

    /**
     * Get module aspects that should be included in statistics
     */
    private function getModuleAspects(string $moduleClass, int $formId): array
    {
        return $moduleClass::getModule($formId)
            ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
            ->pluck('Aspect')
            ->toArray();
    }

    /**
     * Process species data and update counters
     */
    private function processSpecies(
        array $speciesData,
        array &$speciesCount,
        array &$keyElements,
        string $name
    ): void {
        foreach ($speciesData as $arraySpecies) {
            foreach ($arraySpecies as $group => $species) {
                $speciesCount[$group][$species] = ($speciesCount[$group][$species] ?? 0) + 1;
                $keyElements['species'][$group][$species][0][] = $name;
            }
        }
    }

    /**
     * Process element data (habitats, threats, etc.) and update counters
     */
    private function processElements(
        array $retrieveKeyElements,
        array &$elementCounts,
        array &$keyElements,
        string $name
    ): void {
        foreach (array_keys($elementCounts) as $key) {
            if (blank($retrieveKeyElements[$key])) {
                continue;
            }

            foreach ($retrieveKeyElements[$key] as $item) {
                $elementCounts[$key][$item] = ($elementCounts[$key][$item] ?? 0) + 1;
                $keyElements[$key][$item][0][] = $name;
            }
        }
    }

    /**
     * Filter and sort all elements by occurrence count
     */
    private function filterAndSort(array &$keyElements, array $counters): void
    {
        // Filter and sort regular elements
        foreach (array_keys($counters['elements']) as $key) {
            $keyElements[$key] = $this->filterByMinOccurrences($keyElements[$key]);
            $this->sortByOccurrenceCount($keyElements[$key]);
        }

        // Filter and sort species groups
        foreach (['group0', 'group1'] as $group) {
            $keyElements['species'][$group] = $this->filterByMinOccurrences($keyElements['species'][$group]);
            $this->sortByOccurrenceCount($keyElements['species'][$group]);
        }
    }

    /**
     * Filter elements that appear in at least MIN_OCCURRENCES protected areas
     */
    private function filterByMinOccurrences(array $elements): array
    {
        return array_filter(
            $elements,
            fn (array $v): bool => count($v[0]) >= self::MIN_OCCURRENCES
        );
    }

    /**
     * Sort elements by occurrence count (descending)
     */
    private function sortByOccurrenceCount(array &$elements): void
    {
        uasort($elements, fn (array $a, array $b): int => count($b[0]) <=> count($a[0]));
    }

    /**
     * Attach statistics and apply limits
     */
    private function attachStatistics(array &$keyElements, array $counters): void
    {
        // Filter and sort counters
        $filteredCounters = $this->filterAndSortCounters($counters);

        // Attach statistics
        $keyElements['species_statistics'] = $filteredCounters['species'];
        $keyElements['habitats_statistics'] = $filteredCounters['elements']['habitats'];
        $keyElements['climate_change_statistics'] = $filteredCounters['elements']['climate_change'];
        $keyElements['ecosystem_services_statistics'] = array_slice(
            $filteredCounters['elements']['ecosystem_services'],
            0,
            self::ECOSYSTEM_SERVICES_LIMIT
        );
        $keyElements['threats_statistics'] = array_slice(
            $filteredCounters['elements']['threats'],
            0,
            self::THREATS_LIMIT
        );

        // Apply limits to main data
        $keyElements['ecosystem_services'] = array_slice(
            $keyElements['ecosystem_services'],
            0,
            self::ECOSYSTEM_SERVICES_LIMIT
        );
        $keyElements['threats'] = array_slice(
            $keyElements['threats'],
            0,
            self::THREATS_LIMIT
        );
    }

    /**
     * Filter and sort all counters
     */
    private function filterAndSortCounters(array $counters): array
    {
        $filtered = [
            'species' => [],
            'elements' => [],
        ];

        // Filter and sort species counters
        foreach (['group0', 'group1'] as $group) {
            $filtered['species'][$group] = array_filter(
                $counters['species'][$group],
                fn (int $v): bool => $v >= self::MIN_OCCURRENCES
            );
            uasort($filtered['species'][$group], fn ($a, $b): int => $b <=> $a);
        }

        // Filter and sort element counters
        foreach (array_keys($counters['elements']) as $key) {
            $filtered['elements'][$key] = array_filter(
                $counters['elements'][$key],
                fn (int $v): bool => $v >= self::MIN_OCCURRENCES
            );
            uasort($filtered['elements'][$key], fn ($a, $b): int => $b <=> $a);
        }

        return $filtered;
    }
}
