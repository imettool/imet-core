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

namespace ImetCore\Models\Imet\ImetOecm\Modules\Context;

use Illuminate\Support\Str;
use ImetCore\Models\Imet\ImetOecm\Modules;
use ImetCore\Models\User\Role;

final class Stakeholders extends Modules\Component\ImetModule
{
    protected $table = 'context_stakeholders_natural_resources';

    public bool $fixed_rows = false;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::oecm.context.edit.modules.stakeholders';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::oecm.context.show.modules.stakeholders';

    protected static $DEPENDENCIES = [
        [AnalysisStakeholderDirectUsers::class, 'Element'],
        [AnalysisStakeholderIndirectUsers::class, 'Element'],
        [Modules\Evaluation\SupportsAndConstraints::class, 'Element'],
        [Modules\Evaluation\SupportsAndConstraintsIntegration::class, 'Element'],
        [Modules\Evaluation\CapacityAdequacy::class, 'Element'],
        [Modules\Evaluation\StaffCompetence::class, 'Element'],
        [Modules\Evaluation\StakeholderCooperation::class, 'Element'],
    ];

    //    public static array $rules = [
    //        'Element' => 'required',
    //        'UsesCategories' => 'required_with:Element',
    //        'LevelEngagement' => 'required_unless:GeographicalProximity,true',
    //        'LevelInterest' => 'required_unless:GeographicalProximity,true',
    //        'LevelExpertise' => 'required_unless:GeographicalProximity,true',
    //    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'SA 1';
        $this->module_title = trans('imet-core::oecm_context.Stakeholders.title');
        $this->module_fields = [
            ['name' => 'Element',               'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'GeographicalProximity', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.GeographicalProximity')],
            ['name' => 'UsesCategories',        'type' => 'dropdown_multiple-ImetOECM_UsesCategories', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.UsesCategories')],
            ['name' => 'DirectUser',            'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.DirectUser')],
            ['name' => 'LevelEngagement',       'type' => 'rating-0to3', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.LevelEngagement')],
            ['name' => 'LevelInterest',         'type' => 'rating-0to3', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.LevelInterest')],
            ['name' => 'LevelExpertise',        'type' => 'rating-0to3', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.LevelExpertise')],
            ['name' => 'Comments',              'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.Stakeholders.groups');
        $this->module_info = trans('imet-core::oecm_context.Stakeholders.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.Stakeholders.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Remove all empty records: where "Element" is empty
     */
    #[\Override]
    public static function updateModuleRecords(array $records, ?int $form_id): void
    {
        foreach ($records as $index => $record) {
            // Ensure no "newline" (or other not allowed entities) are saved
            $record['Element'] = Str::replace("\n", '', $record['Element']);
            $record['Element'] = Str::replace("\r", '', $record['Element']);
            $record['Element'] = Str::replace("\t", '', $record['Element']);
            $record['Element'] = Str::replace('&nbsp;', '', $record['Element']);
            $record['Element'] = trim($record['Element']);
            // Remove all empty records: where "Element" is empty
            if ($record['Element'] === null || trim($record['Element']) === '') {
                unset($records[$index]);
            }
        }

        parent::updateModuleRecords($records, $form_id);
    }

    public const int ALL_USERS = 0;

    public const int ONLY_DIRECT = 1;

    public const int ONLY_INDIRECT = 2;

    /**
     * Override: get the list with direct/indirect
     */
    #[\Override]
    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records and compare
        $existing_values = self::getModule($form_id)->pluck('DirectUser', 'Element')->toArray();
        $updated_values = collect($records)->pluck('DirectUser', 'Element')->toArray();

        // Make diff to find out what to drop
        foreach ($updated_values as $elem => $direct) {
            if (array_key_exists($elem, $existing_values)
                && $direct === $existing_values[$elem]) {
                unset($existing_values[$elem]);
            }
        }

        return array_keys($existing_values);
    }

    /**
     * Retrieve stakeholders' list (grouped or not)
     */
    public static function getStakeholders(?int $form_id, int $mode = self::ALL_USERS, bool $with_categories = false): array
    {
        $query = self::getModule($form_id);

        if ($mode === self::ONLY_DIRECT) {
            $query = $query->where('DirectUser', true);
        } elseif ($mode === self::ONLY_INDIRECT) {
            $query = $query->where('DirectUser', '!=', true);
        }

        if ($with_categories) {
            $query = $query
                ->groupBy('Element')
                ->map(function ($group) {
                    $categories = [];
                    $group->map(function ($item) use (&$categories): void {
                        if ($item['UsesCategories'] !== null) {
                            $categories = array_merge($categories, json_decode((string) $item['UsesCategories']));
                        }
                    });

                    return json_encode($categories);
                });
        } else {
            $query = $query
                ->pluck('Element')
                ->unique();
        }

        return $query
            ->toArray();
    }

    /**
     * Retrieve stakeholders' wights
     */
    public static function calculateWeights(?int $form_id, int $mode = self::ALL_USERS): array
    {
        $query = self::getModule($form_id);

        if ($mode === self::ONLY_DIRECT) {
            $query = $query->where('DirectUser', true);
        } elseif ($mode === self::ONLY_INDIRECT) {
            $query = $query->where('DirectUser', '!=', true);
        }

        $records = $query->toArray();

        return collect($records)
            ->filter(fn (array $item): bool => filled($item['Element']))
            ->map(function (array $item): array {

                $UsesCategories = filled($item['UsesCategories']) ? json_decode((string) $item['UsesCategories']) : null;
                $UsesCategories = is_array($UsesCategories) ? count($UsesCategories) : null;

                $sum = $item['GeographicalProximity'] ? 4 : 0;
                $sum += $UsesCategories ?? 0; // max 4
                $sum += $item['DirectUser'] ? 7 : 0;
                $sum += $item['LevelEngagement'] ?? 0;
                $sum += $item['LevelInterest'] ?? 0;
                $sum += $item['LevelExpertise'] ?? 0;

                $max_score =
                    4 // GeographicalProximity
                    + 4 // UsesCategories
                    + 7 // DirectUser
                    + 3 // LevelEngagement
                    + 3 // LevelInterest
                    + 3; // LevelExpertise

                $item['__weight'] = round($sum * 100 / $max_score, 0);

                $item['Element'] = Str::replace("\n", '', $item['Element']);

                return $item;
            })
            ->pluck('__weight', 'Element')
            ->toArray();
    }
}
