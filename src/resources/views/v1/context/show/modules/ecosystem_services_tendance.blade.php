<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', ['collection' => $collection, 'records' => $records, 'definitions' => $definitions])->render();

// Inject titles
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group0', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title1'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group3', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title2'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group6', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title3'));

?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))

