<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

use ImetCore\Models\Imet\ImetV1\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;

$view_groupTable = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject titles
foreach (MenacesPressions::$groupsByCategory as $i => $category) {
    $view_groupTable = \ModularForms\Helpers\Module::injectGroupTitle(
        $view_groupTable, $definitions['slug'], $category[0],
        ($i + 1) . '. ' . trans('imet-core::v1_context.MenacesPressions.categories.title' . ($i + 1)));
}

// inject column with row stats
$searchFor = '<input type="hidden" v-model="records[index].group_key"';
$textToAdd = '<div class="field-preview field-numeric">{{ recordStats[index] }}</div>';
$view_groupTable = str_replace($searchFor, $textToAdd . $searchFor, $view_groupTable);
?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.context.MenacesPressions(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
