<?php
/** @var ImetModule $module */

use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\Components\Modules\ImetModule;

?>

<div class="module-header">
    @if($module->module_code!==null)
        <div class="module-code text-center">
            {!! ucfirst($module->module_code) !!}
        </div>
    @endif
    <div class="module-title">
        {!! Template::module_scope($module::MODULE_SCOPE) !!}
        {!! ucfirst($module->module_title) !!}
    </div>

</div>
