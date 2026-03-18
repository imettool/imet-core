<?php
/** @var ReportController $controller */

/** @var Imet_Report $item */

use ImetCore\Controllers\Imet\v2\ReportController;
use ImetCore\Models\Imet\v2\Imet_Report;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ImetCore\Services\Scores\ImetScores;

$show_general_info = !ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id);
$scores = ImetScores::get_all($item);

///** @var \ImetCore\Models\Imet\v2\Imet $item */
///** @var array $assessment */
///** @var array $key_elements */
///** @var array $report */
///** @var array $general_info */
///** @var array $vision */
///** @var array $area */
///** @var bool  $show_general_info */
///** @var bool $show_non_wdpa */
///** @var Array $non_wdpa */
?>


@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => 'report'])

    {{-- General Info --}}
    @if($show_general_info)
        @include('imet-core::v2.report.modules.general_elements', ['item' => $item])
    @else
        @include('imet-core::v2.report.components.non_wdpa', ['item' => $item])
    @endif

    {{-- Evaluation --}}
    <div class="imet_report">
        @include('imet-core::v2.report.modules.evaluation', [
            'item' => $item,
            'scores' => $scores,
        ])
    </div>

    {{-- Management Context --}}
    <div class="imet_report">
        <x-modular-forms::module.container
            :controller="ReportController::class"
            :module="\ImetCore\Models\Imet\v2\Modules\Report\ManagementContext::class"
            :formId="$item->getKey()"
            :mode="\ModularForms\Enums\ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

    {{-- Management Effectiveness Analysis --}}
    <div class="imet_report">
        <x-modular-forms::module.container
            :controller="ReportController::class"
            :module="\ImetCore\Models\Imet\v2\Modules\Report\ManagementEffectivenessAnalysis::class"
            :formId="$item->getKey()"
            :mode="\ModularForms\Enums\ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

    {{-- Operating recommendations --}}
    <div class="imet_report">
        <x-modular-forms::module.container
            :controller="ReportController::class"
            :module="\ImetCore\Models\Imet\v2\Modules\Report\OperatingRecommendations::class"
            :formId="$item->getKey()"
            :mode="\ModularForms\Enums\ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

    {{-- ### Planning options ### --}}
    <h2>@lang('imet-core::v2_report.planning_options')</h2>
    <div class="mb-4">@lang('imet-core::v2_report.planning_options_info.general_info')</div>
    <x-modular-forms::module.container
        :controller="ReportController::class"
        :module="\ImetCore\Models\Imet\v2\Modules\Report\KeyConservationElements::class"
        :formId="$item->getKey()"
        :mode="\ModularForms\Enums\ModuleViewModes::EDIT"
    ></x-modular-forms::module.container>
    <!-- TODO: table B -->
    <!-- TODO: table C -->

    {{-- Key Questions --}}
    <div class="imet_report">
        <x-modular-forms::module.container
            :controller="ReportController::class"
            :module="\ImetCore\Models\Imet\v2\Modules\Report\KeyQuestions::class"
            :formId="$item->getKey()"
            :mode="\ModularForms\Enums\ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

@endsection
