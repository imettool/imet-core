<?php

namespace ImetCore\Controllers\Imet\oecm;

use ImetCore\Controllers\Imet\Controller as BaseController;
use ImetCore\Controllers\Imet\Traits\CreateAndStoreNonWdpa;
use ImetCore\Controllers\Imet\Traits\Prefill;
use ImetCore\Models\Imet\oecm\Imet;
use ImetCore\Models\Imet\oecm\Modules\Context\GeneralInfo;
use ImetCore\Models\ProtectedAreaNonWdpa;
use ModularForms\Helpers\Input\SelectionList;
use ModularForms\Models\Traits\Payload;

class Controller extends BaseController
{
    use Prefill;
    use CreateAndStoreNonWdpa;

    public const ROUTE_PREFIX = 'imet-core::oecm.';

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::oecm';

}
