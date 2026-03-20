<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v1\Imet_Eval;

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject Average calculation
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 3, 2);
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 3, 2);
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 3, 2);
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 3, 2);
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 3, 2);


?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.evaluation.DesignatedValuesConservation(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
