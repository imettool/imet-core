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

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;


class ScalingUpWdpa extends BaseModel
{

    protected string $schema = Database::IMET_SCHEMA;
    protected $table = 'scaling_up_wdpas';

    protected $fillable = ['scaling_id', 'FormID', 'name', 'Country', 'wdpa_id', 'color'];
    public $timestamps = false;

    /**
     * @param $id
     * @return mixed
     */
    public static function retrieve_by_scaling_id($id)
    {
        return static::where('scaling_id', $id)->orderBy('name', 'asc')->get();
    }

    /**
     * @param $scaling_id
     * @param $id
     * @return mixed
     */
    public static function getByFormID($scaling_id, $id)
    {
        return static::where(['scaling_id' => $scaling_id, 'FormID' => $id])->first();
    }

    /**
     * @param $scaling_id
     * @param $areas
     * @return array
     */
    public static function save_pas($scaling_id, $areas): array
    {
        $saved_pas = [];
        foreach ($areas as $k => $area) {
            $rand_color = "#" . substr(md5(rand()), 0, 6);//'rgb(' . rand(30, 220) . ',' . rand(40, 220) . ',' . rand(35, 220) . ')';//str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $saved_pas[] = static::create(['scaling_id' => $scaling_id, 'FormID' => $area->FormID, 'name' => $area->name, 'Country' => $area->Country, 'wdpa_id' => $area->wdpa_id, 'color' => $rand_color]);
        }
        return $saved_pas;
    }

    public static function update_item($scaling_id, $form_id, $value, $color)
    {
        $record = static::where(['scaling_id' => $scaling_id, 'FormID' => $form_id])->first();
        if ($record) {
            $record->name = $value;
            $record->color = $color;
            $record->save();
            return json_encode($record);
        }
        return null;
    }

    /**
     * @param int $form_id
     * @param $scaling_id
     * @return array
     */
    public static function getCustomNames(int $form_id, $scaling_id)
    {
        $protected_area = static::getByFormID($scaling_id, $form_id);
        if (($protected_area)) {
            return $protected_area;
        }

        return null;
    }

}
