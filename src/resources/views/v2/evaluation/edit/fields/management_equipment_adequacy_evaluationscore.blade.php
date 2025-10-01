<?php
$adequacy_id = "'" . $module_key . "_'+index+'___adequacy'";
?>

<x-modular-forms::module.components.field.input
    type="disabled"
    value="records[index].__adequacy"
    :id="$adequacy_id"
    class='style="width: 100px; text-align: center;"'
></x-modular-forms::module.components.field.input>
