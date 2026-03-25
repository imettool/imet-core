<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

foreach ($records as $i => $record) {
    $records[$i]['Equipment'] = $record['__predefined_label'];
}

?>

@include('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])
