<div class="flex flex-col mt-3">
    @include('imet-core::scaling_up.components.overall.section_header', [
        'title' => '4.2 ' . trans('imet-core::analysis_report.overall.average_contribution'),
        'tooltipKey' => 'average_contribution'
    ])

    <div :id="'{{ $name }}-averages_six_elements-' + index">
        <container-actions :data="value"
                           :name="'{{ $name }}-averages_six_elements-' + index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{ $exclude_elements }}'">
            <template v-slot:default="data_elements">
                <imet-bar-error
                    :title="'4.2 @lang('imet-core::analysis_report.overall.average_contribution')'"
                    :axis_dimensions_x="{ max: 100 }"
                    :event_id="'save_image_s'"
                    :show_legends="true"
                    :values="data_elements.props"
                    :legends="data_elements.props.legends"
                    :indicators="container.props.config.relative_performance_effectiveness_bar_average.indicators">
                </imet-bar-error>
            </template>
        </container-actions>
    </div>
</div>

