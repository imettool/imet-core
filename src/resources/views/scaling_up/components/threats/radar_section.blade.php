@include('imet-core::scaling_up.components.threats.subsection_header', [
    'menuKey' => 'radar',
    'tooltipKey' => 'radar'
])

<div :id="'{{$name}}-radar-threat'">
    <container-actions :data="values.props"
                       :name="'{{$name}}-radar-threat'"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template v-slot:default="v">
            <div v-if="v.props.radar">
                <radar-threats
                    class="sm"
                    :title="container.props.config.element_diagrams.threats.menu.radar"
                    :height="750"
                    :single="false"
                    :unselect_legends_on_load="true"
                    :show_legends="true"
                    :indicators="values.props.radar.indicators"
                    :values="values.props.radar.values">
                </radar-threats>
            </div>
        </template>
    </container-actions>
</div>

