<?php
/** @var String $version */

use ModularForms\Helpers\Template;

if($version === \ImetCore\Models\Imet\Imet::IMET_V1){
    $controller = \ImetCore\Controllers\Imet\v1\Controller::class;
} else if($version === \ImetCore\Models\Imet\Imet::IMET_V2){
    $controller = \ImetCore\Controllers\Imet\v2\Controller::class;
} else {
    $controller = \ImetCore\Controllers\Imet\oecm\Controller::class;
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

