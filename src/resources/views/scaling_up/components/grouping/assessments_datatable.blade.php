<container
    :loaded_at_once="container.props.show_view"
    :url="url"
    :parameters="'{{$pa_ids}}'"
    :func="'get_assessments'">
    <template v-slot:default="data">
        <div v-for="(value, index) in data.props" :id="'{{$name}}-'+index">
            <datatable-scaling
                :columns="container.props.config.evaluation_of_protected_area_management_cycle.columns"
                :values="Object.values(value)"
                :default_order="'name'">
            </datatable-scaling>
        </div>
    </template>
</container>

