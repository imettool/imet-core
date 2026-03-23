<?php

use ImetCore\Controllers;
use ImetCore\Models;
use ModularForms\Enums\ModuleViewModes;

/** @var Controllers\Imet\ImetV1\Controller|Controllers\Imet\ImetV2\Controller|Controllers\Imet\ImetOecm\Controller $controller */
/** @var integer $formID */
/** @var Models\Imet\ImetV1\Modules\Component\ImetModule|Models\Imet\ImetV2\Modules\Component\ImetModule $module */
/** @var Models\Imet\ImetV1\Modules\Component\ImetModule|Models\Imet\ImetV2\Modules\Component\ImetModule $module_class as String */

$modal_id = 'imet_' . $formID . '_' . $module_class::getShortClassName();
?>

<floating_dialog>

    <!-- anchor -->
    <template slot="dialog-anchor">
        <button type="button" class="btn-nav small">
            {!! \ModularForms\Helpers\Template::icon('eye', 'white') !!}
        </button>
        <tooltip>@uclang('modular-forms::common.show')</tooltip>
    </template>

    <!-- dialog -->
    <template slot="dialog-content">
        <div class="with_header_and_footer">

            <!-- dialog header -->
            <div class="header">
                IMET #{{ $formID }}
            </div>

            <!-- dialog body -->
            <div class="body text-center">
                <x-modular-forms::module.container
                    :controller="$controller"
                    :module="$module_class"
                    :formId="$formID"
                    :mode="ModuleViewModes::SHOW"
                ></x-modular-forms::module.container>
            </div>

        </div>
    </template>

</floating_dialog>
