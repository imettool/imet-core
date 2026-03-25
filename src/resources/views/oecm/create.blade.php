<?php
/** @var ?bool $is_wdpa */

use ImetCore\Models\Imet\ImetOecm\Modules\Context\Create;
use ImetCore\Models\Imet\ImetOecm\Modules\Context\CreateNonWdpa;

$is_wdpa ??= true;
?>

@extends('modular-forms::page.create', [
    'controller' => \ImetCore\Controllers\Imet\ImetOecm\ContextController::class,
    'module' => $is_wdpa
        ? Create::class
        : CreateNonWdpa::class
])
