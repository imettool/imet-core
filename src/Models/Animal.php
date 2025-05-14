<?php

namespace ImetCore\Models;

use ImetCore\Helpers\Database;
use ModularForms\Models\Utils\Animal as BaseAnimal;

class Animal extends BaseAnimal
{
    protected string $schema = Database::COMMON_SCHEMA;
    protected $table = 'species';
    protected $primaryKey = 'id';

    /**
     * Override: get the table name with schema
     */
    public function getTable(): string
    {
        return Database::getTable($this->schema, $this->table);
    }

    public static function getScientificName($taxonomy): ?string {
        $sciName = null;
        if ($taxonomy !== null) {
            $taxonomy_array = explode('|', $taxonomy);
            $sciName = $taxonomy_array[4] . ' ' . $taxonomy_array[5];
        }
        return $sciName;
    }

    public static function getPlainNameByTaxonomy($taxonomy): ?string {
        return $taxonomy != null && static::isTaxonomy($taxonomy)
            ? static::getScientificName($taxonomy)
            : $taxonomy;
    }
}
