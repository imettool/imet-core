<?php
/** @var Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\Species;

?>

<div class="module-row mt-2">
    <div class="module-row__input">
        @include('modular-forms::module.edit.field.module-to-vue', [
            'definitions' => $definitions,
            'field' => $definitions['fields'][0],
            'vue_record_index' => 0
        ])
    </div>
</div>

<h5>@lang('imet-core::v2_report.ManagementEffectivenessAnalysis.characteristics_elements')</h5>
<div class="swot">
    @foreach($definitions['fields'] as $field)

        @if($field['name'] !== 'analysis')

            @component('modular-forms::module.components.field_container', [
                    'name' => $field['name'],
                    'label' => $field['label'] ?? '',
                    'label_width' => $definitions['label_width']
                ])

                {{-- input field --}}
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $field,
                    'vue_record_index' => 0
                ])

            @endcomponent

        @endif

    @endforeach
</div>



<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
