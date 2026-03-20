<?php
/** @var Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$original_definitions = $definitions;

// First group: "Existence" hidden
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
$definitions['fields'][1]['type'] = 'hidden';
$first_group = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Second groups: fixed rows
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'][0]['type'] = 'disabled';
$definitions['fields'][1]['type'] = $original_definitions['fields'][1]['type'];
$definitions['fixed_rows'] = true;
$second_group = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');

?>

{!! $dom->saveHTML() !!}

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
