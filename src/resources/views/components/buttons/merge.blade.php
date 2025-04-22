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

<a id="merge_{{ $item->getKey() }}"
   class="btn-nav mr-1 small yellow"
   href="{{ action([$controller, 'merge_view'], [$item->getKey()]) }}">
    {!! Template::icon('clone') !!}
</a>
<tooltip anchor-elem-id="merge_{{ $item->getKey() }}">
    {{ ucfirst(trans('modular-forms::common.merge')) }}
</tooltip>
