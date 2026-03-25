<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */
/** @var array $records */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\Stakeholders;
use Illuminate\Database\Eloquent\Collection;

$form_id = $module->data['id'];

$stakeholders = Stakeholders::calculateWeights($form_id, Stakeholders::ONLY_DIRECT);
arsort($stakeholders);

?>

@include('imet-core::oecm.context.show.modules._analysis_stakeholders', [
    'definitions' => $definitions,
    'records' => $records,
    'stakeholders' => $stakeholders
])
