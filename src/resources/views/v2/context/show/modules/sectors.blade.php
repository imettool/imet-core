<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\v2\Imet;
use \ImetCore\Helpers\Template;
use \ImetCore\Models\Imet\v2\Modules\Component\ImetModule;

$table_id = 'table_' . $definitions['slug'];
$area = \ImetCore\Models\Imet\v2\Modules\Context\Areas::getArea($collection[0]->FormID);
$sumUnderControlArea = 0;
$UnderControlPatrolKm = 0;
$UnderControlPatrolManDay = 0;
@endphp

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $f_index=>$field)
            @if($field['type']!=='hidden')
                @if($f_index==3)
                    <th class="text-center">
                        {!! Template::module_scope(ImetModule::TERRESTRIAL) . ' ' . ucfirst($field['label'] ?? '') !!}
                    </th>
                @else
                    <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
                @endif
            @endif
            @if($f_index==2)
                <th class="text-center">@lang('imet-core::v2_context.Sectors.area_percentage')</th>
            @endif
            @if($f_index==4)
                <th class="text-center">@lang('imet-core::v2_context.Sectors.average_time')</th>
            @endif
        @endforeach

    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    @foreach($records as $i => $record)

        @php
            $area_percentage = null;
            $average_time = null;
            if (floatval($area) > 0 && floatval($record['UnderControlArea']) > 0) {
                $area_percentage = round(floatval($record['UnderControlArea']) / $area * 100, 2);
            }
            if (floatval($area) > 0 && floatval($record['UnderControlPatrolManDay']) > 0) {
                $average_time = round(floatval($record['UnderControlPatrolManDay']) / $area, 2);
            }
            $sumUnderControlArea += floatval($record['UnderControlArea']);
            $UnderControlPatrolKm += floatval($record['UnderControlPatrolKm']);
            $UnderControlPatrolManDay += floatval($record['UnderControlPatrolManDay']);
        @endphp

        <tr class="module-table-item">
            @foreach($definitions['fields'] as $f_index=>$field)
                <td>
                    <x-modular-forms::module.components.field.input-preview
                        :type="$field['type']"
                        :value="$record[$field['name']]"
                    ></x-modular-forms::module.components.field.input-preview>
                </td>
                @if($f_index==2)
                    <td>
                        <x-modular-forms::module.components.field.input-preview
                            type="numeric"
                            :value="$area_percentage"
                        ></x-modular-forms::module.components.field.input-preview>
                    </td>
                @elseif($f_index==4)
                    <td>
                        <x-modular-forms::module.components.field.input-preview
                            type="numeric"
                            :value="$average_time"
                        ></x-modular-forms::module.components.field.input-preview>
                    </td>
                @endif

            @endforeach
        </tr>
    @endforeach

    <tr class="module-table-item">
        <td></td>
        <td></td>
        <td>
            <x-modular-forms::module.components.field.input-preview
                type="numeric"
                :value="$sumUnderControlArea"
            ></x-modular-forms::module.components.field.input-preview>
        </td>
        <td></td>
        <td>
            <x-modular-forms::module.components.field.input-preview
                type="numeric"
                :value="$UnderControlPatrolKm"
            ></x-modular-forms::module.components.field.input-preview>
        </td>
        <td>
            <x-modular-forms::module.components.field.input-preview
                type="numeric"
                :value="$UnderControlPatrolManDay"
            ></x-modular-forms::module.components.field.input-preview>
        </td>
        <td></td>
    </tr>

    </tbody>

</table>

@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])

<?php
