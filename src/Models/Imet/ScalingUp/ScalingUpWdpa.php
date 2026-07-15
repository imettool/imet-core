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

namespace ImetCore\Models\Imet\ScalingUp;

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;

/**
 * @property string $name
 * @property string $color
 * @property int $scaling_id
 * @property int $FormID
 */
final class ScalingUpWdpa extends BaseModel
{
    protected static ?string $schema = Database::IMET_SCHEMA;

    protected $table = 'scaling_up_wdpas';

    protected $fillable = ['scaling_id', 'FormID', 'name', 'Country', 'wdpa_id', 'color'];

    public $timestamps = false;

    /**
     * @return Collection<ScalingUpWdpa>
     */
    public static function retrieve_by_scaling_id(int $id): Collection
    {
        return self::query()
            ->where('scaling_id', $id)
            ->orderBy('name', 'asc')
            ->get();
    }

    public static function getByFormID(?int $scaling_id, int $id): ?ScalingUpWdpa
    {
        return self::query()->where(['scaling_id' => $scaling_id, 'FormID' => $id])?->first();
    }

    public static function save_pas(int $scaling_id, $areas): array
    {
        $saved_pas = [];
        foreach ($areas as $area) {
            $rand_color = '#'.substr(md5(random_int(0, mt_getrandmax())), 0, 6); // 'rgb(' . rand(30, 220) . ',' . rand(40, 220) . ',' . rand(35, 220) . ')';//str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $saved_pas[] = self::query()->create(['scaling_id' => $scaling_id, 'FormID' => $area->FormID, 'name' => $area->name, 'Country' => $area->Country, 'wdpa_id' => $area->wdpa_id, 'color' => $rand_color]);
        }

        return $saved_pas;
    }

    public static function update_item($scaling_id, $form_id, $value, $color)
    {
        $record = self::query()->where(['scaling_id' => $scaling_id, 'FormID' => $form_id])->first();
        if ($record) {
            $record->name = $value;
            $record->color = $color;
            $record->save();

            return json_encode($record);
        }

        return null;
    }

    public static function getCustomNames(int $form_id, ?int $scaling_id): ?ScalingUpWdpa
    {
        return self::getByFormID($scaling_id, $form_id);
    }
}
