<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject Average calculation to "EvaluationScore" column
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
        (new window.ImetCore.Apps.Modules.ImetV1.evaluation.InformationAvailability(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
