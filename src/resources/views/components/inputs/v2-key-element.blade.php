<?php
/** @phpstan-var string $value  */

use ModularForms\Helpers\DOM;

// Use the __key_element_label as label if exists, otherwise fallback to the original value
$label_v_value = preg_replace('/^(.*\.)\w*$/', '$1__key_element_label', $value);
$label_v_value = '' . $label_v_value . ' || ' . $value;

?>

<input type="hidden" {!! $vue_attributes !!} {!! $class !!} {!! $other !!} />
<div class="field-preview field-disabled" v-html="key_element_label({!! $label_v_value !!})"></div>
