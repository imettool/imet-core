<?php
/** @var \ImetCore\Models\Imet\ImetV2\Imet $item */
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements */
/** @var array $report */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
?>

@include('imet-core::v2.report.report', [
    'action' => 'show',
    'scores' => $scores,
    'labels' => $labels,
    'key_elements' => $key_elements,
    'report' => $report,
    'general_info' => $general_info,
    'vision' => $vision,
    'area' => $area
])
