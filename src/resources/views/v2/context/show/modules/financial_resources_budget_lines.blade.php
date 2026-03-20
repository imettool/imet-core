<?php
/** @var array $definitions */
/** @var array $records */

$record  = $records[0];

$group_key = 'null';
$table_id = 'table_'.$definitions['slug'];

$area = array_key_exists('FormID', $record) ? \ImetCore\Models\Imet\v2\Modules\Context\Areas::getArea($record['FormID']) : null;
$totalBudget = array_key_exists('FormID', $record) ? \ImetCore\Models\Imet\v2\Modules\Context\FinancialResources::getTotalBudget($records[0]['FormID']) : null;


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
    <?php
        $totalSum = 0;
    ?>
    @foreach($records as $record)
        <?php
            $sumRow = $record['Amount']>0 && $area>0 ? $record['Amount'] / $area * 100 : 0;
            $percentRow = $record['Amount']>0 && $totalBudget>0 ? $record['Amount'] / $totalBudget * 100 : 0;
            $totalSum += $sumRow;
        ?>
        <tr class="module-table-item">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $field)
                <td>
                    <x-modular-forms::module.components.field.input-preview
                        :type="$field['type']"
                        :value="$record[$field['name']]"
                    ></x-modular-forms::module.components.field.input-preview>
                </td>
            @endforeach
            <td>
                <x-modular-forms::module.components.field.input-preview
                    type="numeric"
                    :value="$sumRow>0 ? $sumRow : ''"
                ></x-modular-forms::module.components.field.input-preview>
            </td>
            <td>
                <x-modular-forms::module.components.field.input-preview
                    type="numeric"
                    :value="$percentRow>0 ? $percentRow : ''"
                ></x-modular-forms::module.components.field.input-preview>
            </td>
        </tr>
        @endforeach
        <tr class="module-table-item">
            <td></td>
            <td>
                <x-modular-forms::module.components.field.input-preview
                    type="numeric"
                    :value="999"
                ></x-modular-forms::module.components.field.input-preview>
            </td>
            <td colspan="4">
            </td>
        </tr>
    </tbody>

</table>


@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
