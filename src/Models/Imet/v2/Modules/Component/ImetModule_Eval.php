<?php

namespace ImetCore\Models\Imet\v2\Modules\Component;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Modules\ImetModule_Eval as BaseImetEvalModule;
use ImetCore\Models\Imet\Components\Upgrade;
use ImetCore\Models\Imet\v2\Imet;


class ImetModule_Eval extends BaseImetEvalModule
{
    use Upgrade;

    protected string $schema = Database::IMET_SCHEMA;

    protected static $form_class = Imet::class;
}
