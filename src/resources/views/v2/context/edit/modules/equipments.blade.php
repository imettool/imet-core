<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

$groups = $definitions['groups'];

?>

        <!-- histogram -->
<div class="mb-4">
    @foreach($groups as $group_key => $group_label)
        @php
            $k = isset($k) ? $k + 1 : 1;
        @endphp
        <div class="histogram-row">
            <div class="histogram-row__code text-center"><b>{{ ($k) }}</b></div>
            <div class="histogram-row__title text-left">{{ $group_label }}</div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                <b v-html="averages['{{ $group_key }}'] || '-'"></b>
            </div>
            <div class="histogram-row__progress-bar">
                <imet_score_bar
                        :value=averages_percentage['{{ $group_key }}']
                        color="#87c89b"
                ></imet_score_bar>
            </div>
        </div>
    @endforeach
</div>


<!-- Collapsible groups -->
<x-modular-forms::accordion.container :id="'accordion_'.$definitions['module_key']">

    @foreach($groups as $group_key => $group_label)
        @php
            $i = isset($i) ? $i + 1 : 1;
        @endphp
        <x-modular-forms::accordion.item>
            <x-slot:title>
                {{ $i }}.  {{ $group_label }}
            </x-slot:title>

            @include('modular-forms::module.edit.type.table', [
                'collection' => $collection,
                'definitions' => $definitions,
                'vueData' => $vueData,
                'group_key' => $group_key
            ])

        </x-modular-forms::accordion.item>
    @endforeach
</x-modular-forms::accordion.container>

@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.Equipments(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
