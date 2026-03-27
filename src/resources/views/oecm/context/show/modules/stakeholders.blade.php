<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use Illuminate\Support\Facades\View;
use ModularForms\View\Module\Components\Body;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$page = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

$dom = HtmlPageCrawler::create('<div>' . $page . '</div>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group0')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title0') . '</h3>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group5')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title1') . '</h3>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group7')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title2') . '</h3>');
$dom->filter('h5.group_title_' . $definitions['slug'] . '_group9')->before('<h3 style="margin-bottom: 20px;">' . trans('imet-core::oecm_context.Stakeholders.titles.title3') . '</h3>');

?>

{!! $dom->saveHTML() !!}
