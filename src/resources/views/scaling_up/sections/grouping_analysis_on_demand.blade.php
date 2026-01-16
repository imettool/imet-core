<container-section
    :id="'{{$name}}'"
    :title="'{{$title}}'"
    :code="'{{$code}}'"
    :info_label="'{{ $info_label }}'">
    <template v-slot:default="container">

        @include('imet-core::scaling_up.components.grouping.assessments_datatable')

        @include('imet-core::scaling_up.components.grouping.grouping_interface')

    </template>
</container-section>
