<?php
/** @var ReportController $controller */
/** @var Imet_Report $item */

use ImetCore\Controllers\Imet\ImetV2\ReportController;
use ImetCore\Models\Imet\ImetV2\Imet_Report;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ImetCore\Services\Scores\ImetScores;
use ModularForms\Enums\ModuleViewModes;

$show_general_info = !ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id);
$scores = ImetScores::get_all($item);

?>

@include('imet-core::v2.report.report', [
    'controller' => $controller,
    'item' => $item,
    'scores' => $scores,
    'show_general_info' => $show_general_info,
    'mode' => ModuleViewModes::EDIT
])
