<?php
/** @phpstan-var ?string $slug  */

$equipment_id = "'" . $slug . "_'+index+'_Equipment'";
$equipment_predefined_label_id = "'".$slug."_'+index+'_Equipment-predefined_label'";

?>

<x-imet-core::custom-input
    type="hidden"
    value="records[index].Equipment"
    :id="$equipment_id"
></x-imet-core::custom-input>

<x-imet-core::custom-input
    type="disabled"
    value="records[index].__predefined_label"
    :id="$equipment_predefined_label_id"
    class="field-disabled"
></x-imet-core::custom-input>
