@include('imet-core::scaling_up.components.threats.subsection_header', [
    'menuKey' => 'ranking',
    'tooltipKey' => 'ranking'
])

<div :id="'{{$name}}-ranking-threat'">
    <container-actions :data="values.props"
                       :name="'{{$name}}-ranking-threat'"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template v-slot:default="v">
            <div v-if="v.props.ranking">
                <bar-category-stack
                    :title="container.props.config.element_diagrams.threats.menu.ranking"
                    :show_y_axis="true"
                    :label_position="'bottom'"
                    :axis_dimensions_y="{max:0, min:-100}"
                    :show_option_label="container.props.config.element_diagrams.threats.ranking_labels"
                    :grid='{"grid": {
                        "left": "3%",
                        "right": "4%",
                        "bottom": "5%",
                        "containLabel": true,
                        "top":"19%"
                    }}'
                    :x_axis_data="values.props.ranking.xAxis"
                    :legends="values.props.ranking.legends"
                    :colors="container.props.config.color_correct_order"
                    :values="values.props.ranking.values"
                    :percent_values="values.props.ranking.percent_value"
                    :raw_values="values.props.ranking.raw_values_protected_area">
                </bar-category-stack>
            </div>
        </template>
    </container-actions>
</div>

