@php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $records */
/** @var array $definitions */

foreach ($records as $i => $record){
    $records[$i]['Equipment'] = $record['__predefined_label'];
    $records[$i]['EvaluationScore'] = $record['__adequacy'];
}
@endphp

@include('imet-core::components.module.show.table_with_nothing_to_evaluate', ['definitions' => $definitions, 'records' => $records])
