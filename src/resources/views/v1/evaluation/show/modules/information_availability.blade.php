<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$new_records = \ModularForms\Helpers\Module::createRecordsArrayByGroup($records);

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject Average calculation to "EvaluationScore" column
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group0', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group1', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group2', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group3', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group4', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group5', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group5', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group6', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group6', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group7', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group7', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group8', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group8', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group9', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group9', $new_records));


?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
