<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\Stakeholders;

$stakeholders = Stakeholders::calculateWeights($module->vueData['form_id'], Stakeholders::ONLY_INDIRECT);
arsort($stakeholders);

?>

@include('imet-core::oecm.context.edit.modules._analysis_stakeholders', [
    'definitions' => $definitions,
    'stakeholders' => $stakeholders
])
