@php
        $categoryStackId = "'{$name}'+section+'-'+tableValue['name']+'-'+index+'category-stack'";
@endphp

@include('imet-core::scaling_up.components.analysis.subsection_header', [
    'subClass' => $subClass,
    'menuKey' => 'ranking',
    'tooltipKey' => 'ranking',
    'idPrefix' => 'menu-ranking'
])

<div :id="{{$categoryStackId}}">
    <container_actions :data="section_data"
                       :name="{{$categoryStackId}}"
                       :event_image="'save_entire_block_as_image'">
        <template v-slot:default="data_elements">
            <bar_category_stack
                :axis_dimensions_y="{max:100}"
                :title="tableValue['menu']['ranking']"
                :show_y_axis="true"
                :show_option_label="tableValue['ranking_labels']"
                :x_axis_data="data_elements.props[tableValue['name']].ranking.xAxis"
                :legends="data_elements.props[tableValue['name']].ranking.legends"
                :colors="container.props.config.color_correct_order"
                :values="data_elements.props[tableValue['name']].ranking.values"
                :percent_values="data_elements.props[tableValue['name']].ranking.percent_value"
                :raw_values="data_elements.props[tableValue['name']].ranking.raw_values_protected_area">
            </bar_category_stack>

            <div style="font-size: 12px">
                {{ trans("imet-core::analysis_report.ranking_info_indicators") }}
            </div>
            <div style="font-size: 12px" v-if="tableValue['key'] == 'overall_scores'">
                * {{ trans("imet-core::analysis_report.ranking_rescaled_indicators") }}
            </div>
        </template>
    </container_actions>
</div>

