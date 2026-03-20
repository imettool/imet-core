<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v2\Imet;

$vue_record_index = '0';

?>

@component('modular-forms::module.components.field_container', [
    'name' => $definitions['fields'][0]['name'],
    'label' => $definitions['fields'][0]['label'],
    'label_width' => $definitions['label_width']
])

    {{-- input field --}}
    @include('modular-forms::module.edit.field.module-to-vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][0],
        'vue_record_index' => $vue_record_index
    ])

@endcomponent


<div id="geographical_location_exist" v-show="limit_exists">

    @foreach($definitions['fields'] as $index=>$field)

        @if($index>0)

            @component('modular-forms::module.components.field_container', [
                    'name' => $field['name'],
                    'label' => $field['label'] ?? '',
                    'label_width' => $definitions['label_width']
                ])

                {{-- input field --}}
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $field,
                    'vue_record_index' => $vue_record_index
                ])

            @endcomponent

        @endif

    @endforeach
</div>

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.GeographicalLocation(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
