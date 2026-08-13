<?php
/** @var ImetModule $module */

use Illuminate\Support\Str;
use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ModularForms\Helpers\Template;

?>

{{-- Custom view for IMET v1 --}}
@if(Str::contains($module->getSlug(), 'imet_v1'))
    @include('imet-core::v1.info', ['module' => $module])

    {{-- Custom view for IMET v2 or OECM --}}
@elseif(Str::contains($module->getSlug(), 'imet_v2')
    || Str::contains($module->getSlug(), 'imet_oecm'))
    @include('imet-core::components.info', ['module' => $module])

@elseif($module->module_info!==null)

    {{-- #########  Standard vendor (modular-forms) view ######### --}}
    <div class="module-bar info-bar">
        <div class="icon">
            {!! Template::icon('info-circle', '', '1.4em') !!}
        </div>
        <div class="message">
            {!! $module->module_info !!}
        </div>
    </div>

@endif



