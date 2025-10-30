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

namespace ImetCore\Services\Reports;

use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\Imet\oecm\Report;

class OECM
{
    public static function getElementImpacts(int $form_id): array
    {
        // dd(Modules\Evaluation\KeyElementsImpact::getModuleRecords($form_id)['records']);
        return array_map(function (array $item): array {
            $effects = ['EffectSH', 'EffectER'];
            $item['average'] = '';
            $total_effect = 0;
            $total_effect_length = 0;
            foreach ($effects as $effect) {
                if ($item[$effect] !== null) {
                    $total_effect += $item[$effect];
                    $total_effect_length++;
                }
            }

            if ($total_effect_length > 0) {
                $item['average'] = $total_effect / $total_effect_length;
            }

            return $item;

        },
            Modules\Evaluation\KeyElementsImpact::getModuleRecords($form_id)['records']);
    }

    /**
     * @return array[]
     */
    public static function getStakeholderDirectIndirect(int $form_id): array
    {
        $stake_holders = ['direct' => [], 'indirect' => []];
        $stake_holders['direct'] = (Modules\Context\Stakeholders::calculateWeights($form_id, Modules\Context\Stakeholders::ONLY_DIRECT));
        $stake_holders['indirect'] = (Modules\Context\Stakeholders::calculateWeights($form_id, Modules\Context\Stakeholders::ONLY_INDIRECT));

        arsort($stake_holders['direct']);
        arsort($stake_holders['indirect']);

        return $stake_holders;
    }

    /**
     * @return array[]
     */
    public static function getStakeAnalysis(int $form_id): array
    {
        $direct = Modules\Context\AnalysisStakeholderDirectUsers::getAnalysisElements($form_id);
        $indirect = Modules\Context\AnalysisStakeholderIndirectUsers::getAnalysisElements($form_id);
        $items = array_merge($direct, $indirect);
        $ecosystem = [];
        foreach ($items as $key => $value) {
            $ecosystem[$key] = $value;
        }

        return ['ecosystem_services' => $ecosystem];
    }

    /***
     * @param $form_id
     * @param $key_elements
     * @return array
     */
    public static function getBiodiversityGlobalThreats(int $form_id, $key_elements): array
    {
        $global_threats = array_filter(static::getThreatsIntegration($form_id), fn (array $item): bool => $item['IncludeInStatistics'] !== null);

        $integration_threats = array_filter($key_elements, fn (array $item): bool => $item['group_key'] === 'group1');

        $chart_integration = self::getChartValues($integration_threats, 'Aspect');
        $chart_global = self::getChartValues($global_threats, 'Threat');

        return ['global' => $chart_global, 'integration' => $chart_integration];
    }

    private static function getChartValues(array $values, string $label): array
    {
        $fields = [];
        uasort($values, fn (array $a, array $b): int => $b['__score'] <=> $a['__score']);

        foreach ($values as $value) {
            $fields[$value[$label]] = $value['__score'] !== null ? round($value['__score'], 2) : '-';
        }

        return ['values' => $values, 'chart' => ['values' => (($fields))]];
    }

    public static function getBiodiversityThreats(array $threats, bool $ecosystem = false): array
    {
        $fields = [];
        $score_field = $ecosystem ? 'Importance' : '__score';

        if ($ecosystem) {
            $threats = array_filter($threats, fn (array $item): bool => array_key_exists('__group_stakeholders', $item) && $item['__group_stakeholders'] !== null);
        } else {
            $threats = array_filter($threats, fn (array $item): bool => array_key_exists('__group_stakeholders', $item) && $item['__group_stakeholders'] === null);
        }

        uasort($threats, fn (array $a, array $b): int => $b[$score_field] <=> $a[$score_field]);

        foreach ($threats as $value) {
            if ($value[$score_field] !== null) {
                if (isset($fields[$value['Aspect']]) && $fields[$value['Aspect']] !== '-') {
                    $fields[$value['Aspect'].' '.$value['Comments']] = round($value['__score'], 2);
                } else {
                    $fields[$value['Aspect']] = round($value[$score_field], 2);
                }
            } else {
                $fields[$value['Aspect']] = '-';
            }
        }

        return ['values' => $threats, 'chart' => ['values' => (($fields))]];
    }

    public static function getThreatsIntegration(int $form_id): array
    {
        return collect(Modules\Evaluation\ThreatsIntegration::getModuleRecords($form_id)['records'])
            ->toArray();
    }

    public static function getThreats(int $form_id): array
    {
        $trend_and_threats = static::getThreatsIntegration($form_id);

        return self::getChartValues($trend_and_threats, 'Threat');
    }

    public static function getKeyElementsEcosystems(array $values): array
    {
        return array_filter($values, fn (array $item): bool => $item['__group_stakeholders'] !== null);
    }

    public static function getKeyElementsBiodiversity(array $values): array
    {
        return array_filter($values, fn (array $item): bool => $item['__group_stakeholders'] === null);
    }

    public static function getKeyElements(int $form_id): array
    {
        return collect(Modules\Evaluation\KeyElements::getModuleRecords($form_id)['records'])
            ->filter(fn (array $item) => $item['IncludeInStatistics'])
            ->toArray();
    }

    public static function getObjectives(int $form_id): array
    {

        $objectives = ['context' => [], 'evaluation' => []];
        $objectives['context'] = array_merge(
            self::objectivesSchema('context', 'obj1', Modules\Context\Objectives1::getModuleRecords($form_id)['records']),
            self::objectivesSchema('context', 'obj2', Modules\Context\Objectives2::getModuleRecords($form_id)['records']),
            self::objectivesSchema('context', 'obj3', Modules\Context\Objectives3::getModuleRecords($form_id)['records']),
            self::objectivesSchema('context', 'obj4', Modules\Context\Objectives4::getModuleRecords($form_id)['records']),
            self::objectivesSchema('context', 'obj5', Modules\Context\AnalysisStakeholdersObjectives::getModuleRecords($form_id)['records']),
            self::objectivesSchema('context', 'obj6', Modules\Context\StakeholdersObjectives::getModuleRecords($form_id)['records']));

        $objectives['evaluation'] = array_merge(
            self::objectivesSchema('evaluation', 'context', Modules\Evaluation\ObjectivesContext::getModuleRecords($form_id)['records']),
            self::objectivesSchema('evaluation', 'intrants', Modules\Evaluation\ObjectivesIntrants::getModuleRecords($form_id)['records']),
            self::objectivesSchema('evaluation', 'planning', Modules\Evaluation\ObjectivesPlanification::getModuleRecords($form_id)['records']),
            self::objectivesSchema('evaluation', 'process', Modules\Evaluation\ObjectivesProcessus::getModuleRecords($form_id)['records']),
        );

        return $objectives;
    }

    private static function objectivesSchema(string $index, string $label, $items): array
    {
        $elements = [];
        foreach ($items as $item) {
            if ($item['id']) {
                $elements[$label.'_'.$item['ShortOrLongTerm'].'_'.$index.'_'.$item['id']] = $item['Element'];
            }
        }

        return $elements;
    }

    public static function get_objectives(int $form_id): array
    {
        $objectives = ['context' => [], 'evaluation' => []];
        $report = Report::getByForm($form_id);

        if (count($report) && array_key_exists('objectives', $report[0])) {
            if ($report[0]['objectives']) {
                $result = json_decode((string) $report[0]['objectives'], true);
                foreach ($result as $item) {
                    if (str_contains((string) $item['id'], '_context')) {
                        $objectives['context'][$item['id']] = $item['value'];
                    } else {
                        $objectives['evaluation'][$item['id']] = $item['value'];
                    }
                }
            } else {
                return [];
            }
        }

        return $objectives;
    }
}
