<?php

/** @var string $v_value */
/** @var string $v_id */
/** @var string $class  */
/** @var ?string $other [optional] */

$vue_attributes = \ModularForms\Helpers\DOM::vueAttributes($v_id, $v_value);

?>

<input type="hidden" {!! $vue_attributes !!} {!! $class !!} {!! $other !!} />
<div class="field-preview field-disabled">@{{ key_element_label({!! $v_value !!}) }}</div>
