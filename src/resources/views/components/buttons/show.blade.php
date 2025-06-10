<?php
/** @var String $version */

use ModularForms\Helpers\Template;

if($version === \ImetCore\Models\Imet\Imet::IMET_V1){
    $controller_context = \ImetCore\Controllers\Imet\v1\ContextController::class;
    $controller_eval = \ImetCore\Controllers\Imet\v1\EvalController::class;
    $controller_report = \ImetCore\Controllers\Imet\v1\ReportController::class;
}
else if($version === \ImetCore\Models\Imet\Imet::IMET_V2){
    $controller_context = \ImetCore\Controllers\Imet\v2\ContextController::class;
    $controller_eval = \ImetCore\Controllers\Imet\v2\EvalController::class;
    $controller_report = \ImetCore\Controllers\Imet\v2\ReportController::class;
} else {
    $controller_context = \ImetCore\Controllers\Imet\oecm\ContextController::class;
    $controller_eval = \ImetCore\Controllers\Imet\oecm\EvalController::class;
    $controller_report = \ImetCore\Controllers\Imet\oecm\ReportController::class;
}
?>

<span>
    <span id="show_{{ $item->getKey() }}">
        <button class="btn-nav mr-1 small">{!! \ModularForms\Helpers\Template::icon('eye', 'white') !!}</button>
    </span>
    <tooltip :on-click=true
             anchor-elem-id="show_{{ $item->getKey() }}">

        <div class="flex flex-col gap-1">

            {{-- Context --}}
            <a class="btn-nav my-0.5 small" href="{{ action([$controller_context, 'show'], [$item->getKey()]) }}">
                {!! Template::icon('list') . ' ' . ucfirst(trans('imet-core::common.context')) !!}
            </a>

            {{-- Evaluation --}}
            <a class="btn-nav my-0.5 small" href="{{ action([$controller_eval, 'show'], [$item->getKey()]) }}">
                {!! Template::icon('check-circle') . ' ' . ucfirst(trans('imet-core::common.evaluation')) !!}
            </a>

            {{-- Analysis Report --}}
            @if($version===\ImetCore\Models\Imet\Imet::IMET_V2 || $version===\ImetCore\Models\Imet\Imet::IMET_OECM)
                <a class="btn-nav my-0.5 small" href="{{ action([$controller_report, 'report_show'], [$item->getKey()]) }}">
                {!! Template::icon('flag-checkered') . ' ' . ucfirst(trans('imet-core::common.report')) !!}
            </a>
            @endif

        </div>

    </tooltip>
</span>
