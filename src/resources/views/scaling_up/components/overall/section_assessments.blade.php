<div class="mt-3">
    @include('imet-core::scaling_up.components.overall.section_header', [
        'title' => '4.5 ' . trans('imet-core::analysis_report.overall.synthetic_indicators'),
        'tooltipKey' => 'datatable'
    ])

    <div :id="'{{ $name }}-assessments-' + index">
        <container_actions :data="value"
                           :name="'{{ $name }}-assessments-' + index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{ $exclude_elements }}'">
            <template v-slot:default="data_elements">
                <datatable_scaling
                    :default_order="'imet_index'"
                    :default_order_dir="'desc'"
                    :columns="container.props.config.evaluation_of_protected_area_management_cycle.columns"
                    :values="Object.values(data_elements.props)">
                </datatable_scaling>
            </template>
        </container_actions>
    </div>
</div>

