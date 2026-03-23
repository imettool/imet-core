<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

/** @var array $records */

use ImetCore\Models\Imet\ImetOecm\Imet_Eval;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

// Get the original table view
$view_table = View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();

// Load the view into a DOM parser
$dom = HtmlPageCrawler::create('<div>' . $view_table . '</div>');


// Inject scores into  table
$dom->filter('table#table_imet__oecm__evaluation__threats_integration tr')->each(function ($tr, $index) use ($records): void {
    $score = $index > 0 ? $records[$index - 1]['__score'] : null; // -1 because of header row
    if ($score !== null) {
        $score_text =
            '<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
                <div>
                    <b>' . trans('imet-core::oecm_evaluation.ThreatsIntegration.ranking') . '</b>
                    <span>' . round((float)$score, 2) . '</span>
                </div>
            </div>';

        $tr->filter('td')->first()->each(function ($td, $_) use ($score_text): void {
            $td->append($score_text);   // -1 because of header row
        });
    }
});

?>

{!!  $dom->saveHTML() !!}
