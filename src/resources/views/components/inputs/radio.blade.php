<?php

use ImetCore\Helpers\SelectionList;

$list_type = \Illuminate\Support\Str::replace('imet-core::radio-', '', $type);
$list = SelectionList::getList($list_type);
?>

<radio
    data-values='@json($list)'
    {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></radio>
