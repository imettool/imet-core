<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v1\Imet;
$labels = trans('imet-core::v1_context.ClimateChangeImportanceElements.Element');
foreach ($records as $index=>$record){
    if(in_array($index, $labels)){
        $records[$index]['Element'] = $labels[$index];
    }
}

?>

@include('modular-forms::module.show.type.accordion', ['definitions' => $definitions, 'records' => $records])

