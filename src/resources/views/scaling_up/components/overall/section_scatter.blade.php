<div class="mt-3">
    @include('imet-core::scaling_up.components.overall.section_header', [
        'title' => '4.4 ' . trans('imet-core::analysis_report.overall.scatter_visualization'),
        'tooltipKey' => 'scatter_plt'
    ])

    <div :id="'{{ $name }}-scatter-' + index">
        <container_actions :data="value"
                           :name="'{{ $name }}-scatter-' + index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{ $exclude_elements }}'">
            <template v-slot:default="data_elements">
                <scatter
                    :title="'4.4 @lang('imet-core::analysis_report.overall.scatter_visualization')'"
                    :label_axis_y="'@lang('imet-core::common.steps_eval.context') , @lang('imet-core::common.steps_eval.planning'), @lang('imet-core::common.steps_eval.inputs')'"
                    :label_axis_x="'@lang('imet-core::common.steps_eval.process')'"
                    :label_axis_y2="'@lang('imet-core::common.steps_eval.outcomes'), @lang('imet-core::common.steps_eval.outputs')'"
                    :label_axis_y2_show="false"
                    :values="data_elements.props">
                </scatter>
                <div style="font-size: 12px" class="align-center">
                    {{ trans('imet-core::analysis_report.ranking_info_indicators') }}
                </div>
                <div style="font-size: 12px" class="align-center">
                    * {{ trans('imet-core::analysis_report.size_of_square') }}
                </div>
            </template>
        </container_actions>
    </div>
</div>

