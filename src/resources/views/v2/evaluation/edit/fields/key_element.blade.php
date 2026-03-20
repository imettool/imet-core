<?php
/** @var string $v_id */
/** @var string $v_value */
/** @var string $class  */
/** @var ?string $other [optional] */
/** @var ?string $rules [optional] */
/** @var string $type */
/** @var string $slug */

$vue_attributes = \ModularForms\Helpers\DOM::vueAttributes($v_id, $v_value);

// Use the __key_element_label as label if exists, otherwise fallback to the original value
$label_v_value = preg_replace('/^(.*\.)\w*$/', '$1__key_element_label' , $v_value);
$label_v_value = '' . $label_v_value . ' || ' . $v_value;

?>

<input type="hidden" {!! $vue_attributes !!} {!! $class !!} {!! $other !!} />
<div class="field-preview field-disabled" v-html="key_element_label({!! $label_v_value !!})"></div>
