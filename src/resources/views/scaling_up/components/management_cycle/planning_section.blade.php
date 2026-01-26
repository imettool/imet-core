<container_analysis_management_cycle
    id="sub_elem_2"
    :loaded_at_once="container.props.show_view"
    :info_label="'imet-core::analysis_report.guidance.planning.main'"
    :title="container.props.config.element_diagrams.planning[0].menu.header"
    :url="url"
    :type="'planning'"
    :items="{{ json_encode($custom_names) }}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.management_cycle.analysis.analysis_element', [
            'name' => $name,
            'dontShowTitle' => false,
        ])
    </template>
</container_analysis_management_cycle>

