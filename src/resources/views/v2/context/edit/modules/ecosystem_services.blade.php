<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Context\EcosystemServices;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$groups = $definitions['groups'];
$module->vueData['spillover_predefined'] = EcosystemServices::get_spillover_predefined();
$module->vueData['connectivity_predefined'] = EcosystemServices::get_connectivity_predefined();

function injectSpilloverMessages(string $view, string $label, string $vue_if): string
{
    $message =
        '<div class="text-xs mt-1 text-blue-600" v-if=' . $vue_if . '>
            <i class="fa fa-exclamation-triangle" style="font-size: 1.2em; margin-right: 10px;"></i>
            <span>' . $label . '</span>
        </div>';
    $dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
    $td = $dom->filter('tr.module-table-item td')->eq(0);
    $td->setInnerHtml($td->getInnerHtml() . $message);
    return $dom->saveHTML();
}

?>

        <!-- Collapsible categories with histograms -->
<x-modular-forms::accordion.container :id="'accordion_'.$definitions['slug']">

    @foreach($module::$groupsByCategory as $cat_idx => $category)

        <!-- Category title with histogram -->
        <x-modular-forms::accordion.item>
            <x-slot:title>
                @php
                    $category_label = ($cat_idx+1).'. '.trans('imet-core::v2_context.EcosystemServices.categories.title'.($cat_idx+1));
                    $score_value = "categoryStats['".$cat_idx."'] || '-'";
                    $percentage_value = "categoryStats['" . $cat_idx . "']";
                @endphp
                <x-imet-core::score-bar
                        :label="$category_label"
                        :score="$score_value"
                        :percentage="$percentage_value"
                ></x-imet-core::score-bar>
            </x-slot:title>

            @foreach($groups as $group_key => $group_label)
                @if(in_array($group_key, $category))

                    <h5>{{ $group_label }}</h5>

                    @php
                        $view = View::make('modular-forms::module.edit.type.table', [
                            'definitions' => $definitions,
                            'group_key' => $group_key
                        ])->render();
                        $view = injectSpilloverMessages($view, trans('imet-core::v2_context.spillover_waring_message'), 'is_spillover(records[index].Element)');
                        $view = injectSpilloverMessages($view, trans('imet-core::v2_context.connectivity_waring_message'), 'is_connectivity(records[index].Element)');
                    @endphp
                    {!! $view !!}

                @endif
            @endforeach

        </x-modular-forms::accordion.item>

    @endforeach

</x-modular-forms::accordion.container>

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.EcosystemServices(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
