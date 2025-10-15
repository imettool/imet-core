<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $records */

foreach ($records as $i => $record){
    $records[$i]['Equipment'] = $records[$i]['__predefined_label'];
    $records[$i]['Adequacy'] = $records[$i]['__adequacy'];
}

?>

@include('imet-core::components.module.show.table_with_nothing_to_evaluate', compact(['collection', 'records', 'definitions']))
