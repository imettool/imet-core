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

namespace ImetCore\Models\Imet\ImetV2\Modules\Evaluation;

use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;

final class Menaces extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_menaces';

    public bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.evaluation.edit.modules.menaces';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.evaluation.show.modules.menaces';

    protected static $DEPENDENCY_ON = 'Aspect';

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect'],
    ];

    public static array $extra_raw_fields = ['rank' => '_rank',
        'Impact' => '_Impact',
        'Extension' => '_Extension',
        'Duration' => '_Duration',
        'Trend' => '_Trend',
        'Probability' => '_Probability'];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3';
        $this->module_title = trans('imet-core::v2_evaluation.Menaces.title');
        $this->module_fields = [
            ['name' => 'Aspect',                'type' => 'blade-imet-core::v2.evaluation.fields.menaces_aspect',   'label' => trans('imet-core::v2_evaluation.Menaces.fields.Aspect')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.Menaces.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.Menaces.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => null,
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.Menaces.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.Menaces.module_info_Rating');

        parent::__construct($attributes);
    }

    /**
     * Prefill from CTX
     */
    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? self::getMenacesPressions($form_id)
                    ->map(fn (Modules\Context\MenacesPressions $item): mixed => $item['Value'])
                    ->filter()
                    ->values()
                : [],
        ];
    }

    protected static function arrange_records(?array $predefined_values, array $records, array $empty_record): array
    {
        $records = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        // Inject rankings
        foreach (self::getMenacesPressions($form_id)->values()->toArray() as $index => $record) {
            $records[$index]['_rank'] = -$record['_rank'] * 100 / 3.0;
            $records[$index]['_Impact'] = $record['Impact'];
            $records[$index]['_Extension'] = $record['Extension'];
            $records[$index]['_Duration'] = $record['Duration'];
            $records[$index]['_Trend'] = $record['Trend'];
            $records[$index]['_Probability'] = $record['Probability'];
            $records[$index]['_categories'] = $record['_categories'];
        }

        return $records;
    }

    /**
     * @param array $groups
     * @param $needle
     * @return int|null
     */
    private static function find_category_id(array $groups, $needle): ?int
    {
        return array_find_key($groups, fn($sub) => is_array($sub) && in_array($needle, $sub, true));
    }

    private static function getMenacesPressions(?int $form_id)
    {
        $categories = Modules\Context\MenacesPressions::$groupsByCategory;
        $ctx_records = Modules\Context\MenacesPressions::getModule($form_id)
            ->map(function (Modules\Context\MenacesPressions $item) use ($categories): Modules\Context\MenacesPressions {
                $id = self::find_category_id($categories, $item['group_key']) + 1;
                $item["_categories"] = $id.'. '.trans('imet-core::v2_context.MenacesPressions.categories.title'.$id);
                $item['_rank'] = Modules\Context\MenacesPressions::calculateStats(
                    [$item['Impact'], $item['Extension'], $item['Duration'], $item['Trend'], $item['Probability']],
                    true
                );

                return $item;
            })
            ->sortByDesc('_rank');

        // Filter first 10
        if (count($ctx_records) > 10) {
            $max_allowed_rank = array_values($ctx_records->toArray())[9]['_rank'];
            $ctx_records = $ctx_records
                ->filter(fn ($item): bool => $item['_rank'] >= $max_allowed_rank);
        }

        return $ctx_records;
    }
}
