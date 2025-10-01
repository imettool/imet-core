<?php
use ModularForms\Helpers\DOM;

$vue_attributes = DOM::vueAttributes($id, $v_value);
$rules_attribute = DOM::rulesAttribute($rules);
$other_attributes = $other ?? '';

?>

<dropdown
    :data-values=SubGovernanceModel_options
    {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></dropdown>
