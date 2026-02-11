<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array<string, mixed> $vueData */

/** @var ?string $group_key (optional - only for GROUP_ACCORDION) */

use ModularForms\Helpers\Template;
use Illuminate\Support\Str;

$group_key ??= '';

?>
<x-modular-forms::accordion.container>
    @foreach($definitions['groups'] as $key=>$group)
        <x-modular-forms::accordion.item :is-collapsible="false" class="show">
            <x-slot:title>
                <span>
                    {{ $key }}. {{ $group['MainCategory'] }}
                </span>
            </x-slot:title>
            <div>
                @foreach($definitions['fields'] as $field)
                    @if($field['name'] === $definitions['virtual_field'])
                        @foreach($records as $index=>$record)
                            @if($record['MainCategory'] === $group['MainCategory'])
                                <strong>{{ ucfirst($field['label'] ?? '') }} </strong>
                                <x-modular-forms::module.components.field.input-preview
                                    :type="$field['type']"
                                    :value="$record[$field['name']]"
                                ></x-modular-forms::module.components.field.input-preview>
                                @break
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            <br/>
            <table class="table module-table">
                <thead>
                <tr>
                    @foreach($definitions['fields'] as $field)
                        @if(!in_array($field['name'], [$definitions['group_key_field'], $definitions['virtual_field']]))
                            <th class="text-center">
                                @if($field['type']!=='hidden')
                                    {{ ucfirst($field['label'] ?? '') }}
                                @endif
                            </th>
                        @endif
                    @endforeach
                    <th></th>
                </tr>
                </thead>
                <tbody class="{{ $group_key }}">
                @foreach($records as $index=>$record)
                    @if($record['MainCategory'] !== $group['MainCategory'])
                        @continue
                    @endif
                    <tr class="module-table-item">
                        @foreach($definitions['fields'] as $field)
                            @if(!in_array($field['name'], [$definitions['group_key_field'], $definitions['virtual_field']]))
                                <td>
                                    <x-modular-forms::module.components.field.input-preview
                                        :type="$field['type']"
                                        :value="$record[$field['name']]"
                                    ></x-modular-forms::module.components.field.input-preview>

                                    {{--            @include('modular-forms::module.edit.type.simple', [--}}
                                    {{--                'definitions' => $definitions,--}}
                                    {{--                'records' => $records,--}}
                                    {{--                'index' => $index--}}
                                    {{--            ])--}}
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-modular-forms::accordion.item>
    @endforeach


</x-modular-forms::accordion.container>


