<?php

/** @var \ImetCore\Controllers\Imet\ImetV2\ContextController $controller */
/** @var \ImetCore\Models\Imet\ImetV2\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.show', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
