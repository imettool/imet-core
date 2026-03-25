<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$table_id = 'table_' . $definitions['slug'];

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        <th class="text-center">{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</th>
        <th class="text-center">@uclang('imet-core::v1_evaluation.ManagementEquipmentAdequacy.adequacy')</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    @foreach($records as $index => $record)
        <tr class="module-table-item">
            <td>
                <x-modular-forms::module.components.field.input-preview
                        :type="$definitions['fields'][0]['type']"
                        :value="$record[$definitions['fields'][0]['name']]"
                ></x-modular-forms::module.components.field.input-preview>
            </td>
            <td>
                <x-modular-forms::module.components.field.input-preview
                        type="disabled"
                        :value="$record['__adequacy_type']"
                ></x-modular-forms::module.components.field.input-preview>
            </td>
            <td>
                <x-modular-forms::module.components.field.input-preview
                        :type="$definitions['fields'][1]['type']"
                        :value="$record[$definitions['fields'][1]['name']]"
                ></x-modular-forms::module.components.field.input-preview>
            </td>
            <td>
                <x-modular-forms::module.components.field.input-preview
                        :type="$definitions['fields'][2]['type']"
                        :value="$record[$definitions['fields'][2]['name']]"
                ></x-modular-forms::module.components.field.input-preview>
            </td>
            <td>
            </td>
        <tr>
    @endforeach
    </tbody>
</table>

