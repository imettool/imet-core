<container-section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :info_label="'{{ $info_label }}'">
    <template v-slot:default="container">
        <container-view
            :loaded_at_once="true"
            :title="'{{trans('imet-core::analysis_report.additional_options.management_effectiveness_analysis')}}'"
            :info_label="'imet-core::analysis_report.guidance.additional_options.management_effectiveness'">
            <template v-slot:default="data">
                @include('imet-core::scaling_up.components.additional_options.management_effectiveness_analysis', ['name' => $name])
            </template>
        </container-view>
        <container-view
            :loaded_at_once="true"
            :title="'{{trans('imet-core::analysis_report.additional_options.summary_key_elements_affecting_management_elements')}}'"
            :info_label="'imet-core::analysis_report.guidance.additional_options.specific_actions_mention'">
            <template v-slot:default="data">
                @include('imet-core::scaling_up.components.additional_options.specific_actions_mention', ['name' => $name])
            </template>
        </container-view>
    </template>
</container-section>
