<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$original_definitions = $definitions;

// First group: nothing to change
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
$first_group = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Second groups: fixed rows
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'][2]['type'] = 'rating-0to3WithNA';
$second_group = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

$dom = HtmlPageCrawler::create('<div>' . $first_group . $second_group . '</div>');

?>

{!! $dom->saveHTML() !!}

<x-modular-forms::module.components.script
    :module="$module"
    :controller="$controller"
    :mode="$mode"
></x-modular-forms::module.components.script>
