<?php

namespace ImetCore\Models\Imet\oecm\Modules\Context;

use ImetCore\Models\User\Role;
use ImetCore\Models\Imet\oecm\Modules;

class Objectives3 extends _Objectives
{
    protected $table = 'context_objectives3';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 3.4';
        $this->module_info = trans('imet-core::oecm_context.Objectives3.module_info');

        parent::__construct($attributes);

    }
}
