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

namespace ImetCore\Models\Imet\oecm;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Report as BaseReport;

class Report extends BaseReport
{
    protected static ?string $schema = Database::OECM_SCHEMA;

    protected $table = 'report';

    protected static array $report_fields = [
        'analysis',
        'key_elements_comment',
        'strengths_swot',
        'weaknesses_swot',
        'opportunities_swot',
        'threats_swot',
        'priorities',
        'minimum_budget',
        'additional_funding',
        'previous_state',
        'proposed_short',
        'proposed_long',
        'impacts',
        'responses',
        'long_term',
        'outcome',
        'annual_targets1',
        'annual_targets1_activity1',
        'annual_targets1_activity2',
        'annual_targets2',
        'annual_targets2_activity1',
        'annual_targets2_activity2',
        'annual_targets2_activity3',
        'annual_targets2_activity4',
        'annual_targets2_activity5',
        'outcome2',
        'group_key',
        'objectives',
    ];

    protected static $boolean_fields = [
        'annual_targets1_activity1_year1',
        'annual_targets1_activity1_year2',
        'annual_targets1_activity1_year3',
        'annual_targets1_activity1_year4',
        'annual_targets1_activity1_year5',

        'annual_targets1_activity2_year1',
        'annual_targets1_activity2_year2',
        'annual_targets1_activity2_year3',
        'annual_targets1_activity2_year4',
        'annual_targets1_activity2_year5',

        'annual_targets1_activity3_year1',
        'annual_targets1_activity3_year2',
        'annual_targets1_activity3_year3',
        'annual_targets1_activity3_year4',
        'annual_targets1_activity3_year5',

        'annual_targets1_activity4_year1',
        'annual_targets1_activity4_year2',
        'annual_targets1_activity4_year3',
        'annual_targets1_activity4_year4',
        'annual_targets1_activity4_year5',

        'annual_targets1_activity5_year1',
        'annual_targets1_activity5_year2',
        'annual_targets1_activity5_year3',
        'annual_targets1_activity5_year4',
        'annual_targets1_activity5_year5',

        'annual_targets2_activity1_year1',
        'annual_targets2_activity1_year2',
        'annual_targets2_activity1_year3',
        'annual_targets2_activity1_year4',
        'annual_targets2_activity1_year5',

        'annual_targets2_activity2_year1',
        'annual_targets2_activity2_year2',
        'annual_targets2_activity2_year3',
        'annual_targets2_activity2_year4',
        'annual_targets2_activity2_year5',

        'annual_targets2_activity3_year1',
        'annual_targets2_activity3_year2',
        'annual_targets2_activity3_year3',
        'annual_targets2_activity3_year4',
        'annual_targets2_activity3_year5',

        'annual_targets2_activity4_year1',
        'annual_targets2_activity4_year2',
        'annual_targets2_activity4_year3',
        'annual_targets2_activity4_year4',
        'annual_targets2_activity4_year5',

        'annual_targets2_activity5_year1',
        'annual_targets2_activity5_year2',
        'annual_targets2_activity5_year3',
        'annual_targets2_activity5_year4',
        'annual_targets2_activity5_year5',

        'outcome_year1',
        'outcome_year2',
        'outcome_year3',
        'outcome_year4',
        'outcome_year5',

        'outcome2_year1',
        'outcome2_year2',
        'outcome2_year3',
        'outcome2_year4',
        'outcome2_year5',
    ];

    /**
     * Retrieve report
     */
    #[\Override]
    public static function getByForm($form_id): array
    {
        $report = Report::query()->where('FormID', $form_id)->get();

        return $report->isEmpty()
            ? [static::getSchema()]
            : $report->toArray();
    }

    public static function getSchema()
    {
        return array_fill_keys(static::$report_fields, '') + array_fill_keys(static::$boolean_fields, false);
    }

    /**
     * Update report
     */
    #[\Override]
    public static function updateByForm($form_id, $data): void
    {

        Report::query()->where('FormID', $form_id)->delete();
        foreach ($data as $key => $value) {
            $report = new Report;
            $data[$key]['FormID'] = $form_id;
            $report->fill($data[$key]);
            if ($report->isDirty()) {
                $report->save();
            }
        }
    }
}
