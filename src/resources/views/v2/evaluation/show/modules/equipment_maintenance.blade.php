<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $records */

foreach ($records as $i => $record){
    $records[$i]['Equipment'] = $records[$i]['__predefined_label'];
}

?>

@include('modular-forms::module.show.type.table', compact(['definitions', 'records']))
