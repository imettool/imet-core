<?php

/** @var \ImetCore\Controllers\Imet\v1\EvalController $controller */
/** @var \ImetCore\Models\Imet\v1\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.show', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
