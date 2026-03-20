<?php
/** @var array $vueData */
/** @var array $definitions */
/** @var ?string $group_key (optional - only for GROUP_TABLE) */

$group_key = '';

$table_id = 'table_'.$definitions['slug'];

?>
@foreach($definitions['groups'] as $group_key => $group_label)

    <h5 class="highlight group_title_{{ $definitions['slug'] }}_{{ $group_key }}">{{ $group_label }}</h5>
    <table id="{{ $table_id }}" class="table module-table">

        {{-- labels  --}}
        <thead>
        <tr>
            <th class="text-center">{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</th>
            <th class="text-center">{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</th>

            <th class="text-center">{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</th>

            <th class="text-center">{{ ucfirst($definitions['fields'][3]['label'] ?? '') }}</th>
            <th class="text-center">{{ trans('imet-core::v2_evaluation.SupportsAndConstraints.fields.Score') }}</th>
            <th class="text-center">{{ ucfirst($definitions['fields'][4]['label'] ?? '') }}</th>
        </tr>
        </thead>

        {{-- inputs --}}
        <tbody class="{{ $group_key }}"  v-if="hasRecordsToEvaluate('{{ $definitions['fields'][0]['name'] }}')">
        <template v-for="(item, index) in records">
            <tr class="module-table-item" v-if="recordIsInGroup(item, '{{ $group_key }}')">
                <td>
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $definitions['fields'][0],
                        'vue_record_index' => 'index',
                        'group_key' => $group_key,
                    ])
                </td>
                <td>
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $definitions['fields'][1],
                        'vue_record_index' => 'index',
                        'group_key' => $group_key,
                    ])
                </td>
                <td>
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $definitions['fields'][2],
                        'vue_record_index' => 'index',
                        'group_key' => $group_key
                    ])
                </td>
                <td>
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $definitions['fields'][3],
                        'vue_record_index' => 'index',
                        'group_key' => $group_key,
                    ])
                </td>
                <td >
                    <div class="mr-5" ><strong><span v-html="evaluation[index]"></span></strong></div>
                </td>

                <td>
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $definitions['fields'][4],
                        'vue_record_index' => 'index',
                        'group_key' => $group_key
                    ])
                </td>
                <td>
                    {{-- group_key_field (for GROUP_TABLE)  --}}
                    @if($definitions['module_type']==='GROUP_TABLE')
                        <x-modular-forms::module.components.field.input
                            type="hidden"
                            :value="'item.'.$definitions['group_key_field']"
                        ></x-modular-forms::module.components.field.input>
                    @endif
                    {{-- record id  --}}
                    <x-modular-forms::module.components.field.input
                        type="hidden"
                        :value="'item.'.$definitions['primary_key']"
                    ></x-modular-forms::module.components.field.input>
                </td>
            <tr>
        </template>
        </tbody>
        @if(!$definitions['fixed_rows'])
            <tfoot v-if="max_rows==null || numRecordsInGroup('{{ $group_key }}') < max_rows">
            {{-- add button--}}
            <tr>
                <td colspan="{{ count($definitions['fields']) + 1 }}">
                    <x-modular-forms::module.components.buttons.add-item :group-key="$group_key" />
                </td>
            </tr>
            </tfoot>
        @endif
        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 5])

    </table>
    <br />
    <br />
@endforeach

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.SupportsAndConstraints(@json($vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
