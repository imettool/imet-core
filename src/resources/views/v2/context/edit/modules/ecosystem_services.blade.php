<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

use Wa72\HtmlPageDom\HtmlPageCrawler;

$view = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', ['collection' => $collection, 'vueData' => $vueData, 'definitions' => $definitions])->render();
$dom = HtmlPageCrawler::create('<div>'.$view.'</div>');

// Add title and progress bar for each category
$firstGroupPerEachCategory = array_map(fn(array $category) => $category[0], $vueData['groupsByCategory']);
foreach ($firstGroupPerEachCategory as $i => $group){
    $title = '<div class="module-row">
                <div style="width: 60%;">
                    <h3>'.($i+1).'. '.trans('imet-core::v2_context.EcosystemServices.categories.title'.($i+1)).'</h3>
                </div>
                <div class="module-row__input">
                    <div class="progress_bar" style="margin-top: 25px">
                        <imet_score_bar
                            :value=categoryStat(\''.$i.'\')
                            color="#87c89b"
                        ></imet_score_bar>
                    </div>
                </div>
            </div>';
    $dom->filter('h5.group_title_'.$definitions['module_key'].'_'.$group)->eq(0)->before($title);
}

// Add info message for spillover - Provisioning
$info = '<div class="module-bar info-bar !mb-5">' .
            '<i class="fa fa-exclamation-triangle" style="font-size: 1.4em; margin-right: 10px;"></i>' .
            trans('imet-core::v2_context.spillover_waring_message') . ': ' .
            ' "<b>'. last(trans('imet-core::v2_context.EcosystemServices.predefined_values.group0')) . '</b>" ' .
        '</div>';
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->eq(0)->after($info);

// Add info message for spillover - Supporting
$info = '<div class="module-bar info-bar !mb-5">' .
    '<i class="fa fa-exclamation-triangle" style="font-size: 1.4em; margin-right: 10px;"></i>' .
    '<span>' .
        trans('imet-core::v2_context.spillover_and_connectivity_waring_message') . ': ' .
        ' "<b>'. trans('imet-core::v2_context.EcosystemServices.predefined_values.group9')[count(trans('imet-core::v2_context.EcosystemServices.predefined_values.group9'))-2] . '</b>"  and ' .
        ' "<b>'. last(trans('imet-core::v2_context.EcosystemServices.predefined_values.group9')) . '</b>"' .
    '</span>' .
    '</div>';
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group9')->eq(0)->after($info);

?>

{!! $dom->saveHTML() !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.EcosystemServices(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
