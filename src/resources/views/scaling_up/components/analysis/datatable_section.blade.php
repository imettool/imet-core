@php
    $tableScalingId = "'{$name}-'+section+'-'+tableValue['name']+'-'+index+'table-scaling'";
@endphp

@include('imet-core::scaling_up.components.analysis.subsection_header', [
    'subClass' => $subClass,
    'menuKey' => 'datatable',
    'tooltipKey' => 'datatable',
    'idPrefix' => 'menu-datatable'
])

<div :id="{{$tableScalingId}}">
    <container-actions :data="section_data"
                       :name="{{$tableScalingId}}"
                       :event_image="'save_entire_block_as_image'">
        <template v-slot:default="data_elements">
            <datatable-scaling
                :columns="tableValue.columns"
                :values="data_elements.props[tableValue['name']].table">
            </datatable-scaling>
        </template>
    </container-actions>
</div>

