<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Report\KeyConservationElements;

$kce_records = KeyConservationElements::getModuleRecords($records[0]['FormID']);
$labels = array_column($kce_records['records'], 'kces');

$kce_idx = 0;
foreach ($definitions['fields'] as $i => $field) {
    if (\Illuminate\Support\Str::startsWith($field['name'], 'kce')) {
        $definitions['fields'][$i]['label'] = $field['label'] . ' <div class="italic">'.trim($labels[$kce_idx]).'</div>';
        $kce_idx++;
    }
}

?>

@include('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])
