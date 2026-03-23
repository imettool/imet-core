<?php

/** @var \ImetCore\Controllers\Imet\ImetOecm\ContextController $controller */
/** @var \ImetCore\Models\Imet\ImetOecm\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.show', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
