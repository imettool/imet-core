<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;
use ImetCore\Models\Imet\Imet;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\Species;
use ImetCore\Services\Scores\ImetScores;

$form_id = $module->vueData['form_id'];
$key_elements = [
    'key_species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)
        ->filter(fn($item): mixed => $item['IncludeInStatistics'])
        ->pluck('Aspect')
        ->map(fn($item) => Str::contains('|', $item) ? Species::getByTaxonomy($item)->binomial : $item)
        ->toArray(),
    'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)
        ->filter(fn($item): mixed => $item['IncludeInStatistics'])
        ->pluck('Aspect')
        ->toArray(),
    'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)
        ->filter(fn($item): mixed => $item['IncludeInStatistics'])
        ->pluck('Aspect')
        ->toArray(),
    'ecosystem_services' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)
        ->filter(fn($item): mixed => $item['IncludeInStatistics'])
        ->pluck('Aspect')
        ->toArray(),
    'threats' => Modules\Evaluation\Menaces::getModule($form_id)
        ->filter(fn($item): mixed => $item['IncludeInStatistics'])
        ->pluck('Aspect')
        ->toArray(),
];

?>

@foreach($definitions['fields'] as $field)

    <h5>{{ ucfirst($field['label']) }}</h5>
    <div class="module-row">
        <ul class="ml-6 w-md text-sm">
            @foreach ($key_elements[$field['name']] as $elem)
                <li>{!! Species::isTaxonomy($elem) ? Species::getPreview($elem, true) : $elem !!}</li>
            @endforeach
        </ul>
        <div class="module-row__input">
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => 0
            ])
        </div>
    </div>

@endforeach

@include('imet-core::v2.report.components.table_evaluation', [
   'scores' => ImetScores::get_all($form_id),
   'labels' => ImetScores::indicators_labels(Imet::IMET_V2),
])


<x-modular-forms::module.components.script
        :module="$module"
        :definitions="$definitions"
        :mode="$mode"
></x-modular-forms::module.components.script>
