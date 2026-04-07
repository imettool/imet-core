<?php
/** @phpstan-var ?string $slug  */

$adequacy_id = "'" . $slug . "_'+index+'___adequacy'";

?>

<x-imet-core::custom-input
    type="disabled"
    value="records[index].__adequacy"
    :id="$adequacy_id"
    class='style="width: 100px; text-align: center;"'
></x-imet-core::custom-input>
