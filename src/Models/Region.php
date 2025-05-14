<?php

namespace ImetCore\Models;

use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 *
 *
 * @package ImetCore\Models
 */
class Region extends BaseModel
{
    protected string $schema = Database::COMMON_SCHEMA;
    protected $table = 'regions';
    protected $keyType = 'string';

}
