<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v1\Imet;

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject Average calculation
for($i=0; $i<=12; $i++){
    $view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group'.$i, 2, 2);
}

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.context.Equipments(@json($vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
