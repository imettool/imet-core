<?php
/** @var array $vueData */
/** @var array $definitions */

use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\v2\Modules\Evaluation\IntelligenceImplementation;
use Illuminate\Support\Facades\View;

$view_groupTable = View::make('modular-forms::module.edit.type.group_table', ['definitions' => $definitions])->render();

// Inject marine/terrestrial icon on title
$view_groupTable = ImetModule::injectIconToGroups($view_groupTable, IntelligenceImplementation::get_marine_groups(), IntelligenceImplementation::get_terrestrial_groups());

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])

<x-modular-forms::module.components.script
    :vue-data="$vueData"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
