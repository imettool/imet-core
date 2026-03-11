<?php
/** @var string $v_id */
/** @var string $v_value */
/** @var string $class  */
/** @var ?string $other [optional] */
/** @var ?string $rules [optional] */
/** @var string $type */
/** @var string $module_key */

use ModularForms\Helpers\DOM;

$vue_attributes = DOM::vueAttributes($v_id, $v_value);
$rules_attribute = DOM::rulesAttribute($rules);
$other_attributes = $other ?? '';

?>

<dropdown
    :data-values=SubGovernanceModel_options
    v-show="records[0].GovernanceModel!==null && records[0].GovernanceModel!=='not_reported'"
    {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></dropdown>
