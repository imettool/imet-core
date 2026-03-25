<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV1\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$view = View::make('modular-forms::module.edit.type.table', ['definitions' => $definitions])->render();

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
$dom->filter('thead tr th')->eq(0)->append('<th></th>');
$dom->filter('tbody tr td')->eq(0)->append('<td><div class="field-preview w-16" v-html=stats[index]></div></td>');

$module->vueData['stats'] = collect(MenacesPressions::getStats($module->vueData['form_id'])['category_stats'])
    ->map(fn($item): float => round($item, 2))->all();
?>


{!! $dom->saveHTML() !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.evaluation.Menaces(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
