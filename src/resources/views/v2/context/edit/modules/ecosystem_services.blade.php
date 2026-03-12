<?php
/** @var Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;

$groups = $definitions['groups'];

?>

<!-- Collapsible categories with histograms -->
<x-modular-forms::accordion.container :id="'accordion_'.$definitions['module_key']">

    @foreach($module::$groupsByCategory as $cat_idx => $category)

        <!-- Category title with histogram -->
        <x-modular-forms::accordion.item>
            <x-slot:title>
                @php
                    $category_label = trans('imet-core::v2_context.EcosystemServices.categories.title'.($cat_idx+1));
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

                    @include('modular-forms::module.edit.type.table', [
                        'collection' => $collection,
                        'definitions' => $definitions,
                        'vueData' => $vueData,
                        'group_key' => $group_key
                    ])

                @endif
            @endforeach

        </x-modular-forms::accordion.item>

    @endforeach

</x-modular-forms::accordion.container>

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.EcosystemServices(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
