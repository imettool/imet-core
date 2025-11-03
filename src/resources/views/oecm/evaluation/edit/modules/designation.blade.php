<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', [
    'collection' => $collection,
    'definitions' => $definitions,
    'vueData' => $vueData,
])

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
