<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\oecm\Imet;
?>

@include('modular-forms::module.edit.type.simple', ['definitions' => $definitions])


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.CreateNonWDPA(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush


