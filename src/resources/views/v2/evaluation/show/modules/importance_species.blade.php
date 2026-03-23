<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

/** @var array $records */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;

?>

@include('imet-core::components.module.show.group_with_nothing_to_evaluate', ['definitions' => $definitions, 'records' => $records])
