<?php

namespace ImetCore\Models\Imet\v2;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Report as BaseReport;
class Report extends BaseReport
{
    protected string $schema = Database::IMET_SCHEMA;
    protected $table = 'imet_report';
}
