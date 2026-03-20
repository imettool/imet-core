<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $vueData */
/** @var array $definitions */

/** @var ?string $group_key (optional - only for GROUP_TABLE) */

use ModularForms\Enums\ModuleViewModes;

$group_key = '';

$table_id = 'table_' . $definitions['slug'];

?>
@foreach($definitions['groups'] as $group_key => $group_label)
        <?php
        $table_id = 'group_table_' . $definitions['slug'] . '_' . $group_key;

        $items = array_filter($records, fn(array $item): bool => $item[$definitions['group_key_field']] === $group_key);
        ?>
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
        @if(count($items)===0)
            @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 4, 'mode' => ModuleViewModes::SHOW])
        @else
            <tbody class="{{ $group_key }}">
            @foreach($items as $record)
                <tr class="module-table-item">
                    @foreach($definitions['fields'] as $f_index=>$field)
                        <td>
                            <x-modular-forms::module.components.field.input-preview
                                :type="$field['type']"
                                :value="$record[$field['name']]"
                            ></x-modular-forms::module.components.field.input-preview>


                        </td>
                        @if($field['name']==='IncludeInStatistics')
                            <td>
                                @if($record['EvaluationScore'] > -99)
                                    <strong>{{ number_format((($record['EvaluationScore'] + $record['EvaluationScore2']) * 100 / 6), 1) }}</strong>
                                @endif
                            </td>

                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        @endif

    </table>
    <br/>
    <br/>
@endforeach

