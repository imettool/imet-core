<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

/** @var array $records */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;
use ImetCore\Models\Imet\ImetV2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\LawEnforcementImplementation;
use Illuminate\Support\Facades\View;

$page = View::make('modular-forms::module.show.type.group_table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject marine/terrestrial icon on title
$page = ImetModule::injectIconToGroups($page, LawEnforcementImplementation::get_marine_groups(), LawEnforcementImplementation::get_terrestrial_groups());


?>

{!! $page !!}

@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
