<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

?>

@include('modular-forms::module.edit.type.table', ['definitions' => $definitions])
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.FinancialResourcesPartners(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush

