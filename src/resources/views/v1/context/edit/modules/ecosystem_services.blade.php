<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v1\Imet;

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

    // Inject titles
    $view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group0', trans('imet-core::v1_context.EcosystemServices.categories.title1'));
    $view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group3', trans('imet-core::v1_context.EcosystemServices.categories.title2'));
    $view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['slug'], 'group6', trans('imet-core::v1_context.EcosystemServices.categories.title3'));

    // Inject average calculation
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group5', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group6', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group7', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group8', 4, 2);
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group9', 4, 2);


?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.context.EcosystemServices(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
