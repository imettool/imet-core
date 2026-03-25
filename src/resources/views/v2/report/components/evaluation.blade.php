<?php
/** @var Imet $item */

/** @var array $scores */

use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Services\Scores\Functions\_Scores;
use ImetCore\Services\Scores\AssessmentsScores;

?>

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
        <table id="global_scores" class="report_table">
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
