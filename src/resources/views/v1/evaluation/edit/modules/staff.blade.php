<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */
/** @var ?string $group_key (optional - only for GROUP_TABLE) */

$group_key = '';
$table_id = 'table_'.$definitions['module_key'];

$status_id = "'" . $definitions['module_key'] . "_'+index+'___status'";

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        <th class="text-center">{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</th>
        <th class="text-center">@uclang('imet-core::v1_evaluation.Staff.status')</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody class="{{ $group_key }}">
    <tr class="module-table-item" v-for="(item, index) in records">
        {{--  fields  --}}


        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][0],
                'vue_record_index' => 'index',
                'group_key' => $group_key
            ])
        </td>

        <td>
            <x-modular-forms::module.components.field.input
                type="disabled"
                value="records[index].__status"
                :id="$status_id"
            ></x-modular-forms::module.components.field.input>
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][1],
                'vue_record_index' => 'index',
                'group_key' => $group_key
            ])
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][2],
                'vue_record_index' => 'index',
                'group_key' => $group_key
            ])
        </td>



        <td>
            {{-- group_key_field (for GROUP_TABLE)  --}}
            @if($definitions['module_type']==='GROUP_TABLE')
                <x-modular-forms::module.components.field.input
                    type="hidden"
                    :value="'item.'.$definitions['group_key_field']"
                ></x-modular-forms::module.components.field.input>
            @endif
            {{-- record id  --}}
            <x-modular-forms::module.components.field.input
                type="hidden"
                :value="'item.'.$definitions['primary_key']"
            ></x-modular-forms::module.components.field.input>
        </td>
    <tr>
    </tbody>


</table>

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
