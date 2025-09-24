<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record = $records[0];

?>

@foreach($definitions['fields'] as $field_index => $field)

    @component('modular-forms::module.components.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => $definitions['label_width']
            ])

        @if($field_index<3)
            <div style="display: flex; justify-content: space-between;">
                <x-modular-forms::module.components.field.input-preview
                    :type="$field['type']"
                    :value="$record[$field['name']]"
                ></x-modular-forms::module.components.field.input-preview>
                <div style="margin: 0 40px 0 5px;">[ha]</div>
                <x-modular-forms::module.components.field.input-preview
                    :type="$field['type']"
                    :value="$record[$field['name']]"
                ></x-modular-forms::module.components.field.input-preview>
                <div style="margin: 0 40px 0 5px;">[km2]</div>
            </div>
        @else
            <x-modular-forms::module.components.field.input-preview
                :type="$field['type']"
                :value="$record[$field['name']]"
            ></x-modular-forms::module.components.field.input-preview>
        @endif
    @endcomponent
@endforeach

