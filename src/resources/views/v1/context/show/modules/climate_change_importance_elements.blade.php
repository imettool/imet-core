<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $records */

$labels = trans('imet-core::v1_context.ClimateChangeImportanceElements.Element');
foreach ($records as $index=>$record){
    if(in_array($index, $labels)){
        $records[$index]['Element'] = $labels[$index];
    }
}

?>

@include('modular-forms::module.show.body', compact(['collection', 'definitions']))

