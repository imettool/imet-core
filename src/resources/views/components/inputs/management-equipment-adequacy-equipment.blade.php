<?php
$equipment_id = "'" . $slug . "_'+index+'_Equipment'";
$equipment_predefined_label_id = "'".$slug."_'+index+'_Equipment-predefined_label'";

?>

<x-modular-forms::module.components.field.input
    type="hidden"
    value="records[index].Equipment"
    :id="$equipment_id"
></x-modular-forms::module.components.field.input>

<x-modular-forms::module.components.field.input
    type="disabled"
    value="records[index].__predefined_label"
    :id="$equipment_predefined_label_id"
    class="field-disabled"
></x-modular-forms::module.components.field.input>
