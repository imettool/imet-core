<container
    :loaded_at_once="container.props.show_view"
    :url="url"
    :parameters="'{{$pa_ids}}'"
    :func="'get_protected_area_with_countries'">
    <template v-slot:default="data">
        <div v-if="Object.entries(data.props).length > 0">
            <grouping id="exclude" :values="data.props" :number_of_drop_zones="3">
                <template v-slot:default="params">
                    @include('imet-core::scaling_up.components.grouping.analysis_visualizations', [
                        'url' => 'url',
                        'exclude_elements' => $exclude_elements
                    ])
                </template>
            </grouping>
        </div>
    </template>
</container>

