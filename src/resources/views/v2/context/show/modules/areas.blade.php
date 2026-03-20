<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Imet;

$record  = $records[0];

$area = array_key_exists('FormID', $record)
    ? \ImetCore\Models\Imet\v2\Modules\Context\Areas::getArea($record['FormID'])
    : null;
$boundaryLength = $record['BoundaryLength'];

$shapeIndex = $module::getShapeIndex($area, $boundaryLength);

?>

@foreach($definitions['fields'] as $f_index => $field)

    @component('modular-forms::module.components.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if($f_index<3)

            <div style="display: flex; justify-content: space-between;">
                <x-modular-forms::module.components.field.input-preview
                    :type="$field['type']"
                    :value="$record[$field['name']]"
                ></x-modular-forms::module.components.field.input-preview>
                <div style="margin: 0 40px 0 5px;">[ha]</div>

                <x-modular-forms::module.components.field.input-preview
                    :type="$field['type']"
                    :value="$record[$field['name']]/100"
                ></x-modular-forms::module.components.field.input-preview>
                <div style="margin: 0 40px 0 5px;">[km2]</div>
            </div>

        @elseif($f_index===3)

            {{-- input field --}}
            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$record[$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>
            [km]

        @elseif($f_index===4 || $f_index===5)

            {{-- input field --}}
            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$record[$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>
            [km2]

        @elseif($f_index<10)

            {{-- input field --}}
            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$record[$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>
            %

        @elseif($f_index===10)
            <x-modular-forms::module.components.field.input-preview
                type="disabled"
                :value="$shapeIndex"
            ></x-modular-forms::module.components.field.input-preview>
        @endif

    @endcomponent

@endforeach

