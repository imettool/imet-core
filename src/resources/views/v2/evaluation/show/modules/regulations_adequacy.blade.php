<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\RegulationsAdequacy;
use Illuminate\Support\Facades\View;


$view = View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $view, RegulationsAdequacy::get_marine_predefined());

?>

{!! $view !!}
