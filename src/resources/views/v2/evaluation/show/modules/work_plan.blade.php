<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $records */

$records = $records[0];

$PlanExistence = boolval($records['PlanExistence']);
?>

@foreach($definitions['fields'] as $index=>$field)

    @if($index==0 || $PlanExistence)
        <div class="module-row">

            {{-- label  --}}
            @if(isset($field['label']) && $field['label']!='')
                <div class="module-row__label">
                    <label for="{{ $field['name'] }}">{!! ucfirst($field['label']) !!}</label>
                </div>
            @endif

            {{-- input --}}
            <div class="module-row__input">
                <x-modular-forms::module.components.field.input-preview
                    :type="$field['type']"
                    :value="$records[$field['name']]"
                ></x-modular-forms::module.components.field.input-preview>
            </div>

        </div>
    @endif

@endforeach
