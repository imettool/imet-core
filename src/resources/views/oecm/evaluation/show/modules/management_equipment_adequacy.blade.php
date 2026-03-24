<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

foreach ($records as $i => $record) {
    $records[$i]['Equipment'] = $record['__predefined_label'];
    $records[$i]['Adequacy'] = $record['__adequacy'];
}

?>

@include('imet-core::components.module.show.table_with_nothing_to_evaluate', ['definitions' => $definitions, 'records' => $records])
