<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use ImetCore\Models\Imet\ImetV2\Modules\Context\FinancialResources;
use ModularForms\View\Module\Components\Field\InputPreview;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;


$totalBudget = FinancialResources::getTotalBudget($records[0]['FormID']);
$totalSum = 0;
foreach ($records as $index => $record) {
    $records[$index]['__sum_row'] = $record[$definitions['fields'][1]['name']]
        + $record[$definitions['fields'][2]['name']]
        + $record[$definitions['fields'][3]['name']]
        + $record[$definitions['fields'][4]['name']];
    $totalSum += $records[$index]['__sum_row'];
}
$totalSum /= 2;


$table = View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();
$dom = HtmlPageCrawler::create(
    Helpers::trimNewlines($table)
);
$table_dom = $dom->filter('table#table_' . $definitions['slug']);

$table_dom->filter('thead tr th')->eq(4)
    ->after('<th class="text-center">' . ucfirst(trans('imet-core::v2_context.FinancialAvailableResources.fields.total')) . '</th>');

$table_dom->filter('tbody tr')->each(function ($tr, $index) use ($records): void {
    $tr->filter('td')->eq(4)->after(
        '<td>
        ' . Blade::renderComponent(new InputPreview(type: 'integer', value: $records[$index]['__sum_row'])) . '
    </td>');
});

?>

{!! $dom->saveHTML() !!}
