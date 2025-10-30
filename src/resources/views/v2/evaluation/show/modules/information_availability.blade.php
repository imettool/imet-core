<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $records */
/** @var array $definitions */

?>

@include('imet-core::components.module.show.group_with_nothing_to_evaluate', [
    'definitions' => $definitions,
    'records' => $records,
    'collection' => $collection
])
