<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\ImetOecm\Modules\Component\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\AssistanceActivities;
use Illuminate\Support\Facades\View;

$view = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::TERRESTRIAL, $view, AssistanceActivities::get_terrestrial_predefined());
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $view, AssistanceActivities::get_marine_predefined());


?>

{!! $view !!}

@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
