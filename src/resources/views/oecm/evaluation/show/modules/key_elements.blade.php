<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\oecm\Imet_Eval;

use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

function appendScoresToFirstTd($tr, $group, ?string $group_stakeholders, string $num_stakeholders_direct, string $num_stakeholders_indirect, ?string $score): void
{
    $score_text = '';
    if($group_stakeholders !== null) {
        $score_text .=
            '<div>
                ' . trans('imet-core::oecm_evaluation.KeyElements.from_group') . '
                <b>' . $group_stakeholders . '</b>
            </div>';
    }
    if ($group === 'group0') {
        $score_text .=
            '<div>
                    ' . trans( 'imet-core::oecm_evaluation.KeyElements.num_stakeholders',
                [
                    'num_dir' => '<b>' . $num_stakeholders_direct . '</b>',
                    'num_ind' => '<b>' . $num_stakeholders_indirect . '</b>'
                ]). '
                </div>';
    } elseif ($group === 'group1' && $score !== null) {
        $score_text .=
            '<div>
                <b>' . trans('imet-core::oecm_evaluation.KeyElements.ranking') . '</b>: ' . $score . '
            </div>';
    }

    $tr->filter('td')->first()->each(function ($td, $_) use($score_text): void {
        $td->append('<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
            ' . $score_text .
            '</div>');
    });
}

$original_definitions = $definitions;

// First group: nothing to change
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
$first_group = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Second groups: hidden importance rows
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'][1]['type'] = 'hidden';
$second_group = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Load the view into a DOM parser
$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');
foreach (['group0', 'group1'] as $group) {

    // Filter records by group
    $group_records = array_values(array_filter($records, fn(array $r): bool => $r['group_key'] == $group));

    // Inject scores into group table
    $dom->filter('table#group_table_imet__oecm__evaluation__key_elements_' . $group . ' tr')->each(function ($tr, $index) use ($group, $group_records): void {
        if($index>0){
            $group_stakeholders = $group_records[$index - 1]['__group_stakeholders'];   // -1 because of header row
            $num_stakeholders_direct = $group_records[$index - 1]['__num_stakeholders_direct'];
            $num_stakeholders_indirect = $group_records[$index - 1]['__num_stakeholders_indirect'];
            $score = $group_records[$index - 1]['__score'];
            appendScoresToFirstTd($tr, $group, $group_stakeholders, $num_stakeholders_direct, $num_stakeholders_indirect, $score);
        }
    });

}

?>

{!! $dom->saveHTML() !!}
