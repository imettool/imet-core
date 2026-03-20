<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

?>

@foreach($definitions['groups'] as $group_key => $group_label)
    <div class="{{ $group_key }}">

        <h5 class="highlight group_title_{{ $definitions['slug'] }}_{{ $group_key }}">{{ $group_label }}</h5>

        @include('imet-core::components.module.show.table_with_nothing_to_evaluate', [
           'definitions' => $definitions,
           'records' => $records,
           'group_key' => $group_key
       ])

    </div>
@endforeach
