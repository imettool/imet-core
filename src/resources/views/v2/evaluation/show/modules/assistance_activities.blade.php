<?php
/** @var array $records */
/** @var array $definitions */

use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\v2\Modules\Evaluation\AssistanceActivities;
use Illuminate\Support\Facades\View;

$view = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::TERRESTRIAL, $view, AssistanceActivities::get_terrestrial_predefined());
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $view, AssistanceActivities::get_marine_predefined());


?>

{!! $view !!}

@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
