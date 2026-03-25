<?php
/** @var ImetModule $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\Components\Modules\ImetModule;

?>

@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])
@include('modular-forms::module.edit.type.table', ['definitions' => $definitions])

<x-modular-forms::module.components.script
    :module="$module"
    :controller="$controller"
    :mode="$mode"
></x-modular-forms::module.components.script>
