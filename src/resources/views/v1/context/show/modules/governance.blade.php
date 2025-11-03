<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var array $records */

?>

@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))
@include('modular-forms::module.show.type.accordion', compact(['collection',  'definitions']))

