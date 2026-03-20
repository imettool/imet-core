<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v1\Imet;

?>

@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
@include('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])

