<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */
/** @var array $stakeholders */
/** @var array $key_elements_importance */
/** @var string $current_stakeholder */
/** @var string $summary_title */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\AnalysisStakeholderDirectUsers;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\AnalysisStakeholderIndirectUsers;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\Stakeholders;
use Illuminate\Support\Str;

$num_cols = count($definitions['fields']);

$user_mode = Str::contains($definitions['module_class'], 'AnalysisStakeholderDirectUsers')
    ? AnalysisStakeholderDirectUsers::$USER_MODE
    : AnalysisStakeholderIndirectUsers::$USER_MODE;

$grouped_records = collect($records)->groupBy('group_key')->toArray();
$stakeholders_records = collect($records)
    ->groupBy('Stakeholder')
    ->map(fn($group) => $group->groupBy('group_key'))
    ->toArray();

$stakeholders_categories = Stakeholders::getStakeholders($module->data['id'], $user_mode, true);

?>


<x-modular-forms::accordion.container>


    @foreach(array_keys($stakeholders) as $index => $stakeholder)
        <x-modular-forms::accordion.item class="show" :is-collapsible=false>

            <x-slot:title>
                {{ $index + 1 }} -
                {{ $stakeholder }}
            </x-slot:title>

            @php
                $categories = array_key_exists($stakeholder, $stakeholders_categories)
                    ? json_decode($stakeholders_categories[$stakeholder])
                    : [];
                $categories = $categories!==null ? $categories : [];
            @endphp

            @if($categories === [])
                @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 6])

            @else

                {{-- groups --}}
                @foreach($definitions['groups'] as $group_key => $group_label)

                    @if(
                        in_array('provisioning', $categories) && in_array($group_key, ['group0', 'group1', 'group2', 'group3']) ||
                        in_array('cultural', $categories) && in_array($group_key, ['group4', 'group5', 'group6' ]) ||
                        in_array('regulating', $categories) && in_array($group_key, ['group7', 'group8']) ||
                        in_array('supporting', $categories) && in_array($group_key, ['group9', 'group10'])
                    )

                        {{-- titles --}}
                        @if($group_key === 'group0')
                            <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title0')</h4>
                        @elseif($group_key === 'group4')
                            <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title1')</h4>
                        @elseif($group_key === 'group7')
                            <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title2')</h4>
                        @elseif($group_key === 'group9')
                            <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title3')</h4>
                        @elseif($group_key === 'group11')
                            <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title4')</h4>
                        @endif

                        {{-- sub-titles --}}
                        <h5 class="highlight group_title_{{ $definitions['slug'] }}_{{ $group_key }}">{{ $group_label }}</h5>

                        {{-- Desctiptions --}}
                        <div class="pb-4 px-6 text-sm">
                            @lang('imet-core::oecm_context.AnalysisStakeholders.groups_descriptions.' . $group_key)
                        </div>

                        <table class="table module-table">

                            {{-- labels  --}}
                            <thead>
                            <tr>
                                @foreach($definitions['fields'] as $field)
                                    <th class="text-center">
                                        @if($field['type']!=='hidden')
                                            {{ ucfirst($field['label'] ?? '') }}
                                        @endif
                                    </th>
                                @endforeach
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="{{ $group_key }}">

                            {{-- nothing to evaluate --}}
                            @if(!array_key_exists($group_key, $grouped_records))
                                @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols])

                                {{-- body  --}}
                            @else
                                @foreach($stakeholders_records[$stakeholder][$group_key] as $record)
                                    <tr class="module-table-item">
                                        @foreach($definitions['fields'] as $f_index=>$field)
                                            <td>
                                                @if($field['name'] === 'Element')
                                                    <x-imet-core::custom-input-preview
                                                            type="text-area"
                                                            :value="$record[$field['name']]"
                                                    ></x-imet-core::custom-input-preview>
                                                @else
                                                    <x-imet-core::custom-input-preview
                                                            :type="$field['type']"
                                                            :value="$record[$field['name']]"
                                                    ></x-imet-core::custom-input-preview>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>

                    @endif
                @endforeach

            @endif

        </x-modular-forms::accordion.item>
    @endforeach

</x-modular-forms::accordion.container>
