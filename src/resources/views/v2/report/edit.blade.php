<?php
/** @var \ImetCore\Models\Imet\v2\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $report */
/** @var array $wdpa_extent */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool  $connection */
/** @var bool  $show_general_info */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
?>

@include('imet-core::v2.report.report', [
    'action' => 'edit',
    'scores' => $scores,
    'labels' => $labels,
    'key_elements' => $key_elements,
    'report' => $report,
    'wdpa_extent' => $wdpa_extent,
    'general_info' => $general_info,
    'vision' => $vision,
    'area' => $area,
    'connection' => $connection,
    'show_general_info' => $show_general_info,
    'show_non_wdpa' => $show_non_wdpa,
    'non_wdpa' => $non_wdpa,
    'type' => 'edit'
])
