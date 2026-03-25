<?php
/** @var string $v_id */
/** @var string $v_value */
/** @var string $class  */
/** @var ?string $other [optional] */
/** @var ?string $rules [optional] */
/** @var string $type */
/** @var string $slug */

use ModularForms\Helpers\DOM;

$vue_attributes = DOM::vueAttributes($v_id, $v_value);
$rules_attribute = DOM::rulesAttribute($rules);
$other_attributes = $other ?? '';

?>

<dropdown
    :data-values=SubGovernanceModel_options
    {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></dropdown>
