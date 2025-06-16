<container_section :id="'{{ $name }}'" :title="'{{ $title }}'" :code="'{{ $code }}'"
                   :info_label="'imet-core::analysis_report.guidance.thematic.main'">
    <template v-slot:default="container">
        <div class="max-w-12xl m-auto">
            <container_analysis_management_cycle id="sub_elem_1" :items="{{ json_encode($custom_names) }}"
                                                 :title="'climate change'"
                                                 :info_label="'imet-core::analysis_report.guidance.context.main'"
                                                 :parameters="'{{$pa_ids}}'"
                                                 :url=url
                                                 :func="'get_climate_change'">
                <template v-slot:default="data">
                    @include('imet-core::scaling_up.components.thematics.climate_change')
                </template>
            </container_analysis_management_cycle>
        </div>
        <div class="max-w-12xl m-auto">
            <container_analysis_management_cycle id="sub_elem_1" :items="{{ json_encode($custom_names) }}"
                                                 :title="'climate change'"
                                                 :info_label="'imet-core::analysis_report.guidance.context.main'"
                                                 :parameters="'{{$pa_ids}}'"
                                                 :url=url
                                                 :func="'get_ecosystem_services'">
                <template v-slot:default="data">
                    @include('imet-core::scaling_up.components.thematics.ecosystem_services')
                </template>
            </container_analysis_management_cycle>
        </div>
    </template>
</container_section>
