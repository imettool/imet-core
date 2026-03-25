<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

// Get the original group table view
$view_groupTable = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Load the view into a DOM parser
$dom = HtmlPageCrawler::create('<div>' . $view_groupTable . '</div>');
foreach (['group0', 'group1'] as $group) {

    // Filter records by group
    $group_records = array_values(array_filter($records, fn(array $r): bool => $r['group_key'] == $group));

    // Inject scores into group table
    $dom->filter('table#group_table_imet__oecm__evaluation__supports_and_constraints_integration_' . $group . ' tr')->each(function ($tr, $index) use ($group_records): void {
        $score = $index > 0 ? $group_records[$index - 1]['__score'] : null; // -1 because of header row
        if ($score !== null) {
            $score_text =
                '<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
                <div>
                    <b>' . trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ranking') . '</b>
                    <span>' . round((float)$score, 2) . '</span>
                </div>
            </div>';

            $tr->filter('td')->first()->each(function ($td, $_) use ($score_text): void {
                $td->append($score_text);
            });
        }
    });

}

?>

{!!  $dom->saveHTML() !!}
