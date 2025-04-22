<?php

namespace ImetCore\Models\Imet\oecm\Modules\Evaluation;

use \ImetCore\Models\Imet\oecm\Modules\Context\_Objectives;
use ImetCore\Models\User\Role;

class ObjectivesIntrants extends _Objectives
{
    protected $table = 'eval_objectives_intrants';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'IX';
        $this->module_info = trans('imet-core::oecm_evaluation.ObjectivesIntrants.module_info');

        parent::__construct($attributes);
    }
}
