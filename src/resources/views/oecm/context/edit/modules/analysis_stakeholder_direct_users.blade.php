<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\oecm\Imet;
use \ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use Illuminate\Database\Eloquent\Collection;

$stakeholders = Stakeholders::calculateWeights($vueData['form_id'], Stakeholders::ONLY_DIRECT);
arsort($stakeholders);

?>

@include('imet-core::oecm.context.edit.modules._analysis_stakeholders', [
    'definitions' => $definitions,
    'stakeholders' => $stakeholders
])
