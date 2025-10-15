<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $vueData */

?>

@include('imet-core::components.module.edit.group_with_nothing_to_evaluate', [
    'collection' => $collection,
    'definitions' => $definitions,
    'vueData' => $vueData,
])

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
