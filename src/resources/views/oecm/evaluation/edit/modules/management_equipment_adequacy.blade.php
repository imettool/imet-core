<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', compact(['collection', 'vueData', 'definitions']))
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
