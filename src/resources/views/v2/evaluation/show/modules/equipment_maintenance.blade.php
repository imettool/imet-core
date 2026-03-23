<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

/** @var array $records */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;

foreach ($records as $i => $record) {
    $records[$i]['Equipment'] = $record['__predefined_label'];
}

?>

@include('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])
