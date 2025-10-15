<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $vueData */

?>

@include('modular-forms::module.show.type.commons', compact(['collection','definitions']))
@include('modular-forms::module.show.type.table', compact(['collection',  'definitions']))

