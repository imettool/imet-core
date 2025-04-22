<?php

namespace ImetCore\Models\Imet\oecm\Modules\Evaluation;


use ImetCore\Models\Imet\oecm\Modules\Context\_Objectives;
use ImetCore\Models\User\Role;

class ObjectivesContext extends _Objectives
{
    protected $table = 'eval_objectives_context';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'CX';
        $this->module_info = trans('imet-core::oecm_evaluation.ObjectivesContext.module_info');

        parent::__construct($attributes);
    }
}
