<?php
/** @var string $version */

use ModularForms\Helpers\Template;

if ($version === \ImetCore\Models\Imet\Imet::IMET_V1) {
    $controller = \ImetCore\Controllers\Imet\ImetV1\Controller::class;
} elseif ($version === \ImetCore\Models\Imet\Imet::IMET_V2) {
    $controller = \ImetCore\Controllers\Imet\ImetV2\Controller::class;
} else {
    $controller = \ImetCore\Controllers\Imet\ImetOecm\Controller::class;
}

?>


<a id="export_{{ $item->getKey() }}"
   class="btn-nav mr-1 small btn-primary"
   href="{{ action([$controller, 'export'], [$item->getKey()]) }}">
    {!! Template::icon('cloud-download-alt') !!}
</a>
<tooltip anchor-elem-id="export_{{ $item->getKey() }}">
    {{ ucfirst(trans('modular-forms::common.export')) }}
</tooltip>

