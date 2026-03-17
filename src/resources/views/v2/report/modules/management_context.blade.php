<?php
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements */

?>

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
