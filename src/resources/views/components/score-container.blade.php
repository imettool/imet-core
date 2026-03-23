<?php

use ImetCore\Models\Imet;

/** @var string $step */
/** @var Imet\ImetV1\Imet|Imet\ImetV2\Imet|Imet\ImetOecm\Imet $item */

?>

<div class="module-container">
    <div class="module-header">
        <div class="module-title">
            @lang('imet-core::common.steps_eval.management_effectiveness')
        </div>
    </div>
    <div class="module-body">
        @include('imet-core::components.scores', [
            'item' => $item,
            'step' => $step,
            'version' => $item::$version
        ])
    </div>
</div>
