<?php

use \ImetCore\Controllers\Imet;
use \ImetCore\Models;
use \ImetCore\Models\User\Role;
use \ModularForms\Enums\ModuleViewModes;
use \Illuminate\Support\Str;

/** @var Imet\v2\ContextController|Imet\v1\ContextController|Imet\oecm\ContextController|Imet\v1\EvalController|Imet\v2\EvalController|Imet\oecm\EvalController $controller */
/** @var Models\Imet\v2\Imet|Models\Imet\v1\Imet|Models\Imet\oecm\Imet|Models\Imet\v2\Imet_Eval|Models\Imet\v1\Imet_Eval|Models\Imet\oecm\Imet_Eval $item */
/** @var string $step */

if (Str::contains($controller, Models\Imet\Imet::IMET_V1)) {
    $version = Models\Imet\Imet::IMET_V1;
    $step_labels = 'v1_common.steps';
} elseif (Str::contains($controller, Models\Imet\Imet::IMET_V2)) {
    $version = Models\Imet\Imet::IMET_V2;
    $step_labels = 'v2_common.steps';
} elseif (Str::contains($controller, Models\Imet\Imet::IMET_OECM)) {
    $version = Models\Imet\Imet::IMET_OECM;
    $step_labels = 'oecm_common.steps';
}

if (Str::contains($controller, 'ContextController')) {
    $phase = 'context';
} elseif (Str::contains($controller, 'EvalController')) {
    $phase = 'evaluation';
    $step_labels = 'common.steps_eval';
}

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
        'steps' => array_keys($item::modules())
    ])

    {{-- Steps info --}}
    @if($phase==='evaluation')
        @if(\Illuminate\Support\Facades\Lang::has('imet-core::v2_evaluation.steps.'.$step))
            <div class="module-container">
                @include('modular-forms::module.components.bars.info',['definitions' => [ 'module_key' => null, 'module_info' => __('imet-core::v2_evaluation.steps.'.$step)]])
            </div>
        @endif
    @endif

    {{-- Cross Analysis --}}
    @if($step==='cross_analysis' and $version==Models\Imet\Imet::IMET_V2)
        @include('imet-core::'.$version.'.cross_analysis.index', [
            'item_id' => $item->getKey(),
            'warnings' => $warnings
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
