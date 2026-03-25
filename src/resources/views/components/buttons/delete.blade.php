<?php

use ImetCore\Controllers;
use ImetCore\Models;
use ModularForms\Helpers\Template;

/** @var int|Models\Imet\ImetV2\Imet|Models\Imet\ImetV1\Imet|Models\Imet\ImetOecm\Imet|Models\Imet\ImetV2\Imet_Eval|Models\Imet\ImetV1\Imet_Eval|Models\Imet\ImetOecm\Imet_Eval $item */
/** @var string $version */

if ($version === Models\Imet\Imet::IMET_V1) {
    $controller = Controllers\Imet\ImetV1\Controller::class;
} elseif ($version === Models\Imet\Imet::IMET_V2) {
    $controller = Controllers\Imet\ImetV2\Controller::class;
} else {
    $controller = Controllers\Imet\ImetOecm\Controller::class;
}

?>

<x-modular-forms::button.form.destroy
    :controller="$controller"
    :item="$item"
></x-modular-forms::button.form.destroy>
