<?php
/** @var array $vueData */
/** @var array $definitions */

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject titles
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group0', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title1'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group3', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title2'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group6', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title3'));

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
