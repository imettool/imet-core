<?php
/** @var string $action */

?>

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
