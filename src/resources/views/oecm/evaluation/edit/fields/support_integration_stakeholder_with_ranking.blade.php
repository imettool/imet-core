<?php
$score = "records[index]['__score']";

?>

<x-modular-forms::module.components.field.input
    type="disabled"
    :value="$v_value"
    :id="$id"
    :class="$class"
    :rules="$rules"
    :other="$other"
    :module_key="$module_key"
></x-modular-forms::module.components.field.input>

<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    <div v-if={{ $score }}!==null>
        <b>@lang('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ranking')</b>
        <span v-html="parseFloat({{ $score }}).toFixed(2)"></span>
    </div>
</div>
