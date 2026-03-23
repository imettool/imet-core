<?php
/** @var Imet_Eval $module */
/** @var string $controller */
/** @var string $mode */

/** @var array $definitions */

use ImetCore\Models\Imet\ImetV2\Imet_Eval;

?>

@include('imet-core::components.module.edit.group_with_nothing_to_evaluate', ['definitions' => $definitions])

<x-modular-forms::module.components.script
        :module="$module"
        :definitions="$definitions"
        :mode="$mode"
></x-modular-forms::module.components.script>
