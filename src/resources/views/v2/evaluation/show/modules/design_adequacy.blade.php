<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

/** @var array $records */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;
use ImetCore\Models\Imet\ImetV2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\DesignAdequacy;
use Illuminate\Support\Facades\View;


$view = View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $view, DesignAdequacy::get_marine_predefined());

?>

{!! $view !!}
