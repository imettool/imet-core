<?php

use ImetCore\Controllers\Imet;
use ImetCore\Models;
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleViewModes;
use Illuminate\Support\Str;

/** @var Imet\ImetV2\ContextController|Imet\ImetV1\ContextController|Imet\ImetOecm\ContextController|Imet\ImetV1\EvalController|Imet\ImetV2\EvalController|Imet\ImetOecm\EvalController $controller */
/** @var Models\Imet\ImetV2\Imet|Models\Imet\ImetV1\Imet|Models\Imet\ImetOecm\Imet|Models\Imet\ImetV2\Imet_Eval|Models\Imet\ImetV1\Imet_Eval|Models\Imet\ImetOecm\Imet_Eval $item */
/** @var string $mode */


if (Str::contains(Str::lower($controller), Models\Imet\Imet::IMET_V1)) {
    $version = Models\Imet\Imet::IMET_V1;
    $context_modules = Models\Imet\ImetV1\Imet::modules();
    $evaluation_modules = Models\Imet\ImetV1\Imet_Eval::modules();
} elseif (Str::contains(Str::lower($controller), Models\Imet\Imet::IMET_V2)) {
    $version = Models\Imet\Imet::IMET_V2;
    $context_modules = Models\Imet\ImetV2\Imet::modules();
    $evaluation_modules = Models\Imet\ImetV2\Imet_Eval::modules();
} elseif (Str::contains(Str::lower($controller), Models\Imet\Imet::IMET_OECM)) {
    $version = Models\Imet\Imet::IMET_OECM;
    $context_modules = Models\Imet\ImetOecm\Imet::modules();
    $evaluation_modules = Models\Imet\ImetOecm\Imet_Eval::modules();
}

?>

@extends('imet-core::layouts.print')

@section('content')

    <h2>
        @lang('imet-core::common.imet_short'): @lang('imet-core::common.imet')
    </h2>

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{-- Management effectiveness scores --}}
    @include('imet-core::components.score-container', [
        'item' => $item,
        'step' => 'management_effectiveness'
    ])

    {{--  Modules (by step): CONTEXT --}}
    <h1>@uclang('imet-core::common.context_long')</h1>
    @foreach($context_modules as $step => $modules_by_step)
        @if($step!=='objectives')
            @foreach($modules_by_step as $module)
                @if(Role::hasRequiredAccessLevel($module))
                    <x-modular-forms::module.container
                        :controller="$controller"
                        :module="$module"
                        :formId="$item->getKey()"
                        :mode="ModuleViewModes::PRINT"
                    ></x-modular-forms::module.container>
                @else
                    @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
                @endif
            @endforeach
        @endif
    @endforeach

    {{--  Modules (by step): EVALUATION --}}
    <h1>@uclang('imet-core::common.evaluation_long')</h1>
    @foreach($evaluation_modules as $step => $modules_by_step)
        @if($step!=='objectives')
            @foreach($modules_by_step as $module)
                @if(Role::hasRequiredAccessLevel($module))
                    <x-modular-forms::module.container
                        :controller="$controller"
                        :module="$module"
                        :formId="$item->getKey()"
                        :mode="ModuleViewModes::PRINT"
                    ></x-modular-forms::module.container>
                @else
                    @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
                @endif
            @endforeach
        @endif
    @endforeach

    <style>
        .entity-heading {
            margin-top: 20px;
        }

    </style>

    <script>
        window.onload = function () {
            setTimeout(function () {
                window.print();
            }, 2000);
        }
    </script>

@endsection
