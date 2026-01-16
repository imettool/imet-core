<container-section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :info_label="'{{ $info_label }}'">
    <template v-slot:default="container">

        <container
                :loaded_at_once="container.props.show_view"
                :url=url
                :parameters="'{{$pa_ids}}'"
                :func="'get_management_context'"

        >
            <template v-slot:default="data">
                <div v-for="(value, index) in data.props">
                    <management-context
                            :values="value"
                    ></management-context>
                </div>

            </template>
        </container>

    </template>
</container-section>

