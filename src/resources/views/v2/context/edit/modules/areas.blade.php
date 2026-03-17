<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

$vue_record_index = '0';

$index_id = "'" . $definitions['module_key'] . "_'+" . $vue_record_index . "+'_Index'";

// Recalculate shapeIndex: in older versions it was miscalculated and stored in the database.
if(array_key_exists($vue_record_index, $vueData['records']) && array_key_exists('FormID', $vueData['records'][$vue_record_index])){
    $area = \ImetCore\Models\Imet\v2\Modules\Context\Areas::getArea($vueData['records'][$vue_record_index]['FormID']);
    $boundaryLength = $vueData['records'][$vue_record_index]['BoundaryLength'];
    $vueData['records'][$vue_record_index]['Index'] = $module::getShapeIndex($area, $boundaryLength);
}

?>

@foreach($definitions['fields'] as $field_index => $field)

    @component('modular-forms::module.components.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])

        @if(in_array($field_index, [0, 1, 2]))

            @php
                $convert_to_km = "@input=convertToKm(\"{$field['name']}\")";
                $convert_to_ha = "@input=convertToHa(\"{$field['name']}\")";
            @endphp

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index,
                'vue_directives' => $convert_to_km
            ])
            <span class="ml-2 mr-4">[ha]</span>

            <x-modular-forms::module.components.field.input
                :type="$field['type']"
                :value="$field['name'].'_km2'"
                :other="$convert_to_ha"
            ></x-modular-forms::module.components.field.input>
            <span class="ml-2">[km2]</span>

        @elseif($field_index===3)

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index,
                'vue_directives' => '@input="calculateShapeIndex()"'
            ])
            <span class="ml-2">[km]</span>

        @elseif($field_index===4 || $field_index===5)

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])
            <span class="ml-2">[km2]</span>

        @elseif($field_index<10)

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

            <span class="ml-2">%</span>

        @elseif($field_index===10)

            <x-modular-forms::module.components.field.input
                type="numeric"
                :value="'records['.$vue_record_index.'].'.$field['name']"
                :id="$index_id"
                other='style="max-width: 180px;" disabled="disabled"'
            ></x-modular-forms::module.components.field.input>

        @endif

    @endcomponent

@endforeach

@push('scripts')
    <style>
        #module_imet__v2__context__areas .module-row__input div {
            display: inline-block;
        }
    </style>

    <script type="module">
        window.imet__v2__context__areas = (new window.ImetCore.Apps.Modules.ImetV2.context.Areas(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
