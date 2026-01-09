@include('imet-core::scaling_up.components.threats.subsection_header', [
    'menuKey' => 'average_contribution',
    'tooltipKey' => 'average_contribution'
])

<div :id="'{{$name}}-average-contribution-threat'">
    <container-actions :data="values.props"
                       :name="'{{$name}}-average-contribution-threat'"
                       :event_image="'save_entire_block_as_image'">
        <template v-slot:default="v">
            <div v-if="v.props.average_contribution">
                <imet-bar-error
                    :title="container.props.config.element_diagrams.threats.menu.average_contribution"
                    :error_color="'#fff000'"
                    :axis_dimensions_x="{max:100}"
                    :show_legends="true"
                    :values="values.props.average_contribution.data"
                    :legends="values.props.average_contribution.legends"
                    :height="values.props.average_contribution.options.height"
                    :indicators="values.props.average_contribution.indicators">
                </imet-bar-error>
            </div>
        </template>
    </container-actions>
</div>

