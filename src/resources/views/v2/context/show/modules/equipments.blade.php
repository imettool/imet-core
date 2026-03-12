<?php
/** @var Collection $collection */
/** @var array $records */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use ImetCore\Helpers\Math;
use ImetCore\View\ScoreBar;
use ModularForms\View\Module\Components\Field\InputPreview;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$groups = $definitions['groups'];

?>

<div class="accordion">

    @foreach($groups as $group_key => $group_label)

        <div class="accordion-item show">

            <div class="accordion-item-header">
                <div class="accordion-item-header-title">
                    @php
                        $group_records = array_filter($records, fn(array $item): bool => $item['group_key'] === $group_key);
                        $group_score = round(Math::records_average($group_records, 'AdequacyLevel'), 2);
                    @endphp
                    <x-imet-core::score-bar
                        :label="$group_label"
                        :score="$group_score"
                        :percentage="$group_score/3*100"
                    ></x-imet-core::score-bar>
                </div>
            </div>

            <div class="accordion-item-body">
                <div class="accordion-item-body-content">
                    @include('modular-forms::module.show.type.table', [
                       'definitions' => $definitions,
                       'records' => $records,
                       'group_key' => $group_key
                   ])
                </div>
            </div>

        </div>
        <br />

    @endforeach

</div>


@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
