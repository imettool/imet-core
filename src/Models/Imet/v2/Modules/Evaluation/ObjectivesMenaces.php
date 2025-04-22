<?php

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;


use ImetCore\Models\User\Role;

class ObjectivesMenaces extends _Objectives
{
    protected $table = 'eval_objectives_c3';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'CX3';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesMenaces.module_info');

        parent::__construct($attributes);
    }
}
