<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$groups = $definitions['groups'];

?>

        <!-- Collapsible groups with histograms -->
<x-modular-forms::accordion.container :id="'accordion_'.$definitions['slug']">

    @foreach($groups as $group_key => $group_label)
        <x-modular-forms::accordion.item>
            <x-slot:title>
                @php
                    $score_value = "averages['" . $group_key . "'] || '-'";
                    $percentage_value = "averages_percentage['" . $group_key . "']";
                @endphp
                <x-imet-core::score-bar
                        :label="$group_label"
                        :score="$score_value"
                        :percentage="$percentage_value"
                ></x-imet-core::score-bar>
            </x-slot:title>

            @include('modular-forms::module.edit.type.table', [
                'definitions' => $definitions,
                'group_key' => $group_key
            ])

        </x-modular-forms::accordion.item>
    @endforeach
</x-modular-forms::accordion.container>

@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.Equipments(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
