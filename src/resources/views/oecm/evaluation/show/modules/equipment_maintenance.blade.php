@php
    /** @var \Illuminate\Database\Eloquent\Collection $collection */
    /** @var array $definitions */
    /** @var array $records */

    foreach ($records as $i => $record){
        $records[$i]['Equipment'] = $record['__predefined_label'];
    }
@endphp

@include('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])
