<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use ModularForms\View\Module\Components\Body;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$original_view = View::make('modular-forms::module.edit.type.simple', ['collection' => $collection, 'vueData' => $vueData, 'definitions' => $definitions])->render();

$dom = HtmlPageCrawler::create('<div>' . $original_view . '</div>');
$dom->filter('.module-row')->eq(0)->before('<h4>' . trans('imet-core::v2_context.Missions.fields.LocalVision') . '</h4>');
$dom->filter('.module-row')->eq(5)->before('<h4>' . trans('imet-core::v2_context.Missions.fields.InternationalVision') . '</h4>');

?>

{!! $original_view !!}

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>

