<?php
/** @var \ImetCore\Models\Imet\v2\Imet $item */
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements */
/** @var array $report */
/** @var array $wdpa_extent */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool  $connection */
?>

@include('imet-core::v2.report.report', [
    'action' => 'show',
    'scores' => $scores,
    'labels' => $labels,
    'key_elements' => $key_elements,
    'report' => $report,
    'wdpa_extent' => $wdpa_extent,
    'general_info' => $general_info,
    'vision' => $vision,
    'area' => $area,
    'connection' => $connection
])
