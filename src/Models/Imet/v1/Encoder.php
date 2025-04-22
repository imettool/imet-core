<?php

namespace ImetCore\Models\Imet\v1;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Encoder as BaseEncoder;

class Encoder extends BaseEncoder
{
    protected string $schema = Database::IMET_SCHEMA;
    protected $table = 'imet_encoders';
}
