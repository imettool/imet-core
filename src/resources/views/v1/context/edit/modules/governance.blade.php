<?php
/** @var Imet $module */
/** @var string $controller */
/** @var string $mode */
/** @var array $definitions */

use ImetCore\Models\Imet\v1\Imet;
?>

@include('modular-forms::module.edit.type.commons', ['definitions' => $definitions])
@include('modular-forms::module.edit.type.accordion', ['definitions' => $definitions])

<x-modular-forms::module.components.script
    :module="$module"
    :definitions="$definitions"
    :mode="$mode"
></x-modular-forms::module.components.script>
