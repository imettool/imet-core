<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;
use ImetCore\Models\Imet\ImetV2\Modules;
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
    :module="$module"
    :controller="$controller"
    :mode="$mode"
></x-modular-forms::module.components.script>
