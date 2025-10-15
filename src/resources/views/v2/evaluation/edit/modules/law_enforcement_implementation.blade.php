<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var array $definitions */
/** @var mixed $vueData */

use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\v2\Modules\Evaluation\LawEnforcementImplementation;
use Illuminate\Support\Facades\View;

$view_groupTable = View::make('modular-forms::module.edit.type.group_table', ['collection' => $collection, 'vueData' => $vueData, 'definitions' => $definitions])->render();

// Inject marine/terrestrial icon on title
$view_groupTable = ImetModule::injectIconToGroups($view_groupTable, LawEnforcementImplementation::get_marine_groups(), LawEnforcementImplementation::get_terrestrial_groups());

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
