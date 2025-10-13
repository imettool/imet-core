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

use Illuminate\Support\Facades\Date;
use ImetCore\Models\Imet\Components\BaseModel;
use Carbon\Carbon;

abstract class Encoder extends BaseModel
{
    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = null;

    protected $guarded = [];

    protected $table;

    protected $appends = ['name'];

    /**
     * Accessor to full name
     */
    public function getNameAttribute(): string {
        return $this->attributes['last_name'].' '.$this->attributes['first_name'];
    }

    public static function touchOnFormUpdate($formId, $user_info)
    {
        // Insert encoder (if not present in the day)
        $encoder = static::query()->where('first_name', $user_info['first_name'])
            ->where('last_name', $user_info['last_name'])
            ->where('FormID', $formId)
            ->whereDate(static::UPDATED_AT, Date::today())
            ->first();
        if($encoder){
            $encoder->touch();
        } else {
            static::query()->create(array_merge(
                $user_info,
                [
                    'FormID' => $formId
                ]
            ));
        }
    }

    /**
     * Export model
     */
    public static function exportModule($form_id): array
    {
        return static::query()->where('FormID', $form_id)
            ->get()
            ->makeHidden(['FormID', 'id'])
            ->map(function ($item){
                $item['UpdateDate'] = Date::parse($item['UpdateDate'])->setHour(0)->setMinute(0)->setSecond(0);
                return $item;
            })
            ->toArray();
    }

    /**
     * Import model
     *
     * @param $form_id
     * @param $encoders
     * @return void
     */
    public static function importModule($form_id, $encoders = null)
    {
        if($encoders!==null){
            foreach ($encoders as $encoder){
                // Remove primary key
                unset($encoder['id']);
                // Create model and fill it with data
                $item = new static();
                $item->fill($encoder);
                $item['FormID'] = $form_id;
                unset($item['name']);
                $item->save();
            }
        }
    }

    /**
     * Retrieve the form encoders' list
     *
     * @param $form_id
     */
    public static function getNames($form_id): array {
        return array_values(
            static::query()->where('FormID', $form_id)
                ->orderBy('UpdateDate', 'desc')
                ->get()
                ->map->only(['name', 'organisation', 'function'])
                ->unique()
                ->toArray()
        );
    }

}
