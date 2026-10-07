<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$kce_idx = 0;
foreach ($definitions['fields'] as $i => $field) {
    if (\Illuminate\Support\Str::startsWith($field['name'], 'kce')) {
        $definitions['fields'][$i]['label'] = $field['label'] . ' <div class="italic" v-html=kce_names[' . $kce_idx . ']></div>';
        $kce_idx++;
    }
}

?>

@include('modular-forms::module.edit.type.table', ['definitions' => $definitions])


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.report.ThreatsAffectingKCEs(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
