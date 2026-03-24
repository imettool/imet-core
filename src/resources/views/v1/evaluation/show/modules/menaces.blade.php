<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV1\Modules\Context\MenacesPressions;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$view_table = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();

$dom = HtmlPageCrawler::create(
    Helpers::trimNewlines($view_table)
);
$dom->filter('thead > tr > th')->eq(0)->append('<th></th>');

$stats = MenacesPressions::getStats($module->data['id'])['category_stats'];
$items = [];
foreach ($stats as $i => $stat) {
    $input = '<input type="text" disabled="disabled" value="' . $stat . '" class="field-disabled field-edit field-numeric text-center" />';
    $items[] = $dom->filter('tbody > tr.module-table-item')->eq($i)->filter('td')->eq(0)->append('<td>' . $input . '</td>');;
}

?>

{!! $dom->saveHTML() !!}
@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])

