<?php

/** @var \ImetCore\Controllers\Imet\ImetV1\ContextController $controller */
/** @var \ImetCore\Models\Imet\ImetV1\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.show', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
