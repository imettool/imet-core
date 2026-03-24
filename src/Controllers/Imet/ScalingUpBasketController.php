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

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use ImetCore\Controllers\__Controller;
use ImetCore\Models\Imet\ScalingUp\Basket as BasketModel;

class ScalingUpBasketController extends __Controller
{
    public function save(Request $request): JsonResponse
    {
        try {
            return self::sendAPIResponse(BasketModel::save_item($request->value));
        } catch (\Exception $exception) {
            report($exception);
            return new JsonResponse([
                'request_params' => $request?->all(),
                'records' => trans('imet-core::analysis_report.error_wrong'),
            ], 500);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $item = BasketModel::query()->find($id);
            if ($item) {
                Storage::disk(BasketModel::BASKET_DISK)->delete($item->item);

                return self::sendAPIResponse(BasketModel::destroy($item->id));
            }

            return self::sendAPIResponse(0);
        } catch (\Exception $exception) {
            report($exception);
            return new JsonResponse([
                'request_params' => [],
                'records' => trans('imet-core::analysis_report.error_wrong'),
            ], 500);
        }
    }

    public function retrieve(Request $request): JsonResponse
    {
        try {
            $item = BasketModel::query()->find($request->id);

            return self::sendAPIResponse($item);
        } catch (\Exception $exception) {
            report($exception);
            return new JsonResponse([
                'request_params' => $request?->all(),
                'records' => trans('imet-core::analysis_report.error_wrong'),
            ], 500);
        }
    }

    public function all(Request $request): JsonResponse
    {
        try {
            $id = $request->input('id');

            $items = BasketModel::retrieve_by_scaling_id($id);

            return self::sendAPIResponse($items);
        } catch (\Exception $exception) {
            report($exception);
            return new JsonResponse([
                'request_params' => $request?->all(),
                'records' => trans('imet-core::analysis_report.error_wrong'),
            ], 500);
        }
    }

    public function clear(Request $request): JsonResponse
    {
        try {
            $id = $request->input('id');

            $records = BasketModel::query()->where('scaling_up_id', $id)->get();

            foreach ($records as $e) {

                if (!static::delete($e->id)) {
                    return self::sendAPIResponse(0);
                }
            }

            return self::sendAPIResponse(1);
        } catch (\Exception $exception) {
            report($exception);
            return new JsonResponse([
                'request_params' => $request?->all(),
                'records' => trans('imet-core::analysis_report.error_wrong'),
            ], 500);
        }
    }
}
