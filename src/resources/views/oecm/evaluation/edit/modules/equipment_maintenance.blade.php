<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Models\Imet\ImetOecm\Imet_Eval;

$table_id = 'table_' . $definitions['slug'];

$equipment_id = "'" . $definitions['slug'] . "_'+index+'_Equipment'";
$adequacy_level_id = "'" . $definitions['slug'] . "_'+index+'_AdequacyLevel'";

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        <th class="text-center">{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][3]['label'] ?? '') }}</th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    <tr class="module-table-item" v-for="(item, index) in records">

        <td>
            <x-modular-forms::module.components.field.input
                type="hidden"
                value="records[index].Equipment"
                :id="$equipment_id"
            ></x-modular-forms::module.components.field.input>
            <x-modular-forms::module.components.field.input
                type="disabled"
                value="records[index].__predefined_label"
                class="field-disabled"
            ></x-modular-forms::module.components.field.input>
        </td>

        <td>
            <x-modular-forms::module.components.field.input
                type="disabled"
                value="records[index].AdequacyLevel"
                :id="$adequacy_level_id"
                class="text-center"
            ></x-modular-forms::module.components.field.input>
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][2],
                'vue_record_index' => 'index'
            ])
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][3],
                'vue_record_index' => 'index'
            ])
        </td>


        <td>
            {{-- record id  --}}
            <x-modular-forms::module.components.field.input
                type="hidden"
                :value="'item.'.$definitions['primary_key']"
            ></x-modular-forms::module.components.field.input>
            @if(!$definitions['fixed_rows'])
                <span v-if="typeof item.__predefined === 'undefined'">
                       <x-modular-forms::module.components.buttons.delete-item/>
                    </span>
            @endif
        </td>
    </tr>
    </tbody>

</table>

<x-modular-forms::module.components.script
    :module="$module"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
