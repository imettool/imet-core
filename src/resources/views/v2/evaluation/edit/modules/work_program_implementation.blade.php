<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array<string, mixed> $vueData */

/** @var ?string $group_key (optional - only for GROUP_ACCORDION) */

use ModularForms\Helpers\Template;
use Illuminate\Support\Str;

$group_key ??= '';

$table_id = 'group_table_' . $definitions['module_key'] . '_' . $group_key;

?>

<x-modular-forms::accordion.container>

    <x-modular-forms::accordion.item v-for="(group_label, group_key, group_index) in groups">

        <!-- Accordion header -->
        <x-slot:title>
            <span>@{{ accordionTitle(group_key) }}</span>
        </x-slot:title>

        <!-- Group field -->
        <div v-for="(item, index) in recordsFilterKeepIndex(group_key)" class="mb-4">
            @foreach($definitions['fields'] as $field)
                @if($field['name'] === $definitions['group_key_field'])
                    <strong class="mr-4">{{ ucfirst($field['label'] ?? '') }} </strong>
                        @include('modular-forms::module.edit.field.module-to-vue', [
                            'definitions' => $definitions,
                            'field' => $field,
                            'vue_record_index' => 'item[\'__index\']',
                            'vue_directives' => '@input="refreshGroupKey(group_key, $event.target.textContent)"',
                        ])
                @endif
            @endforeach
        </div>

        <table class="table module-table" id="{{ $table_id }}" v-if="isGroupDefined(group_key)">

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

            {{-- inputs --}}
            <tbody class="{{ $group_key }}">
                <template v-for="(item, index) in records">
                    <tr class="module-table-item" v-if="recordIsInGroup(item, group_key)">
                        {{--  fields  --}}
                        @foreach($definitions['fields'] as $field)
                            @if($field['name'] !== $definitions['fields'][0]['name']) {{-- skip group key field --}}
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
                            {{-- record id  --}}
                            <x-modular-forms::module.components.field.input
                                type="hidden"
                                :value="'item.'.$definitions['primary_key']"
                            ></x-modular-forms::module.components.field.input>
                            {{-- delete button  --}}
                            @include('modular-forms::module.components.buttons.delete_item', [
                                'onClick' => 'deleteItem(item[\'__index\'])',
                                'icon' => Template::icon('trash', 'white')
                            ])
                        </td>
                    </tr>
                </template>
            </tbody>

            {{-- add button--}}
            <tfoot>
                <tr>
                    <td colspan="{{ count($definitions['fields']) + 1 }}">
                        @include('modular-forms::module.components.buttons.add_item', [
                            'onClick' => 'addItem(group_key)',
                            'icon' => Template::icon('plus-circle', 'white'),
                            'text' => Str::ucfirst((trans('modular-forms::common.add_item')))
                        ])
                    </td>
                </tr>
            </tfoot>

        </table>

    </x-modular-forms::accordion.item>

</x-modular-forms::accordion.container>

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.WorkProgramImplementation(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');

        document.addEventListener('accordion:opened', function(event) {
            const body = event.target.querySelector('.accordion-item-body');
            if (body) {
                body.removeAttribute('style');
            }
        });
    </script>
@endpush

