<?php
/** @var ?bool $is_wdpa */

use ImetCore\Models\Imet\ImetV2\Modules\Context\Create;
use ImetCore\Models\Imet\ImetV2\Modules\Context\CreateNonWdpa;

$is_wdpa ??= true;

?>

@extends('modular-forms::page.create', [
    'controller' => \ImetCore\Controllers\Imet\ImetV2\ContextController::class,
    'module' => $is_wdpa
        ? Create::class
        : CreateNonWdpa::class
])
