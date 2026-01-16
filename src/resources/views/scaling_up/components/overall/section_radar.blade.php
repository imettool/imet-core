<div class="flex flex-col">
    @include('imet-core::scaling_up.components.overall.section_header', [
        'title' => '4.3 ' . trans('imet-core::analysis_report.overall.radar_visualization'),
        'tooltipKey' => 'radar'
    ])

    {{-- Radar Chart --}}
    <div :id="'{{ $name }}-radar-' + index">
        <container_actions :data="value"
                           :name="'{{ $name }}-radar-' + index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{ $exclude_elements }}'">
            <template v-slot:default="data_elements">
                <scaling_radar
                    class="sm"
                    :height="850"
                    :title="'4.3 @lang('imet-core::analysis_report.overall.radar_visualization')'"
                    :single="false"
                    :event_key="'overall'"
                    :unselect_legends_on_load="true"
                    :show_legends="true"
                    :values="data_elements.props"
                    :indicators="container.props.config.performance_diagram.indicators"
                    :data_table="'test'">
                </scaling_radar>
                <div style="font-size: 12px" class="align-center">
                    {{ trans('imet-core::analysis_report.average_protected_areas') }}
                </div>
            </template>
        </container_actions>
    </div>

    {{-- Radar Datatable --}}
    <div :id="'{{ $name }}-radar-datatable-' + index">
        <container_actions :data="value"
                           :name="'{{ $name }}-radar-datatable-' + index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{ $exclude_elements }}'">
            <template v-slot:default="data_elements">
                <datatable_interact_with_radar
                    :default_order="'imet_index'"
                    :event_key="'overall'"
                    class="col-sm"
                    :values_with_indicators_keys="true"
                    :values="data_elements.props"
                    :columns="container.props.config.performance_diagram.columns">
                </datatable_interact_with_radar>
            </template>
        </container_actions>
    </div>
</div>

