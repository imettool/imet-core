<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

use ModularForms\Enums\ModuleViewModes;

$group_key = '';
$table_id = 'table_' . $definitions['slug'];


?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $f_index=>$field)
            <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
        @endforeach
    </tr>
    </thead>

    {{-- inputs --}}
    @if(count($records)===0)
        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 4, 'mode' => ModuleViewModes::SHOW])
    @else
        <tbody class="{{ $group_key }}">
        @foreach($records as $record)
            <tr class="module-table-item">
                @foreach($definitions['fields'] as $f_index=>$field)
                    <td>
                        @if($record['StaffNumberAdequacy']!==null || $field['name']==='Theme' || $field['name']==='Comments')

                            <x-imet-core::custom-input-preview
                                    :type="$field['type']"
                                    :value="$record[$field['name']]"
                            ></x-imet-core::custom-input-preview>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    @endif

</table>
