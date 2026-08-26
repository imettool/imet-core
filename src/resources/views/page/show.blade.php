<?php

use ImetCore\Controllers\Imet;
use ImetCore\Models;
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleViewModes;
use Illuminate\Support\Str;

/** @var Imet\ImetV2\ContextController|Imet\ImetV1\ContextController|Imet\ImetOecm\ContextController|Imet\ImetV1\EvalController|Imet\ImetV2\EvalController|Imet\ImetOecm\EvalController $controller */
/** @var Models\Imet\ImetV2\Imet|Models\Imet\ImetV1\Imet|Models\Imet\ImetOecm\Imet|Models\Imet\ImetV2\Imet_Eval|Models\Imet\ImetV1\Imet_Eval|Models\Imet\ImetOecm\Imet_Eval $item */
/** @var string $step */
/** @var ?array $cross_analysis_warnings */

$cross_analysis_warnings ??= [];

if (Str::contains(Str::lower($controller), Models\Imet\Imet::IMET_V1)) {
    $version = Models\Imet\Imet::IMET_V1;
    $step_labels = 'v1_common.steps';
} elseif (Str::contains(Str::lower($controller), Models\Imet\Imet::IMET_V2)) {
    $version = Models\Imet\Imet::IMET_V2;
    $step_labels = 'v2_common.steps';
} elseif (Str::contains(Str::lower($controller), Models\Imet\Imet::IMET_OECM)) {
    $version = Models\Imet\Imet::IMET_OECM;
    $step_labels = 'oecm_common.steps';
}

$phase = 'context';
if (Str::contains($controller, 'EvalController')) {
    $phase = 'evaluation';
    $step_labels = 'common.steps_eval';
}
$step_menu_classes['cross_analysis'] = !empty($cross_analysis_warnings) ? 'cross-analysis-warnings': '';

$steps = $phase === 'evaluation' && Str::contains(Str::lower($controller), Models\Imet\Imet::IMET_V2)
    ? Imet\ImetV2\EvalController::steps($item)
    : array_keys($item::modules());

$show_scrollbar = true;

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => $phase])

    {{--  Steps menu --}}
    @include('modular-forms::page.components.steps', [
        'url' => action([$controller, 'show'], ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::' . $step_labels . '.',
        'steps' => $steps,
        'classes' => $step_menu_classes ?? []
    ])

    {{-- Steps info --}}
    @if($phase==='evaluation')
        @if(\Illuminate\Support\Facades\Lang::has('imet-core::v2_evaluation.steps.'.$step))
            <div class="module-container">
                <div class="module-bar info-bar">
                    <div class="icon">
                        {!! \ModularForms\Helpers\Template::icon('info-circle', '', '1.4em') !!}
                    </div>
                    <div class="message">
                        @lang('imet-core::v2_evaluation.steps.'.$step)
                    </div>
                </div>
            </div>
        @endif
    @endif

    {{-- Cross Analysis --}}
    @if($step==='cross_analysis' and $version==Models\Imet\Imet::IMET_V2)
        @include('imet-core::'.$version.'.cross_analysis.index', [
            'item_id' => $item->getKey(),
            'mode' => ModuleViewModes::SHOW,
            'cross_analysis_warnings' => $cross_analysis_warnings
        ])
    @else

        {{-- Management effectiveness scores --}}
        @if($phase==='evaluation')
            @include('imet-core::components.score-container', [
                'item' => $item,
                'step' => $step,
                'version' => $version
            ])
        @endif

        {{--  Modules (by step) --}}
        <div class="imet_modules">


            @if($version===Models\Imet\Imet::IMET_OECM and
                    $step==='stakeholder_analysis' and
                    Role::hasRequiredAccessLevel(Models\Imet\ImetOecm\Modules\Context\_AnalysisStakeholders::class))
                @include('imet-core::oecm.context.show.modules.analysis_stakeholder_summary', [
                    'form_id' => $item->getKey()
                ])
            @endif


            @foreach($item::modules()[$step] as $module)
                @if(Role::hasRequiredAccessLevel($module))
                    <x-modular-forms::module.container
                        :controller="$controller"
                        :module="$module"
                        :formId="$item->getKey()"
                        :mode="ModuleViewModes::SHOW"
                    ></x-modular-forms::module.container>
                @else
                    @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
                @endif
            @endforeach
        </div>

    @endif

@endsection

@section('side-buttons')

    {{--  Side buttons (scroll, print, etc..  --}}
    @include('imet-core::components.side-buttons', [
       'item' => $item,
       'step' => $step
   ])

@endsection
