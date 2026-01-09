<container-section :id="'{{ $name }}'" :title="'{{ $title }}'" :class="'upper_downa'"
    :code="'{{ $code }}'" :info_label="'{{ $info_label }}'">
    <template v-slot:default="container">
        <checkboxes-list :items="{{ json_encode($custom_names) }}">
            <template v-slot:default="pas">

                <container :loaded_at_once="pas.props.show_view" :url=url :parameters="pas.props.ids"
                    :func="'get_upper_lower_protected_areas_diagram_compare'" :element="'{{ $name }}'"
                    :show_menu="true">
                    <template v-slot:default="data">

                        <div v-for="(radar, index) in data.props">
                            <small-menu v-if="index!=='form_ids'" :items="data.props.diagrams"
                                :ids="'upper_lower_'" :exclude="'Average,upper limit,lower limit'"></small-menu>
                            <container-upper-lower-radars v-if="index!=='form_ids'" :width=1128 :height=750
                                :unselect_legends_on_load="true" :single="false" :show_legends="true"
                                :indicators='container.props.config.indicators' :radar="radar">
                            </container-upper-lower-radars>
                        </div>
                    </template>
                </container>
            </template>
        </checkboxes-list>

    </template>
</container-section>
