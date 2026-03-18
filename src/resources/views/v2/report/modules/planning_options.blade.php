<?php


?>

<div class="module-container">
    <div class="module-header">
        <div class="module-title">@lang('imet-core::v2_report.planning_options')</div>
    </div>
    <div class="module-body">

        @lang(('imet-core::v2_report.planning_options_info.general_info'))

        {{-- TABLE A --}}
        <h6 class="font-bold">@lang(('imet-core::v2_report.planning_options_info.table_a_title'))</h6>
        <p>@lang(('imet-core::v2_report.planning_options_info.table_a_info'))</p>
        <p class="font-bold">@lang(('imet-core::v2_report.planning_options_info.definitions'))</p>
        <ul>
            @foreach(trans(('imet-core::v2_report.planning_options_info.table_a_definitions')) as $def)
                <li>{!! $def !!}</li>
            @endforeach
        </ul>

        <table class="table module-table !my-6">

            <tr>
                <th></th>
                <th class="text-center">@lang('imet-core::v2_report.planning_options_info.table_a_fields.kce')</th>
                <th class="text-center">@lang('imet-core::v2_report.planning_options_info.table_a_fields.targets_es')</th>
                <th class="text-center">@lang('imet-core::v2_report.planning_options_info.table_a_fields.kea')</th>
                <th class="text-center">@lang('imet-core::v2_report.planning_options_info.table_a_fields.threats')</th>
                <th class="text-center">@lang('imet-core::v2_report.planning_options_info.table_a_fields.note')</th>
            </tr>

            @for($i=1; $i<=10; $i++)
                <tr class="module-table-item">
                    <td class="text-sm">{{ $i }}</td>
                    <td><input type="text" class="field-edit" /></td>
                    <td><input type="text" class="field-edit" /></td>
                    <td><input type="text" class="field-edit" /></td>
                    <td><input type="text" class="field-edit" /></td>
                    <td><input type="text" class="field-edit" /></td>
                </tr>
            @endfor

        </table>

        {{-- TABLE B --}}
        <h6 class="font-bold">@lang(('imet-core::v2_report.planning_options_info.table_b_title'))</h6>
        <p>@lang(('imet-core::v2_report.planning_options_info.table_b_info'))</p>
        <p class="font-bold">@lang(('imet-core::v2_report.planning_options_info.definitions'))</p>
        <ul>
            @foreach(trans(('imet-core::v2_report.planning_options_info.table_b_definitions')) as $def)
                <li>{!! $def !!}</li>
            @endforeach
        </ul>

        Hello

        {{-- TABLE C --}}
        <h6 class="font-bold">@lang(('imet-core::v2_report.planning_options_info.table_c_title'))</h6>
        <p>@lang(('imet-core::v2_report.planning_options_info.table_c_info'))</p>
        <p class="font-bold">@lang(('imet-core::v2_report.planning_options_info.definitions'))</p>
        <ul>
            @foreach(trans(('imet-core::v2_report.planning_options_info.table_c_definitions')) as $def)
                <li>{!! $def !!}</li>
            @endforeach
        </ul>

        Hello


    </div>
</div>
