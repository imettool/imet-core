<?php
/** @var Imet $item */
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements_ecosystem_charts */
/** @var array $key_elements_biodiversity_charts */
/** @var array $key_elements_biodiversity */
/** @var array $key_elements_ecosystem */
/** @var array $report */
/** @var array $report_schema */
/** @var array $area */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
/** @var Array $governance */

/** @var Array $stake_analysis */

use ImetCore\Models\Imet\ImetOecm\Imet;

?>

@include('imet-core::oecm.report.report', [
    'item' => $item,
    'action' => 'show',
    'scores' => $scores,
    'labels' => $labels,
    'key_elements_ecosystem_charts' => $key_elements_ecosystem_charts,
    'key_elements_biodiversity_charts' => $key_elements_biodiversity_charts,
    'key_elements_biodiversity' => $key_elements_biodiversity,
    'key_elements_ecosystem' => $key_elements_ecosystem,
    'report' => $report,
    'report_schema' => $report_schema,
    'area' => $area,
    'show_non_wdpa' => $show_non_wdpa,
    'non_wdpa' => $non_wdpa
])
