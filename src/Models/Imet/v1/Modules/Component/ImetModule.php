<?php

namespace ImetCore\Models\Imet\v1\Modules\Component;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Modules\ImetModule as BaseImetModule;
use ImetCore\Models\Imet\Components\Upgrade;
use ImetCore\Models\Imet\v1\Imet;


class ImetModule extends BaseImetModule
{
    use Upgrade;
    use ConvertSQLite;

    protected string $schema = Database::IMET_SCHEMA;

    protected static $form_class = Imet::class;
}
