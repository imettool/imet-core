<?php

use ImetCore\Models\Imet;
use ModularForms\Helpers\Template;

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
        @if($step === 'outcomes')
            <span class="text-sm">
                <span class="icon text-blue-600">
                   {!! Template::icon(icon:'circle-info', size:'1.4em') !!}
                </span>
                @lang('imet-core::common.score_info.outcomes')
            </span>
        @endif
    </div>
</div>
