<?php
/** @var array $records */
/** @var array $definitions */

use ModularForms\Helpers\Template;
use Illuminate\Support\Str;


?>



<x-modular-forms::accordion.container>

    @php
        $group_index = 1;
    @endphp
    @foreach($definitions['groups'] as $group_key => $group_label)

        @if($group_label!==null)

            <x-modular-forms::accordion.item class="show">

                <!-- Accordion header -->
                <x-slot:title>
                    <span>
                        {{ $group_index }} - {{ $group_label }}
                    </span>
                </x-slot:title>

                <!-- Group field -->
                @php
                    $i = array_search($definitions['group_key_field'], array_column($definitions['fields'], 'name'));
                    $group_key_field = $definitions['fields'][$i] ?? null;
                @endphp
                <div class="mb-4">
                    <strong class="mr-4">{{ ucfirst($group_key_field['label']) ?? '' }} </strong>
                    <x-modular-forms::module.components.field.input-preview
                        :type="$group_key_field['type']"
                        :value="$group_label"
                    ></x-modular-forms::module.components.field.input-preview>
                </div>


                <table class="table module-table">

                    {{-- labels  --}}
                    <thead>
                        <tr>
                            @foreach($definitions['fields'] as $field)
                                @if($field['name'] !== $definitions['fields'][0]['name']) {{-- skip group key field --}}
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

                    {{-- values --}}
                    <tbody class="{{ $group_key }}">
                        @php
                            $group_records = array_filter($records, function ($item) use($definitions, $group_label) {
                                return $item[$definitions['group_key_field']] === $group_label;
                            })
                        @endphp

                        @foreach($group_records as $record)
                            <tr class="module-table-item">
                                @foreach($definitions['fields'] as $field)
                                    @if($field['name'] !== $definitions['fields'][0]['name']) {{-- skip group key field --}}
                                        <td>
                                            <x-modular-forms::module.components.field.input-preview
                                                :type="$field['type']"
                                                :value="$record[$field['name']]"
                                            ></x-modular-forms::module.components.field.input-preview>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>

                        @endforeach
                    </tbody>

                </table>

            </x-modular-forms::accordion.item>

        @endif

        @php
            $group_index++;
        @endphp

    @endforeach


</x-modular-forms::accordion.container>


