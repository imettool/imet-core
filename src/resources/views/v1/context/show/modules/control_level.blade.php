<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

$vue_record_index = '0';
$record = $records[0];

$area = \ImetCore\Models\Imet\ImetV1\Modules\Context\Areas::getArea($record['FormID']);
$area_percentage = \ImetCore\Models\Imet\ImetV1\Modules\Context\ControlLevel::areaPercentage($record, $area);
$average_time = \ImetCore\Models\Imet\ImetV1\Modules\Context\ControlLevel::averageTime($record, $area);
$area_percentage_conversion = \ImetCore\Models\Imet\ImetV1\Modules\Context\ControlLevel::areaPercentageConversion($record, $area);
$average_time_controlled = \ImetCore\Models\Imet\ImetV1\Modules\Context\ControlLevel::averageTimeControlled($record, $area);
$ecological_monitoring_patrol_km_percentage = \ImetCore\Models\Imet\ImetV1\Modules\Context\ControlLevel::ecologicalMonitoringPatrolKmPercentage($record, $area);

?>


<table id="table_imet__context__control_level" class="table module-table">
    <tr>
        <td></td>
        <th class="text-center" colspan="2">@lang('imet-core::v1_context.ControlLevel.area')</th>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="4" style="width: 400px;">@lang('imet-core::v1_context.ControlLevel.under_control_area')</th>
        <td class="text-center"><label
                    for="{{  $definitions['fields'][0]['name'] }}">{!! ucfirst($definitions['fields'][0]['label']) !!}</label>
        </td>
        <td class="text-center"><label
                    for="area_percentage">@lang('imet-core::v1_context.ControlLevel.area_percentage')</label></td>
        <td class="text-center"><label
                    for="{{  $definitions['fields'][1]['name'] }}">{!! ucfirst($definitions['fields'][1]['label']) !!}</label>
        </td>
        <td class="text-center"><label
                    for="average_time">@lang('imet-core::v1_context.ControlLevel.average_time')</label></td>
    </tr>
    <tr>
        <td>
            <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][0]['type']"
                    :value="$record[$definitions['fields'][0]['name']]"
            ></x-modular-forms::module.components.field.input-preview>
        </td>
        <td>
            <input type="text" disabled="disabled" value="{{ $area_percentage  }}"
                   class="field-edit field-numeric text-right"/>
        </td>
        <td rowspan="3">
            <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][1]['type']"
                    :value="$record[$definitions['fields'][1]['name']]"
            ></x-modular-forms::module.components.field.input-preview>
        </td>
        <td>
            <input type="text" disabled="disabled" value="{{ $average_time  }}"
                   class="field-edit field-numeric text-right"/>
        </td>
    </tr>
    <tr>
        <td><label
                    for="{{  $definitions['fields'][2]['name'] }}">{!! ucfirst($definitions['fields'][2]['label']) !!}</label>
        </td>
        <th>@lang('imet-core::v1_context.ControlLevel.area_percentage_conversion')</th>
        <th>@lang('imet-core::v1_context.ControlLevel.average_time_controlled')</th>
    </tr>
    <tr>
        <td>
            <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][3]['type']"
                    :value="$record[$definitions['fields'][2]['name']]"
            ></x-modular-forms::module.components.field.input-preview>
        </td>
        <td><input type="text" disabled="disabled" value="{{ $area_percentage_conversion  }}"
                   class="field-edit field-numeric text-right"/></td>
        <td><input type="text" disabled="disabled" value="{{ $average_time_controlled  }}"
                   class="field-edit field-numeric text-right"/></td>
    </tr>
    <tr>
        <td><label
                    for="{{  $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label>
        </td>
        <td>
            <x-modular-forms::module.components.field.input-preview
                    :type="$definitions['fields'][3]['type']"
                    :value="$record[$definitions['fields'][3]['name']]"
            ></x-modular-forms::module.components.field.input-preview>
        </td>
        <td><input type="text" disabled="disabled" value="{{ $ecological_monitoring_patrol_km_percentage  }}"
                   class="field-edit field-numeric text-right"/></td>
        <td colspan="2"></td>
    </tr>
</table>

@component('modular-forms::module.components.field_container', [
               'name' => $definitions['fields'][4]['name'],
               'label' => $definitions['fields'][4]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    <x-modular-forms::module.components.field.input-preview
            :type="$definitions['fields'][4]['type']"
            :value="$record[$definitions['fields'][4]['name']]"
    ></x-modular-forms::module.components.field.input-preview>

@endcomponent


@component('modular-forms::module.components.field_container', [
               'name' => $definitions['fields'][5]['name'],
               'label' => $definitions['fields'][5]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    <x-modular-forms::module.components.field.input-preview
            :type="$definitions['fields'][5]['type']"
            :value="$record[$definitions['fields'][5]['name']]"
    ></x-modular-forms::module.components.field.input-preview>

@endcomponent

