<?php

namespace ImetCore\Controllers\Imet\oecm;

use ImetCore\Controllers\Imet\EvalController as BaseEvalController;
use ImetCore\Models\Imet\oecm\Imet_Eval;

class EvalController extends BaseEvalController
{
    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::oecm.evaluation';

}