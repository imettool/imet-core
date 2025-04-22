<?php

namespace ImetCore\Controllers\Imet\v1;


use ImetCore\Controllers\Imet\Controller as BaseController;
use ImetCore\Models\Imet\v1\Imet;

class Controller extends BaseController
{
    public const ROUTE_PREFIX = 'imet-core::v1.';

    protected static $form_view_prefix = 'imet-core::v1';
    protected static $form_class = Imet::class;

}