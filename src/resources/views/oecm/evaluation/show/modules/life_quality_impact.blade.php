<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use ImetCore\Helpers\Math;
use ModularForms\View\Module\Components\Field\InputPreview;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;


$page = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();
$dom = HtmlPageCrawler::create(
    Helpers::trimNewlines($page)
);

foreach ($definitions['groups'] as $group_key => $group) {
    $group_records = array_filter($records, function (array $item) use ($group_key): bool {
        return $item['group_key'] === $group_key;
    });
    $input = '<thead>
                <th></th>
                <th>
                    ' . Blade::renderComponent((new InputPreview(type: 'numeric', value: round(Math::records_average($group_records, 'EvaluationScore'), 2)))) . '
                </th>
                <th></th>
            </thead>';
    $dom->filter('table#group_table_imet__v2__evaluation__life_quality_impact_' . $group_key . ' > thead')->append($input);
}
?>
{!! $dom->saveHTML() !!}

