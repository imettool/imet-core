<?php
/** @var Collection $collection */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\v2\Modules\Context\MenacesPressions;
use Illuminate\Database\Eloquent\Collection;

$groups = $definitions['groups'];

$marine_groups = MenacesPressions::get_marine_groups();
$terrestrial_groups = MenacesPressions::get_terrestrial_groups();
$marine_predefined = MenacesPressions::get_marine_predefined();

$categoryStats = array_key_exists('FormID', $records[0])
    ? MenacesPressions::getStats($records[0]['FormID'])['categoryStats']
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
                        $category_label = trans('imet-core::v2_context.MenacesPressions.categories.title'.($cat_idx+1));
                        $score_value = $categoryStats[$cat_idx];
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
                                $view = View::make('modular-forms::module.show.type.table', [
                                    'definitions' => $definitions,
                                    'records' => $records,
                                    'group_key' => $group_key
                                ])->render();
                                $view = $module::injectIconToPredefinedCriteria($module::MARINE, $view, $marine_predefined);
                            @endphp
                            {!! $view !!}

                            <br />
                            <br />

                        @endif
                    @endforeach

                </div>
            </div>

        </div>

    @endforeach

</div>
