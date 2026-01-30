<container-section
    :event_name="'{{ $name }}'"
    :id="'{{ $name }}'"
    :title="'{{ $title }}'"
    :code="'{{ $code }}'"
    :info_label="'{{ $info_label }}'">
    <template v-slot:default="container">
        <div class="max-w-12xl m-auto">

            @include('imet-core::scaling_up.components.management_cycle.context_section')

            @include('imet-core::scaling_up.components.management_cycle.planning_section')

            @include('imet-core::scaling_up.components.management_cycle.inputs_section')

            @include('imet-core::scaling_up.components.management_cycle.process_section')

            @include('imet-core::scaling_up.components.management_cycle.outputs_section')

            @include('imet-core::scaling_up.components.management_cycle.outcomes_section')

        </div>
    </template>
</container-section>


