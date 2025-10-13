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

use Illuminate\Support\Facades\Storage;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;

class Basket extends BaseModel
{
    public const BASKET_DISK = 'public_folder';

    public const BASKET_FOLDER = 'basket/';

    public $timestamps = false;

    protected static ?string $schema = Database::IMET_SCHEMA;

    protected $table = 'scaling_up_basket';

    protected $fillable = ['item', 'order', 'comment', 'scaling_up_id'];

    public static function retrieve_by_scaling_id($id)
    {
        return static::query()->where('scaling_up_id', $id)->orderBy('id', 'asc')->get();
    }

    public static function save_item($item)
    {
        $image = str_replace('data:image/png;base64,', '', $item['image_src']);
        $image = str_replace(' ', '+', $image);

        $record = static::query()->create(['order' => 1, 'scaling_up_id' => $item['scaling_up_id']]);
        $imageName = hash('sha256', $record->id.time()).'.png';

        $disk = Storage::disk(self::BASKET_DISK);
        $image_path = self::BASKET_FOLDER.$imageName;
        if ($disk->put($image_path, base64_decode($image))) {
            $record->item = config('app.asset_url') ? ltrim(config('app.asset_url'), '/').ltrim($image_path, '/') : $image_path;
            $record->comment = $item['comment'];
            $record->save();

            return json_encode($record);
        }

        // $path = $disk->url($image_path);

        return null;
    }
}
