<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\oecm\Imet;
use Illuminate\Support\Facades\View;
use ModularForms\View\Module\Components\Body;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$original_view = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

$dom = HtmlPageCrawler::create('<div>' . $original_view . '</div>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group0')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title0') . '</h3>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group5')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title1') . '</h3>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group7')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title2') . '</h3>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group9')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title3') . '</h3>');

?>

{!! $dom->saveHTML() !!}

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
