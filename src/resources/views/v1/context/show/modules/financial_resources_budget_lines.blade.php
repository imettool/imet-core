<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

$record = $records[0];

$group_key ??= '';

$table_id = 'table_'.$definitions['slug'];

$area = \ImetCore\Models\Imet\v1\Modules\Context\Areas::getArea($record['FormID']);
$totals = \ImetCore\Controllers\Imet\v1\ContextController::get_financial_available_resources_totals();
$totalBudget = array_reduce($totals, fn($carry, $item): float|int|array => $carry + $item);

$cost = [];
$percentage = [];

foreach ($records as $index => $record) {

    $cost[$index] = 0;
    if($area !== null){
        $cost[$index] = $record['Amount'] / $area * 100;
    }
    $cost[$index] = $cost[$index] === 0 ? null : round($cost[$index], 2);

    $val = floatval($cost[$index]);
    $percentage[$index] = $val > 0 && $totalBudget > 0 ? round($val / $totalBudget * 100, 1).' %' : "";
}

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
            @uclang('imet-core::v1_context.FinancialResourcesBudgetLines.fields.function_costs')
        </th>
        <th class="text-center">
            @uclang('imet-core::v1_context.FinancialResourcesBudgetLines.fields.percentage')
        </th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    @foreach($records as $index => $record)
        <tr class="module-table-item">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $f_index => $field)
                <td>
                    <x-modular-forms::module.components.field.input-preview
                        :type="$definitions['fields'][$f_index]['type']"
                        :value="$record[$definitions['fields'][$f_index]['name']]"
                    ></x-modular-forms::module.components.field.input-preview>
                </td>
            @endforeach
            <td>
                <input type="numeric" disabled="disabled"
                       class="field-edit field-numeric text-right"
                       value="{{$cost[$index]}}"

                />
            </td>
            <td>
                <input type="text" disabled="disabled" style="width: 80px;"
                       class="field-edit text-center"
                       value="{{$percentage[$index]}}"
                />
            </td>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">

        </td>
    </tr>
    </tfoot>

</table>


@include('modular-forms::module.show.type.commons', compact(['collection','records', 'definitions']))
