<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use ImetCore\Helpers\Math;
use ModularForms\View\Module\Components\Field\InputPreview;
use Wa72\HtmlPageDom\HtmlPageCrawler;


$view_groupTable = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

$dom = HtmlPageCrawler::create($view_groupTable);
foreach ($definitions['groups'] as $group_key => $group) {
    $group_records = array_filter($records, function (array $item) use ($group_key): bool {
        return $item['group_key'] === $group_key;
    });
    $input = '<thead>
                <th></th>
                <th>
                    ' . Blade::renderComponent(new InputPreview(type: 'numeric', value: round(Math::records_average($group_records, 'AdequacyLevel'), 2))) . '
                </th>
                <th></th>
                <th></th>
            </thead>';
    $dom->filter('table#group_table_' . $definitions['module_key'] . '_' . $group_key . ' > thead')->append($input);
}

?>

{!! $dom->saveHTML() !!}
@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
