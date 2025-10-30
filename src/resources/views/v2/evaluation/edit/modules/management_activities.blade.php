@php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */
@endphp

@foreach($definitions['groups'] as $group_key => $group_label)

    <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

    <table id="{{ 'group_table_'.$definitions['module_key'].'_'.$group_key }}" class="table module-table">

        {{-- labels  --}}
        <thead>
        <tr>
            @foreach($definitions['fields'] as $field)
                @if($field['type']!=='hidden')
                    <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
                @endif
            @endforeach
            <th></th>
        </tr>
        </thead>

        {{-- inputs --}}
        <tbody class="{{ $group_key }}" v-if="hasRecordsToEvaluate('{{ $definitions['fields'][0]['name'] }}', '{{ $group_key }}')">
            <template v-for="(item, index) in records">
                <tr class="module-table-item" v-if="recordIsInGroup(item, '{{ $group_key }}')">
                    {{--  fields  --}}
                    @foreach($definitions['fields'] as $i => $field)
                        <td>
                            @if($i===0 && $group_key==='group6')
                                @php
                                    $activity_id = "'".$definitions['module_key']."_".$group_key."_'+index+'_".$field['name']."'";
                                    $activity_value = 'records[\''.$group_key.'\'][index].'.$field['name'];
                                @endphp
                                <x-modular-forms::module.components.field.input
                                    type="text-area"
                                    :value="$activity_value"
                                    :id="$activity_id"
                                ></x-modular-forms::module.components.field.input>
                            @else
                                @include('modular-forms::module.edit.field.module-to-vue', [
                                    'definitions' => $definitions,
                                    'field' => $field,
                                    'vue_record_index' => 'index',
                                    'group_key' => $group_key
                                ])
                            @endif
                        </td>
                    @endforeach
                    <td>
                        {{-- record id  --}}
                        <x-modular-forms::module.components.field.input
                            type="hidden"
                            :value="'item.'.$definitions['primary_key']"
                        ></x-modular-forms::module.components.field.input>
                        @if($group_key==='group6')
                            <span v-if="typeof item.__predefined === 'undefined'">
                                <x-modular-forms::module.components.buttons.delete-item />
                            </span>
                        @endif
                    </td>
                </tr>
            </template>
        </tbody>

        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 4])

    @if($group_key==='group6')
            <tfoot v-if="max_rows==null || records.length < max_rows">
            {{-- add button --}}
            <tr>
                <td colspan="{{ count($definitions['fields']) + 1 }}">
                    <x-modular-forms::module.components.buttons.add-item :group-key="$group_key" />
                </td>
            </tr>
            </tfoot>
        @endif

    </table>

    <br />
    <br />

@endforeach

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>

