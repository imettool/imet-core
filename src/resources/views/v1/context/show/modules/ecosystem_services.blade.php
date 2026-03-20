<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v1\Imet;

$new_records = \ModularForms\Helpers\Module::createRecordsArrayByGroup($records);

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject titles
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group0', trans('imet-core::v1_context.EcosystemServices.categories.title1'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group3', trans('imet-core::v1_context.EcosystemServices.categories.title2'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group6', trans('imet-core::v1_context.EcosystemServices.categories.title3'));

// Inject average calculation
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group0', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group1', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group2', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group3', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group4', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group5', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group5', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group6', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group6', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group7', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group7', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group8', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group8', $new_records));
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group9', 4, 2, '', \ModularForms\Helpers\Module::calculateAverage('Importance', 'group9', $new_records));


?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])

