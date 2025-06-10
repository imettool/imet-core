<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;


$original_view = View::make('modular-forms::module.edit.body', compact(['collection', 'vueData', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$original_view.'</div>');
$dom->filter('.module-row')->eq(0)->before('<h4>'.trans('imet-core::v2_context.Missions.fields.LocalVision').'</h4>');
$dom->filter('.module-row')->eq(5)->before('<h4>'.trans('imet-core::v2_context.Missions.fields.InternationalVision').'</h4>');

?>

{!! $dom->saveHTML() !!}

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
