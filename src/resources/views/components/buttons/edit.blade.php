<?php
/** @var string $version */

use ModularForms\Helpers\Template;

if ($version === \ImetCore\Models\Imet\Imet::IMET_V1) {
    $controller_context = \ImetCore\Controllers\Imet\ImetV1\ContextController::class;
    $controller_eval = \ImetCore\Controllers\Imet\ImetV1\EvalController::class;
    $controller_report = \ImetCore\Controllers\Imet\ImetV1\ReportController::class;
} elseif ($version === \ImetCore\Models\Imet\Imet::IMET_V2) {
    $controller_context = \ImetCore\Controllers\Imet\ImetV2\ContextController::class;
    $controller_eval = \ImetCore\Controllers\Imet\ImetV2\EvalController::class;
    $controller_report = \ImetCore\Controllers\Imet\ImetV2\ReportController::class;
} else {
    $controller_context = \ImetCore\Controllers\Imet\ImetOecm\ContextController::class;
    $controller_eval = \ImetCore\Controllers\Imet\ImetOecm\EvalController::class;
    $controller_report = \ImetCore\Controllers\Imet\ImetOecm\ReportController::class;
}
?>


<span>
    <span id="edit_{{ $item->getKey() }}">
        <button class="btn-nav mr-1 small yellow">{!! \ModularForms\Helpers\Template::icon('pen', 'white') !!}</button>
    </span>
    <tooltip :on-click=true
             anchor-elem-id="edit_{{ $item->getKey() }}">

        <div class="flex flex-col gap-y-1">

            {{-- Context --}}
            <a class="btn-nav my-0.5 small yellow"
               href="{{ action([$controller_context, 'edit'], [$item->getKey()]) }}">
                {!! Template::icon('list') . ' ' . ucfirst(trans('imet-core::common.context')) !!}
            </a>

            {{-- Evaluation --}}
            <a class="btn-nav my-0.5 small yellow" href="{{ action([$controller_eval, 'edit'], [$item->getKey()]) }}">
                {!! Template::icon('check-circle') . ' ' . ucfirst(trans('imet-core::common.evaluation')) !!}
            </a>

            {{-- Analysis Report --}}
            @if($version===\ImetCore\Models\Imet\Imet::IMET_V2)
                <a class="btn-nav my-0.5 small yellow"
                   href="{{ action([$controller_report, 'edit'], [$item->getKey()]) }}">
                    {!! Template::icon('flag-checkered') . ' ' . ucfirst(trans('imet-core::common.report')) !!}
                </a>
            @elseif($version===\ImetCore\Models\Imet\Imet::IMET_OECM)
                <a class="btn-nav my-0.5 small yellow"
                   href="{{ action([$controller_report, 'report'], [$item->getKey()]) }}">
                    {!! Template::icon('flag-checkered') . ' ' . ucfirst(trans('imet-core::common.report')) !!}
                </a>
            @endif

        </div>

    </tooltip>
</span>
