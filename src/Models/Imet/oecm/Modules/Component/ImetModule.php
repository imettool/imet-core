<?php

namespace ImetCore\Models\Imet\oecm\Modules\Component;


use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Modules\ImetModule as BaseImetModule;
use ImetCore\Models\Imet\Components\Upgrade;
use ImetCore\Models\Imet\oecm\Imet;


class ImetModule extends BaseImetModule
{
    use Upgrade;

    public const MODULE_SCOPE = null;

    protected string $schema = Database::OECM_SCHEMA;

    protected static $form_class = Imet::class;

}
