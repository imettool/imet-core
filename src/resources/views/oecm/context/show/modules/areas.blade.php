<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$record = $records[0];

?>

@foreach($definitions['fields'] as $f_index => $field)

    @component('modular-forms::module.components.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])

        @if($f_index>2)

            <div style="display: flex; justify-content: space-between;">
                <x-imet-core::custom-input-preview
                        :type="$field['type']"
                        :value="$record[$field['name']]"
                ></x-imet-core::custom-input-preview>
                <div style="margin: 0 40px 0 5px;">[ha]</div>

                <x-imet-core::custom-input-preview
                        :type="$field['type']"
                        :value="$record[$field['name']]/100"
                ></x-imet-core::custom-input-preview>
                <div style="margin: 0 40px 0 5px;">[km2]</div>
            </div>

        @else

            {{-- input field --}}
            <x-imet-core::custom-input-preview
                    :type="$field['type']"
                    :value="$record[$field['name']]"
            ></x-imet-core::custom-input-preview>
            [km2]

        @endif

    @endcomponent

@endforeach

