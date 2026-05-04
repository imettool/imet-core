<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$group_key = '';

$table_id = 'table_' . $definitions['slug'];

$theme_id = "'" . $definitions['slug'] . "_'+index+'_Theme'";
$staff_number_adequacy_id = "'" . $definitions['slug'] . "_'+index+'_StaffNumberAdequacy'";

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
    <tbody class="{{ $group_key }}" v-if="hasRecordsToEvaluate('{{ $definitions['fields'][0]['name'] }}')">

    <tr class="module-table-item" v-for="(item, index) in records">

        {{--  fields  --}}
        <td>
            <x-imet-core::custom-input
                type="disabled"
                value="records[index].Theme"
                :id="$theme_id"
            ></x-imet-core::custom-input>
        </td>

        <td>
            <x-imet-core::custom-input
                type="disabled"
                value="records[index].StaffNumberAdequacy"
                :id="$staff_number_adequacy_id"
            ></x-imet-core::custom-input>
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][2],
                'vue_record_index' => 'index',
                'group_key' => $group_key,
                'vue_directives' => 'v-if="records[index].StaffNumberAdequacy!==null"'
            ])
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][3],
                'vue_record_index' => 'index',
                'group_key' => $group_key
            ])
        </td>


        <td>
            {{-- group_key_field (for GROUP_TABLE)  --}}
            @if($definitions['module_type']==='GROUP_TABLE')
                <x-imet-core::custom-input
                    type="hidden"
                    :value="'item.'.$definitions['group_key_field']"
                ></x-imet-core::custom-input>
            @endif
            {{-- record id  --}}
            <x-imet-core::custom-input
                type="hidden"
                :value="'item.'.$definitions['primary_key']"
            ></x-imet-core::custom-input>
        </td>
    <tr>
    </tbody>

    @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 4])

</table>

<x-modular-forms::module.components.script
    :module="$module"
    :controller="$controller"
    :mode="$mode"
></x-modular-forms::module.components.script>
