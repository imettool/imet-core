<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$group_key ??= '';
$table_id = 'table_' . $definitions['slug'];

$module->vueData['area'] = \ImetCore\Models\Imet\ImetV2\Modules\Context\Areas::getArea($module->vueData['form_id']);
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
            @uclang('imet-core::v2_context.FinancialResourcesBudgetLines.fields.function_costs')
        </th>
        <th class="text-center">
            @uclang('imet-core::v2_context.FinancialResourcesBudgetLines.fields.percentage')
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
                   v-bind:value="costs[index]"
                   v-bind:id="'{{$definitions['slug'] }}_'+index+'_total'"
            /></td>
        <td>
            <input type="text" disabled="disabled" style="width: 80px;"
                   class="field-edit text-center"
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
                <x-modular-forms::module.components.buttons.delete-item/>
            </span>
        </td>
    <tr class="module-table-item">
        <td></td>
        <td>
            <div :class="!totalIsValid ? 'form-group has-error' : 'form-group'">
                <input type="text" disabled="disabled"
                       class="field-edit field-numeric text-center"
                       v-bind:value="sumBudget"
                />
            </div>
        </td>
        <td colspan="4">
            <div v-if="!totalIsValid" class="text-contextual-danger text-left" style="font-size: 0.9em;">
                <i class="fa fa-exclamation-triangle"></i>
                {!!  ucfirst(trans('imet-core::v2_context.FinancialResourcesBudgetLines.sum_error')) !!}
            </div>
        </td>
    </tr>
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">
            <x-modular-forms::module.components.buttons.add-item :group-key="$group_key"/>
        </td>
    </tr>
    </tfoot>

</table>


@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.FinancialResourcesBudgetLines(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
