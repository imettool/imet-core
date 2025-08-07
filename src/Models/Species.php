<?php
/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Models;

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Helpers\Database;
use ModularForms\Helpers\Type\Chars;
use ModularForms\Models\Utils\Animal;

class Species extends Animal
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

    /**
     * Filter a collection to search by string: Replacement for PostgreSQL unaccent() function
     */
    public static function filterBySearchString(Collection $collection, string $search_key): Collection
    {
        return $collection
            ->filter(function($item) use ($search_key){
                return Chars::case_and_accent_insensitive_contains($item['phylum'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['class'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['order'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['family'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['genus'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['species'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_eng'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_spa'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_por'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_fra'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_rus'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_deu'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_ita'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_jpn'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_zho'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['vernacular_names_kor'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['common_name_sp'], $search_key);
            });
    }
    
}
