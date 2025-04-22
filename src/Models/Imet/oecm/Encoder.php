<?php

namespace ImetCore\Models\Imet\oecm;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Encoder as BaseEncoder;

class Encoder extends BaseEncoder
{
    protected string $schema = Database::OECM_SCHEMA;
    protected $table = 'imet_encoders';
}
