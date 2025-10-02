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
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use ImetCore\Models\Imet\v2\Imet;
use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Services\ScalingUp\DownloadScalingUp;
use ImetCore\Services\ScalingUp\PreviewScalingUp;
use ImetCore\Services\ScalingUp\ReportScalingUp;
use ModularForms\Helpers\File\File;
use ModularForms\Helpers\File\Zip;
use ModularForms\Helpers\HTTP;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


class ScalingUpAnalysisController extends __Controller
{
    protected static ?string $form_class = Imet::class;
    protected static ?string $form_view_prefix = 'imet-core::';

    protected const PAGINATE = false;

    public const sanitization_rules = [
        'search' => 'custom_text|nullable',
        'year' => 'digits:4|integer|nullable',
        'country' => 'min:3|max:3|alpha|nullable',
    ];

    private $indicators = [
        'context' => [
            'C1' => [],
            'C2' => [],
            'C3' => []
        ],
        'context_value_and_importance' => [
            'C11' => [],
            'C12' => [],
            'C13' => [],
            'C14' => [],
            'C15' => []
        ],
        'planning' => [
            'P1' => [],
            'P2' => [],
            'P3' => [],
            'P4' => [],
            'P5' => [],
            'P6' => []
        ],
        'inputs' => [
            'I1' => [],
            'I2' => [],
            'I3' => [],
            'I4' => [],
            'I5' => []
        ],
        'process' => [],
        'process_sub_indicators' => [
            'PRE' => [],
            'PRC' => [],
            'PRD' => [],
            'PRF' => [],
            'PRA' => [],
            'PRB' => [],
        ],
        'process_internal_management' => [
            'PR1' => [],
            'PR2' => [],
            'PR3' => [],
            'PR4' => [],
            'PR5' => [],
            'PR6' => [],
        ],
        'process_PRB' => [
            'PR7' => [],
            'PR8' => [],
            'PR9' => []
        ],
        'process_PRC' => [
            'PR10' => [],
            'PR11' => [],
            'PR12' => []
        ],
        'process_PRD' => [
            'PR13' => [],
            'PR14' => []
        ],
        'process_PRE' => [
            'PR15' => [],
            'PR16' => []
        ],
        'process_PRF' => [
            'PR17' => [],
            'PR18' => []
        ],
        'outputs' => [
            'OP1' => [],
            'OP2' => [],
            'OP3' => []
        ],
        'outcomes' => [
            'OC1' => [],
            'OC2' => [],
            'OC3' => []
        ]
    ];

    /**
     * Index route for scaling up
     *
     * @throws AuthorizationException
     */
    #[\Override]
    public function index(Request $request): View|Factory
    {
        HTTP::sanitize($request, self::sanitization_rules);

        // set filter status
        $filter_selected = !empty(array_filter($request->except('_token')));

        // retrieve IMET list
        $filtered_list = (static::$form_class)::get_assessments_list_with_extras($request);
        $full_list = (static::$form_class)::get_assessments_list(new Request(), ['country']);
        $years = $full_list->pluck('Year')->sort()->unique()->values()->toArray();
        $countries = $full_list->pluck('country.name', 'country.iso3')->sort()->unique()->toArray();

        return view(static::$form_view_prefix . 'scaling_up.list', [
            'controller' => static::class,
            'list' => $filtered_list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => $countries,
            'years' => $years
        ]);
    }


    /**
     * @param Request $request
     * @return array
     * @throws AuthorizationException
     */
    public function analysis(Request $request): array
    {
        $locale = App::getLocale();

        $action = $request->input('func');
        $parameters = $request->input('parameter');
        ModelScalingUpAnalysis::$scaling_id = $request->input('scaling_id');
//        dd(ModelScalingUpAnalysis::$scaling_id);
        foreach ($parameters as $value) {
            if (is_array($value)) {
                $this->authorize('api_scaling_up', (static::$form_class)::find($value['id']));
            } else if ((int)$value > 0) {
                $this->authorize('api_scaling_up', (static::$form_class)::find($value));
            }
        }

        $response = ModelScalingUpAnalysis::$action($parameters);
        App::setLocale($locale);
        return $response;
    }

    /**
     * @param Request $request
     * @param null $items
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \ReflectionException
     * @throws AuthorizationException
     */
    public function report(Request $request, $items = null): View|Factory
    {
        $result = ReportScalingUp::report($request, $items);

        return view(static::$form_view_prefix . 'scaling_up.report', $result);
    }

    /**
     * Export scaling up images in zip file
     *
     * @param int $scaling_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|string
     */
    public function download_zip_file(int $scaling_id): string|BinaryFileResponse
    {
        return DownloadScalingUp::zipFile($scaling_id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function preview_template(int $id): View|Factory
    {
        $result = PreviewScalingUp::preview($id);
        return view(static::$form_view_prefix . 'scaling_up.preview_template', $result);
    }
}
