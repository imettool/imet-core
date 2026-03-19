<?php
/** @var Imet $item */
/** @var string $step */
/** @var ?bool $printable */

use ImetCore\Models\Imet\Imet;
use ModularForms\Helpers\Template;

?>

<!--  Scroll buttons -->
@component('modular-forms::module.side-buttons', [
    'item' => $item,
    'step' => $step,
    'withZoom' => true,
    'withPrint' => $printable ?? false
])

@endcomponent
