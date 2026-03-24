<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$original_table = View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();

$diffs = [];
foreach ($records as $record) {
    $diffs[] = $record['Number'] !== null && $record['AdequateNumber'] !== null
        ? $record['Number'] - $record['AdequateNumber']
        : null;
}

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($original_table));
$dom->filter('thead > tr > th')->eq(5)->append('<th class="text-center">' . trans('imet-core::oecm_context.ManagementStaff.fields.Difference') . '</th>');
$dom->filter('tbody > tr')->each(function ($row, $i) use ($diffs): void {
    $diff_col = '<div class="field-preview">
                    <div class="text-right">' . $diffs[$i] . '</div>
                </div>';
    $row->filter('td')->eq(5)->append('<td>' . $diff_col . '</td>');
});

?>

{!! $dom->saveHTML() !!}
