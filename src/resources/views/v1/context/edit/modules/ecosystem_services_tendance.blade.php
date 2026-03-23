<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v1\Imet;

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject titles
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group0', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title1'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group3', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title2'));
$view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group6', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title3'));

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

<x-modular-forms::module.components.script
    :module="$module"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
