<container_section :id="'{{ $name }}'" :title="'{{ $title }}'" :code="'{{ $code }}'"
                   :info_label="'{{ $info_label }}'">
    <template v-slot:default="container">
        <checkboxes_list :items="{{ json_encode($custom_names) }}">
            <template v-slot:default="pas">
                <container :loaded_at_once="pas.props.show_view"
                           :url="url"
                           :parameters="pas.props.ids"
                           :func="'get_overall_management_effectiveness_scores'">
                    <template v-slot:default="data">
                        <div v-for="(value, index) in data.props" :id="'{{ $name }}-' + index">

                            <div v-if="index === 'ranking'">
                                @include('imet-core::scaling_up.components.overall.section_ranking')
                            </div>

                            <div v-if="index === 'averages_six_elements'">
                                @include('imet-core::scaling_up.components.overall.section_average_contribution')
                            </div>

                            <div v-if="index === 'radar'">
                                @include('imet-core::scaling_up.components.overall.section_radar')
                            </div>

                            <div v-if="index === 'scatter'">
                                @include('imet-core::scaling_up.components.overall.section_scatter')
                            </div>

                            <div v-if="index === 'assessments'">
                                @include('imet-core::scaling_up.components.overall.section_assessments')
                            </div>

                        </div>
                    </template>
                </container>
            </template>
        </checkboxes_list>

    </template>
</container_section>
