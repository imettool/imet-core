<container-section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :info_label="'{{ $info_label }}'">
    <template v-slot:default="container">
        <div id="map-view">
            <container-actions
                    :data="{}"
                    :name="'map-view'"
                    :event_image="'save_entire_block_as_image'"
                    :exclude_elements="'{{$exclude_elements}}'">

                <template v-slot:default="data_elements">
                    <map-view v-if="container.props.show_view" form_ids="{{ $pa_ids }}" :url=url></map-view>
                </template>

            </container-actions>
        </div>

    </template>
</container-section>
