<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

/** @var array $records */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;

foreach ($records as $i => $record) {
    $records[$i]['Equipment'] = $record['__predefined_label'];
    $records[$i]['EvaluationScore'] = $record['__adequacy'];
}
@endphp

@include('imet-core::components.module.show.table_with_nothing_to_evaluate', ['definitions' => $definitions, 'records' => $records])
