<?php
use ImetCore\Helpers\SelectionList;

$list = SelectionList::getList('Imet_PaType');
?>

@foreach($list as $v => $l)
    <label class="radio-inline">
        <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="{{ $v }}"/>
        {{ $l }}
    </label>
@endforeach


