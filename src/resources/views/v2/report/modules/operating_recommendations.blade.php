<?php
/** @var string $action */

?>

<div class="module-container">
    <div class="module-header">
        <div class="module-title">@lang('imet-core::v2_report.operation_recommendations')</div>
    </div>
    <div class="module-body">
        <report-editor v-model="report.recommendations" :action="'{{ $action }}'"></report-editor>
    </div>
</div>
