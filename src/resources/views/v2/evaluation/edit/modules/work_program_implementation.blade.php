<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array<string, mixed> $vueData */

/** @var ?string $group_key (optional - only for GROUP_ACCORDION) */

use ModularForms\Helpers\Template;
use Illuminate\Support\Str;

$group_key ??= '';

$table_id = \Illuminate\Support\Str::contains($definitions['module_type'], 'GROUP_')
    ? 'group_table_' . $definitions['module_key'] . '_' . $group_key
    : 'table_' . $definitions['module_key'];

?>
<x-modular-forms::accordion.container>
    <x-modular-forms::accordion.item v-for="(record, id) in groups">
        <x-slot:title>
            <span>@{{ id }}. @{{ accordionTitle(id) }}</span>
        </x-slot:title>
        <x-slot:header-actions>
        </x-slot:header-actions>
        <div v-for="(value, key1) in recordsFilterKeepIndex(records, record, id)">
            @foreach($definitions['fields'] as $field)
                @if($field['name'] === $definitions['virtual_field'])
                    <strong>{{ ucfirst($field['label'] ?? '') }} </strong>
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $field,
                        'vue_record_index' => 'value.index',
                        'vue_directives' => '@input="updateGroupKey(id, $event.target.textContent)"',
                    ])
                @endif
            @endforeach
        </div>
        <br/>
        <table class="table module-table" id="{{ $table_id }}">
            {{-- labels  --}}
            <thead>
            <tr>
                @foreach($definitions['fields'] as $field)
                    @if(!isset($field['parent']))
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
            <template v-for="(item, index) in records">
                <tr class="module-table-item"
                    v-if="recordIsInGroup(item, record['MainCategory']) || recordIsInGroup(item, record['GroupKey'])">
                    @foreach($definitions['fields'] as $field)
                        @if(!isset($field['parent']))
                            <td>
                                @include('modular-forms::module.edit.field.module-to-vue', [
                                    'definitions' => $definitions,
                                    'field' => $field,
                                    'vue_record_index' => 'index',
                                ])
                            </td>
                        @endif
                    @endforeach
                    <td>
                        <span class="find_id">
                            <x-modular-forms::module.components.field.input
                                type="hidden"
                                :value="'item.'.$definitions['primary_key']"
                            ></x-modular-forms::module.components.field.input>
                        </span>
                        @if(!$definitions['fixed_rows'])
                            <span v-if="typeof item.__predefined === 'undefined'">
                                <x-modular-forms::module.components.buttons.delete-item/>
                            </span>
                        @endif
                    </td>
                </tr>
            </template>
            </tbody>

            @if(!$definitions['fixed_rows'])
                <tfoot v-if="max_rows==null || numRecordsInGroup(record) < max_rows">
                <tr>
                    <td colspan="{{ count($definitions['fields']) + 1 }}">
                        @include('modular-forms::module.components.buttons.add_item', ['onClick' => 'addItem(record[\'MainCategory\'], $event)',
                        'icon' => Template::icon('plus-circle', 'white'),
                        'text' => Str::ucfirst((trans('modular-forms::common.add_item')))
])

                    </td>
                </tr>
                </tfoot>
            @endif

        </table>
    </x-modular-forms::accordion.item>

</x-modular-forms::accordion.container>

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.WorkProgramImplementation(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');

        // fix accordion height when opened by removing it
        document.addEventListener('accordion:opened', function (event) {
            const body = event.target.querySelector('.accordion-item-body');
            if (body) {
                body.removeAttribute('style');
            }
        });
    </script>
@endpush

