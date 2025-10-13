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

namespace ImetCore\Models\Imet\Components;

abstract class Report extends BaseModel
{
    public const CREATED_AT = 'UpdateDate';

    public const UPDATED_AT = 'UpdateDate';

    protected $guarded = [];

    protected static array $report_fields = [
        'key_species_comment',
        'habitats_comment',
        'climate_change_comment',
        'ecosystem_services_comment',
        'threats_comment',
        'analysis',
        'strengths_swot',
        'weaknesses_swot',
        'opportunities_swot',
        'threats_swot',
        'recommendations',
        'priorities',
        'minimum_budget',
        'additional_funding',
    ];

    /**
     * Retrieve report
     */
    public static function getByForm($form_id): array
    {
        $report = static::query()->where('FormID', $form_id)->first();

        if ($report === null) {
            $report = array_fill_keys(static::$report_fields, '');
        } else {
            $report = array_map(function ($item) {
                if ($item === null) {
                    return '';
                }

                return $item;
            }, $report->toArray());
        }

        return $report;
    }

    /**
     * Update report
     *
     * @return void
     */
    public static function updateByForm($form_id, $data)
    {
        $report = static::query()->where('FormID', $form_id)->first();
        if ($report == null) {
            $report = new static;
        }

        $data['FormID'] = $form_id;
        $report->fill($data);
        if ($report->isDirty()) {
            $report->save();
        }
    }

    /**
     * Export report (for JSON export)
     *
     * @return mixed
     */
    public static function export($form_id)
    {
        return static::query()->where('FormID', $form_id)
            ->get()
            ->makeHidden(['id', 'FormID'])
            ->toArray()[0]
            ?? array_fill_keys(static::$report_fields, null);
    }

    /**
     * Import report (from JSON export)
     *
     * @return void
     */
    public static function import($form_id, $data)
    {
        $report = new static;
        $data['FormID'] = $form_id;
        $report->fill($data);
        $report->save();
    }
}
