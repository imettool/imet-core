<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\oecm\Imet_Eval;
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;



$original_definitions = $definitions;

// First group: "Existence" hidden
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
unset($definitions['fields'][1]);
$first_group = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Second groups: standard
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'] = $original_definitions['fields'];
$second_group = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');

?>

{!! $dom->saveHTML() !!}
