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
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

final class MenacesPressions extends Modules\Component\ImetModule
{
    protected $table = 'context_menaces_pressions';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;
    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.menaces_pressions';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.menaces_pressions';

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\Menaces::class, 'Value'],
        [Modules\Evaluation\InformationAvailability::class, 'Value'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Value'],
        [Modules\Evaluation\ManagementActivities::class, 'Value'],
    ];

    public static $groupsByCategory = [
        ['group0'],
        ['group1', 'group2', 'group3', 'group4', 'group5'],
        ['group6'],
        ['group7'],
        ['group8', 'group9', 'group10', 'group11'],
        ['group12'],
        ['group13', 'group14', 'group15'],
        ['group16'],
        ['group17', 'group18', 'group19', 'group20', 'group21', 'group22'],
        ['group23'],
        ['group24'],
        ['group25'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 5.1';
        $this->module_title = trans('imet-core::v2_context.MenacesPressions.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'text-area',          'label' => trans('imet-core::v2_context.MenacesPressions.fields.Value')],
            ['name' => 'Impact',        'type' => 'rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Impact')],
            ['name' => 'Extension',     'type' => 'rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Extension')],
            ['name' => 'Duration',      'type' => 'rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Duration')],
            ['name' => 'Trend',         'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v2_context.MenacesPressions.fields.Trend')],
            ['name' => 'Probability',   'type' => 'rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Probability')],
            ['name' => 'Comments',      'type' => 'text-area',          'label' => trans('imet-core::v2_context.MenacesPressions.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.MenacesPressions.groups.group0'),
            'group1' => trans('imet-core::v2_context.MenacesPressions.groups.group1'),
            'group2' => trans('imet-core::v2_context.MenacesPressions.groups.group2'),
            'group3' => trans('imet-core::v2_context.MenacesPressions.groups.group3'),
            'group4' => trans('imet-core::v2_context.MenacesPressions.groups.group4'),
            'group5' => trans('imet-core::v2_context.MenacesPressions.groups.group5'),
            'group6' => trans('imet-core::v2_context.MenacesPressions.groups.group6'),
            'group7' => trans('imet-core::v2_context.MenacesPressions.groups.group7'),
            'group8' => trans('imet-core::v2_context.MenacesPressions.groups.group8'),
            'group9' => trans('imet-core::v2_context.MenacesPressions.groups.group9'),
            'group10' => trans('imet-core::v2_context.MenacesPressions.groups.group10'),
            'group11' => trans('imet-core::v2_context.MenacesPressions.groups.group11'),
            'group12' => trans('imet-core::v2_context.MenacesPressions.groups.group12'),
            'group13' => trans('imet-core::v2_context.MenacesPressions.groups.group13'),
            'group14' => trans('imet-core::v2_context.MenacesPressions.groups.group14'),
            'group15' => trans('imet-core::v2_context.MenacesPressions.groups.group15'),
            'group16' => trans('imet-core::v2_context.MenacesPressions.groups.group16'),
            'group17' => trans('imet-core::v2_context.MenacesPressions.groups.group17'),
            'group18' => trans('imet-core::v2_context.MenacesPressions.groups.group18'),
            'group19' => trans('imet-core::v2_context.MenacesPressions.groups.group19'),
            'group20' => trans('imet-core::v2_context.MenacesPressions.groups.group20'),
            'group21' => trans('imet-core::v2_context.MenacesPressions.groups.group21'),
            'group22' => trans('imet-core::v2_context.MenacesPressions.groups.group22'),
            'group23' => trans('imet-core::v2_context.MenacesPressions.groups.group23'),
            'group24' => trans('imet-core::v2_context.MenacesPressions.groups.group24'),
            'group25' => trans('imet-core::v2_context.MenacesPressions.groups.group25'),
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => [
                'group0' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group0'),
                'group1' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group1'),
                'group2' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group2'),
                'group3' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group3'),
                'group4' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group4'),
                //                'group5' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group5'),
                'group6' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group6'),
                'group7' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group7'),
                'group8' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group8'),
                'group9' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group9'),
                'group10' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group10'),
                'group11' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group11'),
                'group12' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group12'),
                'group13' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group13'),
                'group14' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group14'),
                //                'group15' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group15'),
                'group16' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group16'),
                'group17' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group17'),
                'group18' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group18'),
                'group19' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group19'),
                'group20' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group20'),
                'group21' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group21'),
                'group22' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group22'),
                'group23' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group23'),
                'group24' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group24'),
                'group25' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group25'),
            ],
        ];
        $this->ratingLegend = trans('imet-core::v2_context.MenacesPressions.ratingLegend');
        $this->module_info = trans('imet-core::v2_context.MenacesPressions.module_info');

        parent::__construct($attributes);
    }

    #[\Override]
    public static function getVueData(?int $form_id, array $records, array $definitions): array
    {
        $vue_data = parent::getVueData($form_id, $records, $definitions);
        $vue_data['groupsByCategory'] = self::$groupsByCategory;

        return $vue_data;
    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = self::replacePredefinedValue($record, 'Value', 'Other: Increased rainfall and seasonal changes', 'Increased rainfall and seasonal changes');
        $record = self::replacePredefinedValue($record, 'Value', 'Other: Outros: Aumento da precipitação e mudanças sazonais', 'Aumento da precipitação e mudanças sazonais');
        $record = self::replacePredefinedValue($record, 'Value', 'Otro: Aumento de las precipitaciones y cambios estacionales', 'Aumento de las precipitaciones y cambios estacionales');
        $record = self::replacePredefinedValue($record, 'Value', 'Renewable energies', 'Renewable abiotic energy use');
        $record = self::replacePredefinedValue($record, 'Value', 'Energies renouvelables', 'Utilisation de l\'énergie abiotique renouvelable');
        $record = self::replacePredefinedValue($record, 'Value', 'Energias renováveis', 'Uso de energia abiótica renovável');

        return self::replacePredefinedValue($record, 'Value', 'Energías renovables', 'Uso de energía abiótica renovable');
    }

    public static function getStats(?int $form_id): array
    {
        $records = self::getModuleRecords($form_id)['records'];
        $fields = ['Impact', 'Extension', 'Duration', 'Trend', 'Probability'];

        // ### row stats ###
        $row_stats = [];
        foreach ($records as $record) {
            $valuesByRecord = [];
            foreach ($fields as $field) {
                $valuesByRecord[] = $record[$field];
            }

            $row_stats[$record[self::$group_key_field]][] = self::calculateStats($valuesByRecord, true);
        }

        // ### group stats ###
        $group_stats = [];
        foreach ($row_stats as $group => $values) {
            $group_stats[$group] = self::calculateStats($values);
        }

        // ### category stats ###
        $category_stats = [];
        $valuesByCategory = [];
        foreach (self::$groupsByCategory as $index => $groups) {
            $valuesByCategory[$index] = [];
            foreach ($groups as $group) {
                $valuesByCategory[$index][] = $group_stats[$group] ?? null;
            }
        }

        foreach ($valuesByCategory as $values) {
            $stat = self::calculateStats($values);
            $category_stats[] = $stat > 0 ? round($stat * 100 / 3, 2) : '';
        }

        return [
            'rowStats' => $row_stats,
            'categoryStats' => $category_stats,
        ];
    }

    public static function calculateStats($values, $rows = false): ?float
    {
        $numCategories = 4;
        $prod = 1;
        $count = 0;

        foreach ($values as $index => $value) {
            if ($value !== null) {
                if ($index === 3 && $rows === true) {
                    $prod *= ($numCategories + 1) / 2 - $value * ($numCategories - 1) / 4;
                } else {
                    $prod *= $numCategories - $value;
                }

                $count++;
            }
        }

        return $count > 0
            ? (4 - round($prod ** (1 / $count), 2))
            : null;
    }

    public static function get_marine_predefined(): array
    {
        $predefined = (new self)->predefined_values['values'];

        return [
            $predefined['group0'][4],
            $predefined['group0'][5],
            $predefined['group7'][2],
            $predefined['group7'][3],
            $predefined['group7'][4],
            $predefined['group12'][5],
            $predefined['group12'][6],
            $predefined['group12'][7],
            $predefined['group12'][8],
        ];
    }

    public static function get_terrestrial_groups(): array
    {
        return collect((new self)->module_groups)
            ->filter(function ($group, $key) {
                return in_array($key, ['group1', 'group2', 'group3', 'group8', 'group9', 'group10']);
            })
            ->keys()
            ->toArray();
    }

    public static function get_marine_groups(): array
    {
        return collect((new self)->module_groups)
            ->filter(function ($group, $key) {
                return in_array($key, ['group4', 'group11']);
            })
            ->keys()
            ->toArray();
    }
}
