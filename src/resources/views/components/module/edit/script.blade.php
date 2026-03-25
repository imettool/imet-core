@push('scripts')
    <script type="module">

        (new window.ImetCore.Apps.Module(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');

    </script>
@endpush
