@php
    $barErrorId = "'{$name}'+section+'-'+tableValue['name']+'-'+index+'bar-error'";
@endphp

@include('imet-core::scaling_up.components.analysis.subsection_header', [
    'subClass' => $subClass,
    'menuKey' => 'average_contribution',
    'tooltipKey' => 'average_contribution',
    'idPrefix' => 'menu-average-contribution'
])

<div :id="{{$barErrorId}}">
    <container-actions :data="section_data"
                       :name="{{$barErrorId}}"
                       :event_image="'save_entire_block_as_image'">
        <template v-slot:default="data_elements">
            <imet-bar-error
                :title="tableValue['menu']['average_contribution']"
                :axis_dimensions_x="{max:100}"
                :inverse_y="true"
                :show_legends="true"
                :legends="data_elements.props[tableValue['name']].average_contribution.legends"
                :values="data_elements.props[tableValue['name']].average_contribution.data"
                :height="data_elements.props[tableValue['name']].average_contribution.options.height"
                :indicators="container.props.stores.BaseStore.parse_indicators(data_elements.props[tableValue['name']].average_contribution.data.Average.map(i => i.label))">
            </imet-bar-error>
        </template>
    </container-actions>
</div>

