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

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use ImetCore\Controllers\__Controller;
use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Services\ScalingUp\DownloadScalingUp;
use ImetCore\Services\ScalingUp\PreviewScalingUp;
use ImetCore\Services\ScalingUp\ReportScalingUp;
use ModularForms\Helpers\HTTP;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class ScalingUpAnalysisController extends __Controller
{
    protected static ?string $form_class = Imet::class;

    protected static ?string $form_view_prefix = 'imet-core::';

    protected const false PAGINATE = false;

    public const array sanitization_rules = [
        'search' => 'custom_text|nullable',
        'year' => 'digits:4|integer|nullable',
        'country' => 'min:3|max:3|alpha|nullable',
    ];

    /**
     * Index route for scaling up
     *
     * @throws Throwable
     */
    #[\Override]
    public function index(Request $request): View
    {
        HTTP::sanitize($request, self::sanitization_rules);

        // set filter status
        $filter_selected = filled(array_filter($request->except('_token')));

        // retrieve IMET list
        $filtered_list = (static::$form_class)::get_assessments_list_with_extras($request);
        $full_list = (static::$form_class)::get_assessments_list(new Request, ['country']);
        $years = $full_list->pluck('Year')->sort()->unique()->values()->toArray();
        $countries = $full_list->pluck('country.name', 'country.iso3')->sort()->unique()->toArray();

        return view(static::$form_view_prefix . 'scaling_up.list', [
            'controller' => static::class,
            'list' => $filtered_list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => $countries,
            'years' => $years,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function analysis(Request $request): JsonResponse
    {
        $locale = App::getLocale();

        try {
            $action = $request->input('func');
            $parameters = $request->input('parameter');
            ModelScalingUpAnalysis::$scaling_id = $request->input('scaling_id');

            foreach ($parameters as $value) {
                if (is_array($value)) {
                    $this->authorize('wdpa_scaling_up', (static::$form_class)::find($value['id']));
                } elseif ((int)$value > 0) {
                    $this->authorize('wdpa_scaling_up', (static::$form_class)::find($value));
                }
            }

            $response = ModelScalingUpAnalysis::$action($parameters);
            App::setLocale($locale);
            return self::sendAPIResponse($response);
        } catch (\Exception $exception) {
            App::setLocale($locale);
            report($exception);

            return new JsonResponse([
                'request_params' => $request?->all(),
                'records' => trans('imet-core::analysis_report.error_wrong'),
            ], 500);
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function report(Request $request, ?string $items = null): View
    {
        $result = ReportScalingUp::report($request, $items);

        return view(static::$form_view_prefix . 'scaling_up.report', $result);
    }

    /**
     * Export scaling up images in zip file
     */
    public function download_zip_file(int $scaling_id): string|BinaryFileResponse
    {
        return DownloadScalingUp::zipFile($scaling_id);
    }

    public function preview_template(int $id): View
    {
        $result = PreviewScalingUp::preview($id);

        return view(static::$form_view_prefix . 'scaling_up.preview_template', $result);
    }
}
