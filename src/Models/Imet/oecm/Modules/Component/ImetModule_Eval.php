<?php

namespace ImetCore\Models\Imet\oecm\Modules\Component;


use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Dependencies;
use ImetCore\Models\Imet\Components\Modules\ImetModule_Eval as BaseImetEvalModule;
use ImetCore\Models\Imet\Components\Upgrade;
use ImetCore\Models\Imet\oecm\Imet;

class ImetModule_Eval extends BaseImetEvalModule
{
    use Upgrade;
    use Dependencies;

    public const MODULE_SCOPE = null;

    protected string $schema = Database::OECM_SCHEMA;

    protected static $form_class = Imet::class;

}
