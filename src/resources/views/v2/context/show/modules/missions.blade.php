<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Imet;

use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;


$original_view = View::make('modular-forms::module.show.simple', ['definitions' => $definitions, 'records' => $records])->render();

$dom = HtmlPageCrawler::create('<div>'.$original_view.'</div>');
$dom->filter('.module-row')->eq(0)->before('<h4>'.trans('imet-core::v2_context.Missions.fields.LocalVision').'</h4>');
$dom->filter('.module-row')->eq(5)->before('<h4>'.trans('imet-core::v2_context.Missions.fields.InternationalVision').'</h4>');

?>

{!! $dom->saveHTML() !!}
