@php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

foreach ($records as $i => $record){
    $records[$i]['Equipment'] = $record['__predefined_label'];
    $records[$i]['Adequacy'] = $record['__adequacy'];
}

@endphp

@include('imet-core::components.module.show.table_with_nothing_to_evaluate', compact(['collection', 'records', 'definitions']))
