<container-analysis-management-cycle
    id="{{$id}}"
    :title="container.props.config.element_diagrams.{{$type}}[0].menu.title"
    :url="url"
    :type="'{{$type}}'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{ json_encode($custom_names) }}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.management_cycle.analysis.analysis_element', [
            'name' => $name,
            'dontShowTitle' => true
        ])
    </template>
</container-analysis-management-cycle>

