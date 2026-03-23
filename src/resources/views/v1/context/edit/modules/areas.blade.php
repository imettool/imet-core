<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Models\Imet\ImetV1\Imet;

$vue_record_index = '0';

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

        @else

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

        @endif

    @endcomponent

@endforeach

@push('scripts')
    <style>
        #module_imet__v1__context__areas .module-row__input div {
            display: inline-block;
        }
    </style>

    <script type="module">
        window.imet__v1__context__areas = (new window.ImetCore.Apps.Modules.ImetV1.context.Areas(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush

