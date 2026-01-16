<?php

$subClass = $sub_class ?? '';
?>

<div class="max-w-full m-auto" v-for="(value, index) in data.props" :id="'{{$name}}-'+index">
    <div v-for="(section_data, section) in value" :id="'{{$name}}-'+section">
        <div v-for="(tableValue, tableIndex) in container.props.config.element_diagrams[section]">

            @include('imet-core::scaling_up.components.analysis.section_title')

            @include('imet-core::scaling_up.components.analysis.ranking_section')

            @include('imet-core::scaling_up.components.analysis.average_contribution_section')

            @include('imet-core::scaling_up.components.analysis.radar_section')

            @include('imet-core::scaling_up.components.analysis.datatable_section')

        </div>
    </div>
</div>

