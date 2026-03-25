<?php
/** @var Imet $item */
/** @var string $action */
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements_ecosystem_charts */
/** @var array $key_elements_biodiversity_charts */
/** @var array $key_elements_biodiversity */
/** @var array $key_elements_ecosystem */
/** @var array $report */
/** @var array $report_schema */
/** @var array $area */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
/** @var Array $governance */

/** @var Array $stake_analysis */

use ImetCore\Services\Scores\AssessmentsScores;
use ImetCore\Controllers\Imet\ImetV2\Controller;
use ImetCore\Models\Imet\ImetOecm\Imet;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Services\Scores\ImetScores;
use ModularForms\Helpers\Template;
use Illuminate\Support\Facades\App;
use ImetCore\Controllers\Imet\ImetOecm;

const REPORT_PREFIX = ImetOecm\Controller::ROUTE_PREFIX;

// Force Language
if ($item !== null && $item->language != App::getLocale()) {
    App::setLocale($item->language);
}

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => 'report'])

    <div id="imet_report" class="imet_report">

        {{-- AR.1 --}}
        @include('imet-core::oecm.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' => $non_wdpa,
        ])

        {{-- AR.2 --}}
        <div class="module-container">
            <div class="module-header">
                <div class="module-title" id="ar2">AR.2 @lang('imet-core::oecm_report.key_elements')</div>
            </div>
            <div class="module-body">
                @include('imet-core::oecm.report.components.governance_management', [
                    'governance' => $governance,
                ])
                @include('imet-core::oecm.report.components.stakeholders_user_managing', [
                    'stake_holders' => $stake_holders,
                ])
                @include('imet-core::oecm.report.components.ecosystem_services_biodiversity', [
                    'stake_analysis' => $stake_analysis,
                ])
                @include('imet-core::oecm.report.components.key_biodiversity_elements', [
                    'key_elements_impacts' => $key_elements_impacts,
                ])
                @include('imet-core::oecm.report.components.key_ecosystem_elements', [
                    'key_elements_impacts' => $key_elements_impacts,
                ])
                <report-editor v-model="report[0].key_elements_comment" :action="'{{ $action }}'"></report-editor>
            </div>
        </div>

        {{-- AR.3 --}}
        <div class="module-container">
            <div class="module-header">
                <div class="module-title" id="ar3">
                    AR.3 @lang('imet-core::oecm_report.management_effectiveness.title')</div>
            </div>
            <div class="module-body">
                <h4>@lang('imet-core::oecm_report.management_effectiveness.evaluation_elements')</h4>
                <div class="flex flex-row">
                    @include('imet-core::components.scores', [
                        'item' => $item,
                        'step' => null,
                        'version' => \ImetCore\Models\Imet\Imet::IMET_OECM,
                    ])
                    <div class="w-4/12">
                        <imet_radar :values="radar_values" :width="380" :height="250"></imet_radar>
                    </div>
                </div>

                <table id="global_scores">
                    <tr>
                        <th>@lang('imet-core::common.steps_eval.context')</th>
                        <th>@lang('imet-core::common.steps_eval.planning')</th>
                        <th>@lang('imet-core::common.steps_eval.inputs')</th>
                        <th>@lang('imet-core::common.steps_eval.process')</th>
                        <th>@lang('imet-core::common.steps_eval.outputs')</th>
                        <th>@lang('imet-core::common.steps_eval.outcomes')</th>
                        <th>@lang('imet-core::common.indexes.imet')</th>
                    </tr>
                    <tr>
                        <td class="{!! AssessmentsScores::score_class($scores[_Scores::RADAR_SCORES]['context']) !!}">{{ $scores[_Scores::RADAR_SCORES]['context'] }}</td>
                        <td class="{!! AssessmentsScores::score_class($scores[_Scores::RADAR_SCORES]['planning']) !!}">{{ $scores[_Scores::RADAR_SCORES]['planning'] }}</td>
                        <td class="{!! AssessmentsScores::score_class($scores[_Scores::RADAR_SCORES]['inputs']) !!}">{{ $scores[_Scores::RADAR_SCORES]['inputs'] }}</td>
                        <td class="{!! AssessmentsScores::score_class($scores[_Scores::RADAR_SCORES]['process']) !!}">{{ $scores[_Scores::RADAR_SCORES]['process'] }}</td>
                        <td class="{!! AssessmentsScores::score_class($scores[_Scores::RADAR_SCORES]['outputs']) !!}">{{ $scores[_Scores::RADAR_SCORES]['outputs'] }}</td>
                        <td class="{!! AssessmentsScores::score_class($scores[_Scores::RADAR_SCORES]['outcomes']) !!}">{{ $scores[_Scores::RADAR_SCORES]['outcomes'] }}</td>
                        <td class="{!! AssessmentsScores::score_class($scores[_Scores::RADAR_SCORES]['imet_index']) !!}">{{ $scores[_Scores::RADAR_SCORES]['imet_index'] }}</td>
                    </tr>
                </table>
                @include('imet-core::oecm.report.components.table_evaluation', [
                    'scores' => $scores,
                    'labels' => $labels,
                ])
            </div>
        </div>

        {{-- objectives --}}
        @include('imet-core::oecm.report.components.objectives', ['objectives' => $objectives])

        {{-- SWOT analysis --}}
        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.management_effectiveness.swot_analysis')</div>
            </div>
            <div class="module-body">
                <report-editor v-model="report[0].analysis" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::oecm_report.management_effectiveness.characteristics_elements')</h5>
                <div class="swot">
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.strengths')</b>
                        <report-editor v-model="report[0].strengths_swot" :action="'{{ $action }}'"></report-editor>
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.weaknesses')</b>
                        <report-editor v-model="report[0].weaknesses_swot" :action="'{{ $action }}'"></report-editor>
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.opportunities')</b>
                        <report-editor v-model="report[0].opportunities_swot"
                                       :action="'{{ $action }}'"></report-editor>
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.threats')</b>
                        <report-editor v-model="report[0].threats_swot" :action="'{{ $action }}'"></report-editor>
                    </div>
                </div>
            </div>
        </div>

        {{-- AR.4 --}}
        @include('imet-core::oecm.report.components.general_planning', [
            'report' => $report[0],
            'action' => $action,
            'key_elements_biodiversity' => $key_elements_biodiversity,
            'key_elements_ecosystem' => $key_elements_ecosystem,
            'main_threats' => $main_threats,
        ])

        {{-- AR.5 --}}
        <div class="item">
            @include('imet-core::oecm.report.components.planning_roadmap', [
                'report' => $report[0],
                'action' => $action,
            ])
            <span class="btn medium mr-1" v-if="reportLength < 10">
                <button type="button" class="btn-nav medium " v-on:click="addItem">
                    {!! \ModularForms\Helpers\Template::icon('plus-circle', 'white') !!} {!! ucfirst(trans('modular-forms::common.add_item')) !!}
                </button>
            </span>
            <span v-if="reportLength > 1">
                <button type="button" class="btn-nav medium red" v-on:click="deleteItem">
                    {!! \ModularForms\Helpers\Template::icon('trash', 'white') !!}
                </button>
            </span>
        </div>

        {{-- AR.6 --}}
        <div class="module-container mt-5">
            <div class="module-header">
                <div class="module-title" id="ar6">AR.6 @lang('imet-core::oecm_report.key_questions.title')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::oecm_report.key_questions.operating_budget')</h5>
                <report-editor v-model="report[0].minimum_budget" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::oecm_report.key_questions.additional_funding')</h5>
                <report-editor v-model="report[0].additional_funding" :action="'{{ $action }}'"></report-editor>
            </div>
        </div>
    </div>
@endsection

@section('side-buttons')

    @component('modular-forms::module.side-buttons', [
        'withPrint' => $action==='edit',
        'withZoom' => true,
    ])

        @if ($action === 'edit')

            {{-- Save --}}
            <div class="sideButtons collapsible" v-show=status==='changed'>
                <div>
                    <form id="imet_report_form" method="post"
                          action="{{ route(REPORT_PREFIX . 'report_update', [$item->getKey()]) }}"
                          style="display: inline-block;">
                        @method('PATCH')
                        @csrf
                        <span @click="saveReport">{!! Template::icon('save') !!}
                            {{ ucfirst(trans('modular-forms::common.save')) }}</span>
                    </form>
                </div>
            </div>

            {{-- Loading --}}
            <div class="sideButtons collapsible" v-show=status==='loading'>
                <div>
                    <i class="fa fa-spinner fa-spin text-primary-800"></i>
                    {{ ucfirst(trans('modular-forms::common.saving')) }}
                </div>
            </div>

            {{-- Saved --}}
            <div class="sideButtons collapsible" v-show=status==='saved'">
                <div class="highlight">
                    {{ ucfirst(trans('modular-forms::common.saved_successfully')) }}!
                </div>
            </div>

            {{-- Error --}}
            <div class="sideButtons collapsible" v-show=status==='error'>
                <div class="error">
                    {{ ucfirst(trans('modular-forms::common.saved_error')) }}!
                </div>
            </div>

        @endif

        @include('imet-core::oecm.report.components.navigation_menu')

    @endcomponent

@endSection

@push('scripts')
    <style>
        @media print {
            .sideButtons {
                display: none;
            }

            .sideButtons.report {
                display: none;
            }
        }

        @media screen {
            .sideButtons {
                margin-bottom: 0;
                bottom: 100px;
            }

            .sideButtons.report {
                margin-bottom: 0;
                bottom: 20px;
            }
        }
    </style>
    <script type="module">
        const app = (new window.ImetCore.Apps.OECMAnalysis({
            report: @json($report),
            scores: @json($scores),
            default_schema: @json($report_schema),
            url: '{{ route(REPORT_PREFIX . 'report_update', ['item' => $item->getKey()]) }}',
            loading: false,
            loading_objectives: false,
            error_objectives: false,
            error: false,
            status: 'idle',
            table_input_elems: [0],
            short_long_objectives: {},
            labels: @json($labels),
            version: "{{ \ImetCore\Models\Imet\Imet::IMET_OECM }}",
            objectives_url: '{{ route(REPORT_PREFIX . 'report_objectives', ['form_id' => $form_id]) }}'
        }));
        app.mount('#imet_report');
    </script>
@endpush
