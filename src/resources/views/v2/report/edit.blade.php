<?php
/** @var ReportController $controller */

/** @var Imet_Report $item */

use ImetCore\Controllers\Imet\ImetV2\ReportController;
use ImetCore\Models\Imet\ImetV2\Imet_Report;
use ImetCore\Models\Imet\ImetV2\Modules\Report\InitialPlanningOptions;
use ImetCore\Models\Imet\ImetV2\Modules\Report\KeyConservationElements;
use ImetCore\Models\Imet\ImetV2\Modules\Report\KeyQuestions;
use ImetCore\Models\Imet\ImetV2\Modules\Report\ManagementContext;
use ImetCore\Models\Imet\ImetV2\Modules\Report\ManagementEffectivenessAnalysis;
use ImetCore\Models\Imet\ImetV2\Modules\Report\OperatingRecommendations;
use ImetCore\Models\Imet\ImetV2\Modules\Report\ThreatsAffectingKCEs;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ImetCore\Services\Scores\ImetScores;
use ModularForms\Enums\ModuleViewModes;

$show_general_info = !ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id);
$scores = ImetScores::get_all($item);
?>


@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => 'report'])

    {{-- General Info --}}
    @if($show_general_info)
        @include('imet-core::v2.report.components.general_elements', ['item' => $item])
    @else
        @include('imet-core::v2.report.components.non_wdpa', ['item' => $item])
    @endif

    {{-- Evaluation --}}
    <div class="imet_report">
        @include('imet-core::v2.report.components.evaluation', [
            'item' => $item,
            'scores' => $scores,
        ])
    </div>

    {{-- Management Context --}}
    <div class="imet_report">
        <x-modular-forms::module.container
                :controller="ReportController::class"
                :module="ManagementContext::class"
                :formId="$item->getKey()"
                :mode="ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

    {{-- Management Effectiveness Analysis --}}
    <div class="imet_report">
        <x-modular-forms::module.container
                :controller="ReportController::class"
                :module="ManagementEffectivenessAnalysis::class"
                :formId="$item->getKey()"
                :mode="ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

    {{-- Operating recommendations --}}
    <div class="imet_report">
        <x-modular-forms::module.container
                :controller="ReportController::class"
                :module="OperatingRecommendations::class"
                :formId="$item->getKey()"
                :mode="ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

    {{-- ### Planning options ### --}}
    <h2>@lang('imet-core::v2_report.planning_options')</h2>
    <div class="mb-4">@lang('imet-core::v2_report.planning_options_info.general_info')</div>
    <x-modular-forms::module.container
            :controller="ReportController::class"
            :module="KeyConservationElements::class"
            :formId="$item->getKey()"
            :mode="ModuleViewModes::EDIT"
    ></x-modular-forms::module.container>
    <x-modular-forms::module.container
            :controller="ReportController::class"
            :module="ThreatsAffectingKCEs::class"
            :formId="$item->getKey()"
            :mode="ModuleViewModes::EDIT"
    ></x-modular-forms::module.container>
    <x-modular-forms::module.container
            :controller="ReportController::class"
            :module="InitialPlanningOptions::class"
            :formId="$item->getKey()"
            :mode="ModuleViewModes::EDIT"
    ></x-modular-forms::module.container>

    {{-- Key Questions --}}
    <div class="imet_report">
        <x-modular-forms::module.container
                :controller="ReportController::class"
                :module="KeyQuestions::class"
                :formId="$item->getKey()"
                :mode="ModuleViewModes::EDIT"
        ></x-modular-forms::module.container>
    </div>

@endsection

@section('side-buttons')

    {{--  Side buttons (scroll, print, etc..  --}}
    @include('imet-core::components.side-buttons', [
        'item' => $item,
        'step' => 'report',
        'printable' => true
    ])

@endsection
