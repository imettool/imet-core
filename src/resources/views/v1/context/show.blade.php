<?php

/** @var \ImetCore\Controllers\Imet\v1\ContextController $controller */
/** @var \ImetCore\Models\Imet\v1\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.show', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
