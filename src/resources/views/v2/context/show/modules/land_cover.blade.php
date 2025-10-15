<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

?>

@include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))
@include('modular-forms::module.show.type.table', compact(['definitions', 'records']))
