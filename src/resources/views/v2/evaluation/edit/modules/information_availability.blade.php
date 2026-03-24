<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

?>

@include('imet-core::components.module.edit.group_with_nothing_to_evaluate', ['definitions' => $definitions])

<x-modular-forms::module.components.script
    :module="$module"
    :controller="$controller"
    :mode="$mode"
></x-modular-forms::module.components.script>
