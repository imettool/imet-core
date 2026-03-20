<?php
/** @var array $vueData */
/** @var array $definitions */

?>

@include('modular-forms::module.edit.type.simple', ['definitions' => $definitions])


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.CreateNonWDPA(@json($vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush


