<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var mixed $definitions */
/** @var mixed $records */

use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\v2\Modules\Evaluation\DesignAdequacy;
use Illuminate\Support\Facades\View;


$view = View::make('modular-forms::module.show.type.table', ['definitions' => $definitions, 'records' => $records])->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $view, DesignAdequacy::get_marine_predefined());

?>

{!! $view !!}
