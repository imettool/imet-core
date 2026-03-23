<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Models\Imet\ImetV2\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$groups = $definitions['groups'];
$module->vueData['marine_predefined'] = MenacesPressions::get_marine_predefined();

$marine_groups = MenacesPressions::get_marine_groups();
$terrestrial_groups = MenacesPressions::get_terrestrial_groups();

?>

        <!-- Collapsible categories with histograms -->
<x-modular-forms::accordion.container :id="'accordion_'.$definitions['slug']">

    @foreach($module::$groupsByCategory as $cat_idx => $category)

        <!-- Category title with histogram -->
        <x-modular-forms::accordion.item>
            <x-slot:title>
                @php
                    $category_label = trans('imet-core::v2_context.MenacesPressions.categories.title'.($cat_idx+1));
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

                    <h5>
                        @if(in_array($group_key, $marine_groups))
                            {!! Template::module_scope($module::MARINE) !!}
                        @elseif(in_array($group_key, $terrestrial_groups))
                            {!! Template::module_scope($module::TERRESTRIAL) !!}
                        @else
                            {!! Template::module_scope($module::MARINE) !!}
                            {!! Template::module_scope($module::TERRESTRIAL) !!}
                        @endif
                        &nbsp;&nbsp;{{ $group_label }}
                    </h5>

                    @php
                        $view = View::make('modular-forms::module.edit.type.table', [
                            'definitions' => $definitions,
                            'group_key' => $group_key
                        ])->render();
                        $view = $module::injectIconToPredefinedCriteriaWithVue($module::MARINE, $view, "is_marine(item['Value'])");
                    @endphp
                    {!! $view !!}

                @endif
            @endforeach

        </x-modular-forms::accordion.item>

    @endforeach

</x-modular-forms::accordion.container>


@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.MenacesPressions(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush

