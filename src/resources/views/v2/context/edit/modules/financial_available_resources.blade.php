<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$group_key ??= '';
$table_id = 'table_' . $definitions['slug'];

?>

<table class="table module-table {{ $table_id }}">

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
                @uclang('imet-core::v2_context.FinancialAvailableResources.fields.total')
            </th>
        </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
        <tr class="module-table-item" v-for="(item, index) in records.slice(0,1)">

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

                {{-- Total annual budget --}}
                <input type="numeric" disabled="disabled"
                       class="field-edit field-numeric text-right"
                       :class="!annualTotalBudgetIsValid ? 'has-error' : ''"
                       v-bind:value="line_totals[index]"
                       v-bind:id="'{{$definitions['slug'] }}_'+index+'_total'"
                />

                {{-- record id  --}}
                <x-imet-core::custom-input
                    type="hidden"
                    :value="'item.'.$definitions['primary_key']"
                ></x-imet-core::custom-input>
                <span v-if="typeof item.__predefined === 'undefined'">
                    <x-modular-forms::module.components.buttons.delete-item/>
                </span>

            </td>

        </tr>
    </tbody>

    {{-- not valid total budget (error message)  --}}
    <tfoot>
        <tr>
            <td colspan="6" class="text-left">
                <div v-if="!annualTotalBudgetIsValid" class="text-contextual-danger text-right mr-4" style="font-size: 0.9em;">
                    <i class="fa fa-exclamation-triangle"></i>
                    {!!  ucfirst(trans('imet-core::v2_context.FinancialAvailableResources.sum_error')) !!}
                </div>
            </td>
        </tr>
    </tfoot>

</table>


<table class="table module-table {{ $table_id }}">

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
                @uclang('imet-core::v2_context.FinancialAvailableResources.fields.total')
            </th>
        </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
        <tr class="module-table-item" v-for="(item, index) in records">

            <template v-if="index>0">

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
                    {{-- budget line total --}}
                    <input type="numeric" disabled="disabled"
                           class="field-edit field-numeric text-right"
                           v-bind:value="line_totals[index]"
                           v-bind:id="'{{$definitions['slug'] }}_'+index+'_total'"
                    />

                    {{-- record id  --}}
                    <x-imet-core::custom-input
                            type="hidden"
                            :value="'item.'.$definitions['primary_key']"
                    ></x-imet-core::custom-input>
                    <span v-if="typeof item.__predefined === 'undefined'">
                        <x-modular-forms::module.components.buttons.delete-item/>
                    </span>
                </td>

            </template>

        <tr>

        <tr class="module-table-totals">
            <td></td>
            <td>
                {{-- column 1 total (NationalBudget) --}}
                <input type="text" disabled="disabled"
                       class="field-edit field-numeric text-center"
                       :class="!nationalBudgetIsValid ? 'has-error' : ''"
                       v-bind:value="column_totals[0]"
                />
            </td>
            <td>
                {{-- column 2 total (OwnRevenues) --}}
                <input type="text" disabled="disabled"
                       class="field-edit field-numeric text-center"
                       :class="!ownRevenuesIsValid ? 'has-error' : ''"
                       v-bind:value="column_totals[1]"
                />
            </td>
            <td>
                {{-- column 3 total (Disputes) --}}
                <input type="text" disabled="disabled"
                       class="field-edit field-numeric text-center"
                       :class="!disputesIsValid ? 'has-error' : ''"
                       v-bind:value="column_totals[2]"
                />
            </td>
            <td>
                {{-- column 4 total (Partners) --}}
                <input type="text" disabled="disabled"
                       class="field-edit field-numeric text-center"
                       :class="!partnersIsValid ? 'has-error' : ''"
                       v-bind:value="column_totals[3]"
                />
            </td>
            <td>
                {{-- line total --}}
                <input type="text" disabled="disabled"
                       class="field-edit field-numeric text-center"
                       :class="!totalIsValid ? 'has-error' : ''"
                       v-bind:value="sumTotals"
                />
            </td>
        </tr>


    </tbody>

</table>


@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.FinancialAvailableResources(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>

    <style>
        table{{ '.'. $table_id }}{

            &:nth-of-type(1){
                margin-bottom: 40px !important;
            }

            table-layout: fixed;
            width: 100%;

            .module-table-totals{
                text-align: center;
                vertical-align: top;
                padding: 6px 2px;
                td{
                    padding-top: 10px;
                    padding-bottom: 10px;
                }
            }

        }


    </style>

@endpush
