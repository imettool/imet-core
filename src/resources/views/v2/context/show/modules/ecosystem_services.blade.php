<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Context\EcosystemServices;

$groups = $definitions['groups'];

$categoryStats = array_key_exists('FormID', $records[0])
    ? EcosystemServices::getStats($records[0]['FormID'])
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
                        $category_label = ($cat_idx+1).'. '.trans('imet-core::v2_context.MenacesPressions.categories.title'.($cat_idx+1));
                        $score_value = round($categoryStats[$cat_idx], 2);
                        $percentage_value = $score_value;
                    @endphp
                    <x-imet-core::score-bar
                            :label="$category_label"
                            :score="$score_value"
                            :percentage="$percentage_value"
                    ></x-imet-core::score-bar>
                </div>
            </div>

            <div class="accordion-item-body">
                <div class="accordion-item-body-content">

                    @foreach($groups as $group_key => $group_label)
                        @if(in_array($group_key, $category))

                            <h5 class="highlight group_title_{{ $definitions['slug'] }}_{{ $group_key }}">{{ $group_label }}</h5>

                            @include('modular-forms::module.show.type.table', [
                                'definitions' => $definitions,
                                'records' => $records,
                                'group_key' => $group_key
                            ])
                            <br/>
                            <br/>

                        @endif
                    @endforeach

                </div>
            </div>

        </div>

    @endforeach

</div>
