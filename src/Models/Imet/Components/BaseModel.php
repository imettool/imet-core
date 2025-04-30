<?php

namespace ImetCore\Models\Imet\Components;

use ImetCore\Helpers\Database;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected string $schema;

    /**
     * Override: get the table name with schema
     */
    public function getTable(): string
    {
        return Database::getTable($this->schema, $this->table);
    }
}