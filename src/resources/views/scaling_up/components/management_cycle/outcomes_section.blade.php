<container_analysis_management_cycle
    id="sub_elem_6"
    :info_label="'imet-core::analysis_report.guidance.outcomes.main'"
    :title="container.props.config.element_diagrams.outcomes[0].menu.header"
    :url="url"
    :type="'outcomes'"
    :items="{{ json_encode($custom_names) }}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.management_cycle.analysis.analysis_element', [
            'name' => $name,
            'dontShowTitle' => false,
            'sub_class' => 'sub-title-second',
        ])
    </template>
</container_analysis_management_cycle>

