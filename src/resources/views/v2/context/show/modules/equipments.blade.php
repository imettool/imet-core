<?php
/** @var Collection $collection */
/** @var array $records */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use ImetCore\Helpers\Math;
use ImetCore\View\ScoreBar;
use ModularForms\View\Module\Components\Field\InputPreview;
use Wa72\HtmlPageDom\HtmlPageCrawler;


$view_groupTable = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

$dom = HtmlPageCrawler::create('<div class="accordion">' . $view_groupTable . '</div>');
foreach ($definitions['groups'] as $group_key => $group) {

    // Remove original group title
    $dom->filter('div > h5.group_title_' . $definitions['module_key'] . '_' . $group_key)
        ->remove();

    // Setup accordion header and progress bar
    $group_records = array_filter($records, fn(array $item): bool => $item['group_key'] === $group_key);
    $group_score = round(Math::records_average($group_records, 'AdequacyLevel'), 2);
    $header =
        '<div class="accordion-item-header">
            <div class="accordion-item-header-title">
                ' . Blade::renderComponent(new ScoreBar(
                        label: $definitions['groups'][$group_key],
                        score: $group_score,
                        percentage: $group_score/3*100
                    )) . '
            </div>
        </div>';

    $dom->filter('table#group_table_' . $definitions['module_key'] . '_' . $group_key)
        ->prepend($header)
        ->wrap('<div class="accordion-item show" id="group_accordion_' . $definitions['module_key'] . '_' . $group_key . '"></div>')
        ->wrap('<div class="accordion-item-body"></div>')
        ->wrap('<div class="accordion-item-body-content"></div>');

}

?>
{!! $dom->saveHTML() !!}

@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
