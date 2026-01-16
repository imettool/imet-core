<container_analysis_management_cycle
    id="sub_elem_1"
    :items="{{ json_encode($custom_names) }}"
    :title="container.props.config.element_diagrams.context[0].menu.header"
    :info_label="'imet-core::analysis_report.guidance.context.main'"
    :url="url"
    :type="'context'"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.management_cycle.analysis.analysis_element', [
            'name' => $name,
            'dontShowTitle' => false,
            'sub_class' => 'sub-title-second',
        ])

        <container
            :loaded_at_once="true"
            :url="url"
            :title="container.props.config.element_diagrams.threats.menu.title"
            :randomKeyEvent="data.props.randomKeyEvent"
            :parameters="data.props.parameters"
            :func="'get_threats_categories_per_protected_area'">
            <template v-slot:default="values">
                <div v-if="Object.entries(data.props.values).length > 0">
                    <div v-if="values.props.values.length > 0">
                        @include('imet-core::scaling_up.components.management_cycle.analysis.analysis_element_threat', [
                            'name' => $name,
                            'sub_class' => 'sub-title-second',
                        ])
                    </div>
                </div>
            </template>
        </container>
    </template>
</container_analysis_management_cycle>

