<container_section
    :id="'{{$name}}'"
    :title="'{{$title}}'"
    :code="'{{$code}}'"
    :info_label="'imet-core::analysis_report.guidance.grouping'">
    <template v-slot:default="container">

        @include('imet-core::scaling_up.components.grouping.assessments_datatable')

        @include('imet-core::scaling_up.components.grouping.grouping_interface')

    </template>
</container_section>
