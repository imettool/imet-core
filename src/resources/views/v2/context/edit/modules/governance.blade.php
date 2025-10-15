<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $vueData */
/** @var string $mode */

?>
<div class="text-2xl font-bold highlight mb-3">@lang('imet-core::v2_context.Governance.governance')</div>
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

<div class="text-2xl font-bold highlight mb-3">@lang('imet-core::v2_context.Governance.partnership')</div>
@include('modular-forms::module.edit.type.accordion', compact(['collection', 'vueData', 'definitions']))

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
