<?php
/** @var array $definitions */

?>

{{-- Custom view for IMET v1 --}}
@if(\Illuminate\Support\Str::startsWith($definitions['slug'], 'imet__v1'))
    @include('imet-core::v1.info', ['$definitions' => $definitions])

{{-- Custom view for IMET v2 or OECM --}}
@elseif(\Illuminate\Support\Str::startsWith($definitions['slug'], 'imet__v2')
    || \Illuminate\Support\Str::startsWith($definitions['slug'], 'imet__oecm'))
    @include('imet-core::components.info', ['$definitions' => $definitions])

@elseif($definitions['module_info']!==null)

    {{-- #########  Standard vendor (modular-forms) view ######### --}}
    <div class="module-bar info-bar">
        <div class="icon">
            {!! \ModularForms\Helpers\Template::icon('info-circle', '', '1.4em') !!}
        </div>
        <div class="message">
            {!! $definitions['module_info'] !!}
        </div>
    </div>

@endif



