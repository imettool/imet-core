<?php
/** @var array $vueData */
/** @var array $definitions */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', ['definitions' => $definitions])
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
