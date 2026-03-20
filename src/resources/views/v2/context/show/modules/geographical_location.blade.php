<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Imet;

if(!$records[0]['LimitsExist']){
    $definitions['fields'] =  array_splice($definitions['fields'], 0, 1);
}

?>

@include('modular-forms::module.show.type.simple', ['definitions' => $definitions, 'records' => $records])
