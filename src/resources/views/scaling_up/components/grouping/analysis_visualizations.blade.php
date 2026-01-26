<container
    :url="url"
    :event-parameters="true"
    :lazy_load_parameters="true"
    :func="'get_grouping_analysis'"
    :on_load="false"
    :trigger_incoming_data="params.trigger_incoming_data">
    <template v-slot:default="values">
        <container_actions
            :data="values.props"
            :name="'render_image'"
            :event_image="'save_entire_block_as_image'"
            :exclude_elements="'{{$exclude_elements}}'">
            <template v-slot:default="data_elements">

                @include('imet-core::scaling_up.components.grouping.radar_chart')

                @include('imet-core::scaling_up.components.grouping.scatter_chart')

            </template>
        </container_actions>
    </template>
</container>

