<?php
/** @var string $action */

?>

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
