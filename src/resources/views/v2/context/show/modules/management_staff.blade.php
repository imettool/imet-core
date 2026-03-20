<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Imet;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use ModularForms\View\Module\Components\Field\InputPreview;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;


$table = View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();
$dom = HtmlPageCrawler::create(
    Helpers::trimNewlines($table)
);

$table_dom = $dom->filter('table#table_' . $definitions['slug']);
$table_dom->filter('thead tr th')->eq(2)->after('<th>' . ucfirst(trans('imet-core::v2_context.ManagementStaff.fields.difference')) . '</th>');
$table_dom->filter('tbody tr')->each(function ($tr, $index) use ($records): void {
    $diff = intval($records[$index]['ActualPermanent']) + intval($records[$index]['ActualPermanentPartnersOrCommunities']) - intval($records[$index]['ExpectedPermanent']);
    $tr->filter('td')->eq(2)->after(
        '<td>
            ' . Blade::renderComponent((new InputPreview(type: 'integer', value: $diff))) . '
        </td>'
    );
});


?>

{!! $dom->saveHTML() !!}

@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
