<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v1\Imet_Eval;

$new_records = \ModularForms\Helpers\Module::createRecordsArrayByGroup($records);

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject Average calculation
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 3, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group0', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 3, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group1', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 3, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group2', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 3, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group3', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 3, 2, '', \ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group4', $new_records));


?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
