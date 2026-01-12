<container_view
    id="sub_elem_4"
    :event_name="'sub_elem_4'"
    :info_label="'imet-core::analysis_report.guidance.process.main'"
    :loaded_at_once="container.props.show_view"
    :title="container.props.config.element_diagrams.process[0].menu.header"
    :url="url">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.management_cycle.analysis.analysis_process_elements', [
            'name' => $name,
            'sub_class' => 'sub-title-second',
            'url' => 'url',
        ])
    </template>
</container_view>

