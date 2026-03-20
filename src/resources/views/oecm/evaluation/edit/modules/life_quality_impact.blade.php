<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['collection' => $collection, 'vueData' => $vueData, 'definitions' => $definitions])->render();

// Inject Average calculation to "EvaluationScore" column
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 3, 2);
$view_groupTable = \ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 3, 2);


?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.evaluation.LifeQualityImpact(@json($vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
