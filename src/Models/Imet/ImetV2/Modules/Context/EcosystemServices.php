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

use ImetCore\Helpers\SelectionList;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;

final class EcosystemServices extends Modules\Component\ImetModule
{
    protected $table = 'context_ecosystem_services';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.ecosystem_services';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.ecosystem_services';

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ImportanceEcosystemServices::class, 'Element'],
        [Modules\Evaluation\InformationAvailability::class, 'Element'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Element'],
        [Modules\Evaluation\ManagementActivities::class, 'Element'],
        [Modules\Evaluation\EcosystemServices::class, 'Element'],
    ];

    public static array $groupsByCategory = [
        ['group0', 'group1', 'group2'],
        ['group3', 'group4'],
        ['group5', 'group6', 'group7', 'group8'],
        ['group9'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 7.1';
        $this->module_title = trans('imet-core::v2_context.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Element',               'type' => 'text-area',          'label' => trans('imet-core::v2_context.EcosystemServices.fields.Element')],
            ['name' => 'Importance',            'type' => 'toggle-ImetV2_EcosystemServicesImportance',   'label' => trans('imet-core::v2_context.EcosystemServices.fields.Importance')],
            ['name' => 'ImportanceRegional',    'type' => 'rating-0to3',   'label' => trans('imet-core::v2_context.EcosystemServices.fields.ImportanceRegional')],
            ['name' => 'ImportanceGlobal',      'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v2_context.EcosystemServices.fields.ImportanceGlobal')],
            ['name' => 'Observations',          'type' => 'text-area',          'label' => trans('imet-core::v2_context.EcosystemServices.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group0'),
                'group1' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group1'),
                'group2' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group2'),
                'group3' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group3'),
                'group4' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group4'),
                'group5' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group5'),
                'group6' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group6'),
                'group7' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group7'),
                'group8' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group8'),
                'group9' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group9'),
            ],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.EcosystemServices.groups.group0'),
            'group1' => trans('imet-core::v2_context.EcosystemServices.groups.group1'),
            'group2' => trans('imet-core::v2_context.EcosystemServices.groups.group2'),
            'group3' => trans('imet-core::v2_context.EcosystemServices.groups.group3'),
            'group4' => trans('imet-core::v2_context.EcosystemServices.groups.group4'),
            'group5' => trans('imet-core::v2_context.EcosystemServices.groups.group5'),
            'group6' => trans('imet-core::v2_context.EcosystemServices.groups.group6'),
            'group7' => trans('imet-core::v2_context.EcosystemServices.groups.group7'),
            'group8' => trans('imet-core::v2_context.EcosystemServices.groups.group8'),
            'group9' => trans('imet-core::v2_context.EcosystemServices.groups.group9'),
        ];

        $this->module_info = trans('imet-core::v2_context.EcosystemServices.module_info');
        $this->ratingLegend = trans('imet-core::v2_context.EcosystemServices.ratingLegend');
        parent::__construct($attributes);

    }

    #[\Override]
    public static function getVueData(?int $form_id, array $data, array $definitions): array
    {
        $vue_data = parent::getVueData($form_id, $data, $definitions);
        $vue_data['groupsByCategory'] = self::$groupsByCategory;

        return $vue_data;
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.0 -> v2.0b  ####
        $record = self::dropIfPredefinedValueObsolete($record, 'Element', 'other');
        $record = self::dropIfPredefinedValueObsolete($record, 'Element', 'other - legal');

        return self::dropIfPredefinedValueObsolete($record, 'Element', 'other - illegal');
    }

    /**
     * Override
     */
    #[\Override]
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        if ($record['Importance'] !== null
            || $record['ImportanceRegional'] !== null
            || $record['ImportanceGlobal'] !== null) {
            return false;
        }

        return true;
    }

    /**
     * @return float[]|null[]
     */
    public static function getStats(?int $form_id): array
    {
        $records = self::getModuleRecords($form_id)['records'];
        $category_stats = [];

        foreach (self::$groupsByCategory as $category_index => $groups) {
            $category_sum = 0;
            $category_count = 0;
            foreach ($records as $record) {
                if (in_array($record['group_key'], $groups)) {
                    $row_stats = self::row_stats($record);
                    if ($row_stats !== null) {
                        $category_sum += floatval($row_stats);
                        $category_count++;
                    }
                }
            }

            $category_stats[$category_index] = $category_sum > 0 ? (($category_sum / $category_count) * 100 / 3.0) : null;
        }

        return $category_stats;
    }

    private static function row_stats(array $record): ?float
    {
        if ($record['Importance'] !== null && $record['ImportanceRegional'] !== null && $record['ImportanceGlobal'] !== null) {
            return floatval($record['Importance'])
                + (floatval($record['ImportanceRegional']) / 3)
                + ((2 - floatval($record['ImportanceGlobal'])) / 4);
        }

        return null;
    }

    #[\Override]
    protected function customValue(array $record, array $field): string|array|null
    {
        $value = $record[$field['name']] ?? null;
        if ($field['type'] === 'toggle-ImetV2_EcosystemServicesImportance') {
            $list = SelectionList::getList('ImetV2_EcosystemServicesImportance');

            return $list[$value] ?? null;
        }

        return $value;
    }

    public static function get_spillover_predefined(): array
    {
        $predefined = (new self)->predefined_values['values'];

        return [
            $predefined['group0'][5],
            $predefined['group9'][8],
        ];
    }

    public static function get_connectivity_predefined(): array
    {
        $predefined = (new self)->predefined_values['values'];

        return [
            $predefined['group9'][9],
        ];
    }
}
