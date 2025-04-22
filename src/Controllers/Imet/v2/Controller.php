<?php

namespace ImetCore\Controllers\Imet\v2;

use ImetCore\Controllers\Imet\Controller as BaseController;
use ImetCore\Controllers\Imet\Traits\CreateAndStoreNonWdpa;
use ImetCore\Controllers\Imet\Traits\Prefill;
use ImetCore\Models\Imet\v2\Imet;

class Controller extends BaseController
{
    use Prefill;
    use CreateAndStoreNonWdpa;

    public const ROUTE_PREFIX = 'imet-core::v2.';

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v2';

}
