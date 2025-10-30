<?php

use ImetCore\Services\Scores\AssessmentsScores;
use ImetCore\Controllers\Imet\v2\Controller;
use ImetCore\Models\Imet\v2\Imet;
use ImetCore\Services\Scores\Functions\_Scores;
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
/** @var bool $connection */
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

        @if ($show_general_info)
            <div class="module-container">
                <div class="module-header">
                    <div class="module-title">@lang('imet-core::v2_report.general_elements')</div>
                </div>
                <div class="module-body">
                    @if($connection)
                        <div id="map"></div>
                    @else
                        <div class="connection_not_available">@lang('imet-core::common.connection_not_available')</div>
                    @endif
                    <div style="display: flex;">
                        <div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.country'):
                                </div>{{ $general_info['Country'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.name'):
                                </div>{{ $general_info['CompleteName'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.category'):
                                </div>{{ $general_info['NationalCategory'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.gazetting'):
                                </div>{{ $general_info['CreationYear'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.surface'):</div>{{ $area }} [km2]
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.agency'):
                                </div>{{ $general_info['Institution'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.biome'):
                                </div>{{ $general_info['Biome'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.main_values_protected'):
                                </div>{{ $general_info['ReferenceTextValues'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.vision'):
                                </div>{{ $vision['LocalVision'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.mission'):
                                </div>{{ $vision['LocalMission'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.objectives'):
                                </div>{{ $vision['LocalObjective'] ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('imet-core::v2.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' => $non_wdpa,
        ])

    </div>

    <div class="imet_report">

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.evaluation_elements')</div>
            </div>
            <div class="module-body">
                @include('imet-core::components.scores', [
                    'item' => $item,
                    'version' => $item::$version,
                ])
            </div>
            <div class="module-body">
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
            </div>
        </div>

    </div>

    <div id="imet_report" class="imet_report">

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.management_context')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::v2_report.key_species')</h5>
                <ul>
                    @foreach ($key_elements['species'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                <report-editor v-model="report.key_species_comment" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::v2_report.terrestial_marine_habitats')</h5>
                <ul>
                    @foreach ($key_elements['habitats'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                <report-editor v-model="report.habitats_comment" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::v2_report.climate_change')</h5>
                <ul>
                    @foreach ($key_elements['climate_change'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                <report-editor v-model="report.climate_change_comment" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::v2_report.ecosystem_services')</h5>
                <ul>
                    @foreach ($key_elements['ecosystem_services'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                <report-editor v-model="report.ecosystem_services_comment" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::v2_report.threats')</h5>
                <ul>
                    @foreach ($key_elements['threats'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                <report-editor v-model="report.threats_comment" :action="'{{ $action }}'"></report-editor>
                @include('imet-core::v2.report.components.table_evaluation', [
                    'scores' => $scores,
                    'labels' => $labels,
                ])
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.management_effectiveness')</div>
            </div>
            <div class="module-body">
                <report-editor v-model="report.analysis" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::v2_report.characteristics_elements')</h5>
                <div class="swot">
                    <div>
                        <b>@lang('imet-core::v2_report.strengths')</b>
                        <report-editor v-model="report.strengths_swot" :action="'{{ $action }}'"></report-editor>
                    </div>
                    <div>
                        <b>@lang('imet-core::v2_report.weaknesses')</b>
                        <report-editor v-model="report.weaknesses_swot" :action="'{{ $action }}'"></report-editor>
                    </div>
                    <div>
                        <b>@lang('imet-core::v2_report.opportunities')</b>
                        <report-editor v-model="report.opportunities_swot"
                            :action="'{{ $action }}'"></report-editor>
                    </div>
                    <div>
                        <b>@lang('imet-core::v2_report.threats')</b>
                        <report-editor v-model="report.threats_swot" :action="'{{ $action }}'"></report-editor>
                    </div>
                </div>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.operation_recommendations')</div>
            </div>
            <div class="module-body">
                <report-editor v-model="report.recommendations" :action="'{{ $action }}'"></report-editor>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.key_questions')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::v2_report.management_priorities')</h5>
                <report-editor v-model="report.priorities" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::v2_report.operating_budget')</h5>
                <report-editor v-model="report.minimum_budget" :action="'{{ $action }}'"></report-editor>
                <h5>@lang('imet-core::v2_report.additional_funding')</h5>
                <report-editor v-model="report.additional_funding" :action="'{{ $action }}'"></report-editor>
            </div>
        </div>

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
        const appMap = (new window.ImetCore.Apps.AnalysisMap({
            wdpa_id: '{{ $item->wdpa_id }}'
        }));

        appMap.mount('#imet_report_map');
    </script>

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
