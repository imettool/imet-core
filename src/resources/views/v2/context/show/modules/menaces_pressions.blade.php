<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\v2\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;
use Wa72\HtmlPageDom\Helpers;


$groups = $definitions['groups'];

$marine_groups = MenacesPressions::get_marine_groups();
$terrestrial_groups = MenacesPressions::get_terrestrial_groups();

$categoryStats = array_key_exists('FormID', $records[0])
    ? MenacesPressions::getStats($records[0]['FormID']) ['categoryStats']
    : null;

?>

<!-- Categories with histograms -->
<div class="accordion">

    @foreach($module::$groupsByCategory as $cat_idx => $category)

        <!-- Category title with histogram -->
        <div class="accordion-item show">

            <div class="accordion-item-header">
                <div class="accordion-item-header-title">
                    @php
                        $group_label = trans('imet-core::v2_context.MenacesPressions.categories.title'.($cat_idx+1));
                        $score_value = $categoryStats[$cat_idx];
                        $percentage_value = $score_value;
                    @endphp
                    <x-imet-core::score-bar
                        :label="$group_label"
                        :score="$score_value"
                        :percentage="$percentage_value"
                    ></x-imet-core::score-bar>
                </div>
            </div>

            <div class="accordion-item-body">
                <div class="accordion-item-body-content">

                    @foreach($groups as $group_key => $group_label)
                        @if(in_array($group_key, $category))

                            <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

                            @include('modular-forms::module.show.type.table', [
                                'definitions' => $definitions,
                                'records' => $records,
                                'group_key' => $group_key
                            ])
                            <br />
                            <br />

                        @endif
                    @endforeach

                </div>
            </div>

        </div>

    @endforeach

</div>
