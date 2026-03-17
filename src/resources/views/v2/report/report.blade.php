<?php

use ImetCore\Controllers\Imet\v2\Controller;
use ImetCore\Models\Imet\v2\Imet;
use ImetCore\Services\Scores\ImetScores;
use ModularForms\Helpers\Template;
use Illuminate\Support\Facades\App;

/** @var string $action */
/** @var Imet $item */
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements */
/** @var array $report */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool $show_general_info */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */

// Force Language
if ($item->language != App::getLocale()) {
    App::setLocale($item->language);
}

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => 'report'])

    <div id="imet_report_map" class="imet_report">

        {{--  General Info  --}}
        @include('imet-core::v2.report.modules.general_info', [
            'show_general_info' => $show_general_info,
            'general_info' => $general_info,
            'area' => $area,
        ])

        @include('imet-core::v2.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' => $non_wdpa,
        ])

    </div>

    <div class="imet_report">

        {{-- Evaluation --}}
        @include('imet-core::v2.report.modules.evaluation', [
            'item' => $item,
            'scores' => $scores,
        ])

    </div>

    <div id="imet_report" class="imet_report">

        {{-- Management Context --}}
        @include('imet-core::v2.report.modules.management_context', [
            'key_elements' => $key_elements,
            'scores' => $scores,
            'labels' => $labels
        ])

        {{-- Management Effectiveness Analysis --}}
        @include('imet-core::v2.report.modules.management_effectiveness_analysis', [
            'action' => $action,
        ])

        {{-- Operating recommendations --}}
        @include('imet-core::v2.report.modules.operating_recommendations', [
            'action' => $action,
        ])

        {{-- Key Questions --}}
        @include('imet-core::v2.report.modules.key_questions', [
            'action' => $action,
        ])

        @if ($action === 'edit')
            <div class="scrollButtons" v-cloak>
                <div class="standalone" v-show=status==='changed'>
                    <form id="imet_report_form" method="post"
                        action="{{ route(Controller::ROUTE_PREFIX . 'report_update', [$item->getKey()]) }}"
                        style="display: inline-block;">
                        @method('PATCH')
                        @csrf
                        <span @click="saveReport">{!! Template::icon('save') !!}
                            {{ ucfirst(trans('modular-forms::common.save')) }}</span>
                    </form>
                </div>
                <div class="standalone" v-show=status==='loading'>
                    <i class="fa fa-spinner fa-spin text-primary-800"></i>
                    {{ ucfirst(trans('modular-forms::common.saving')) }}
                </div>
                <div v-show=status==='saved' class="standalone highlight">
                    {{ ucfirst(trans('modular-forms::common.saved_successfully')) }}!
                </div>
                <div v-show=status==='error' class="standalone error">
                    {{ ucfirst(trans('modular-forms::common.saved_error')) }}!
                </div>

                {{-- Print --}}
                <div class="standalone" @click="printReport">{!! Template::icon('print') !!}
                    {{ ucfirst(trans('modular-forms::common.print')) }}</div>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <style>
        .module-body ul {
            padding-left: 15px !important;
        }
    </style>

    <script type="module">
        const app = (new window.ImetCore.Apps.Analysis({
            report: @json($report),
            scores: @json($scores),
            labels: @json($labels),
            version: "{{ \ImetCore\Models\Imet\Imet::IMET_V2 }}",
            status: 'idle',
            url: '{{ route(Controller::ROUTE_PREFIX . 'report_update', [$item->getKey()]) }}',
        }));

        app.mount('#imet_report');
    </script>
@endpush
