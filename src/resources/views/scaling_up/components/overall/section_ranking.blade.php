<div class="mt-3">
    @include('imet-core::scaling_up.components.overall.section_header', [
        'title' => '4.1 ' . trans('imet-core::analysis_report.overall.imet_indicator_ranking'),
        'tooltipKey' => 'ranking'
    ])

    <div :id="'{{ $name }}-ranking-' + index">
        <container_actions :data="value"
                           :name="'{{ $name }}-ranking-' + index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{ $exclude_elements }}'">
            <template v-slot:default="data_elements">
                <bar_category_stack
                    :title="'4.1 @lang('imet-core::analysis_report.overall.imet_indicator_ranking')'"
                    :axis_dimensions_y="{ max: 100 }"
                    :x_axis_data="data_elements.props.xAxis"
                    :legends="data_elements.props.legends"
                    :colors="container.props.config.color_correct_order"
                    :percent_values="data_elements.props.percent_values"
                    :raw_values="data_elements.props.raw_values"
                    :values="data_elements.props.values">
                </bar_category_stack>
            </template>
        </container_actions>
    </div>
</div>

