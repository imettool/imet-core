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

namespace ImetCore\Controllers\Imet;

use ImetCore\Controllers\__Controller;
use ImetCore\Models\Imet\ScalingUp\Basket as BasketModel;
use ModularForms\Helpers\File\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ScalingUpBasketController extends __Controller
{
    public function save(Request $request)
    {
        return BasketModel::save_item($request->value);
    }

    public function delete($id)
    {
        $item = BasketModel::query()->find($id);
        if ($item) {
            Storage::disk(BasketModel::BASKET_DISK)->delete($item->item);
            return BasketModel::destroy($item->id);
        }

        return false;
    }

    public function retrieve(Request $request)
    {
        $item = BasketModel::query()->find($request->id);
        return json_encode($item);
    }

    public function all(Request $request)
    {
        $id = $request->input('id');

        $items = BasketModel::retrieve_by_scaling_id($id);
        return json_encode($items);
    }

    public function clear(Request $request)
    {
        $id = $request->input('id');

        $records = BasketModel::query()->where('scaling_up_id', $id)->get();

        foreach ($records as $e) {

            if (!static::delete($e->id)) {
                return false;
            }
        }

        return true;
    }

}
