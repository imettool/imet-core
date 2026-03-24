<?php
/** @var \ImetCore\Models\Imet\v1\Imet $item */
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements */
/** @var array $report */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool  $show_general_info */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
?>

@include('imet-core::v1.report.report', [
    'action' => 'show',
    'scores' => $scores,
    'labels' => $labels,
    'key_elements' => $key_elements,
    'report' => $report,
    'general_info' => $general_info,
    'vision' => $vision,
    'area' => $area,
    'show_general_info' => $show_general_info,
    'show_non_wdpa' => $show_non_wdpa,
    'non_wdpa' => $non_wdpa,
    'type' => 'show'
])
