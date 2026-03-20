<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v1\Imet;
$group_key ??= '';
$table_id = 'table_'.$definitions['slug'];

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $field)
            @if($field['type']!=='hidden')
                <th class="text-center">
                    {{ ucfirst($field['label'] ?? '') }}
                </th>
            @endif
        @endforeach
        <th class="text-center">
            @uclang('imet-core::v1_context.FinancialAvailableResources.fields.total')
        </th>
        <th class="text-center">
            @uclang('imet-core::v1_context.FinancialAvailableResources.fields.percentage')
        </th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    <tr class="module-table-item" v-for="(item, index) in records">
        {{--  fields  --}}
        @foreach($definitions['fields'] as $field)
            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $field,
                    'vue_record_index' => 'index',
                    'group_key' => $group_key
                ])
            </td>
        @endforeach
        <td>
            <input type="numeric" disabled="disabled"
                   class="field-edit field-numeric text-right"
                   v-bind:value="totals[index]"
                   v-bind:id="'{{$definitions['slug'] }}_'+index+'_total'"
            />        </td>
        <td>
            <input type="text" disabled="disabled" style="width: 80px;"
                   class="field-edit field-numeric text-center"
                   v-bind:value="percentages[index]"
                   v-bind:id="'{{$definitions['slug'] }}_'+index+'_percentage'"
            />
        </td>
        <td>
            {{-- record id  --}}
            <x-modular-forms::module.components.field.input
                type="hidden"
                :value="'item.'.$definitions['primary_key']"
            ></x-modular-forms::module.components.field.input>
            <span v-if="typeof item.__predefined === 'undefined'">
                <x-modular-forms::module.components.buttons.delete-item />
            </span>
        </td>
    <tr>
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">
            <x-modular-forms::module.components.buttons.add-item :group-key="$group_key" />
        </td>
    </tr>
    </tfoot>

</table>


@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        window.imet__v1__context__financial_available_resources = (new window.ImetCore.Apps.Modules.ImetV1.context.FinancialAvailableResources(@json($vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
