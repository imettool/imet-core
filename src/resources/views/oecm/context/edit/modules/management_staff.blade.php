<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Models\Imet\ImetOecm\Imet;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$view = View::make('modular-forms::module.edit.type.table', ['definitions' => $definitions])->render();
$diff_col = '<input type="text" disabled="disabled" style="width: 80px;"
                class="field-edit text-right"
                v-bind:value="diffs[index]"
                v-bind:id="\'' . $definitions['slug'] . '\' + index + \'_diff\'"
            />';

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
$dom->filter('thead tr th')->eq(5)->append('<th class="text-center">' . trans('imet-core::oecm_context.ManagementStaff.fields.Difference') . '</th>');
$dom->filter('tbody tr td')->eq(5)->append('<td>' . $diff_col . '</td>');

?>

{!! $dom->saveHTML() !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.context.ManagementStaff(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
