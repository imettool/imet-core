<?php
/** @var string $v_id */
/** @var string $v_value */
/** @var string $class */
/** @var ?string $other [optional] */
/** @var ?string $rules [optional] */
/** @var string $type */

/** @var string $slug */

use ImetCore\Helpers\SelectionList;

$list = SelectionList::getList('Imet_PaType');
?>

@foreach($list as $v => $l)
    <label class="radio-inline">
        <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="{{ $v }}"/>
        {{ $l }}
    </label>
@endforeach


