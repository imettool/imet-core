<?php

namespace ImetCore\Controllers\Imet\v1;

use ImetCore\Controllers\Imet\EvalController as BaseEvalController;
use ImetCore\Models\Imet\v1\Imet_Eval;


class EvalController extends BaseEvalController
{
    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v1.evaluation';

}
