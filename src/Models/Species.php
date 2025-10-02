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
use ModularForms\Models\Utils\Animal;

class Species extends Animal
{
    protected static ?string $schema = Database::COMMON_SCHEMA;
    protected $table = 'species';
    protected $primaryKey = 'id';

    /**
     * Override: get the table name with schema
     */
    #[\Override]
    public function getTable(): string
    {
        return Database::getTable(static::$schema, $this->table);
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
     * Search Species by given string
     */
    #[\Override]
    public static function searchSpecies(string $search_key): Collection
    {
        // Query the database for species matching the search key
        $species = static::query()
            ->whereLike('phylum',  $search_key . '%')
            ->orWhereLike('class', $search_key . '%')
            ->orWhereLike('order', $search_key . '%')
            ->orWhereLike('family', $search_key . '%')
            ->orWhereLike('genus', $search_key . '%')
            ->orWhereLike('species', $search_key . '%')
            ->orWhereLike('vernacular_names_eng', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_spa', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_por', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_fra', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_rus', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_deu', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_ita', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_jpn', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_zho', '%' . $search_key . '%')
            ->orWhereLike('vernacular_names_kor', '%' . $search_key . '%')
            ->orderBy('phylum')
            ->orderBy('class')
            ->orderBy('order')
            ->orderBy('family')
            ->orderBy('genus')
            ->orderBy('species')
            ->limit(299)
            ->get();

        // Sort by Levenshtein distance
        $species =  static::sortByLevenshteinDistance($species, $search_key);

        return $species;
    }

    /**
     * Calculate Levenshtein distance for each species
     */
    private static function sortByLevenshteinDistance(Collection $collection, string $search_key): Collection
    {
        return $collection
            ->map(function ($item) use($search_key) {
                $item['__levenshtein'] = max(
                    $item['phylum']!==null ? levenshtein($item['phylum'], $search_key) : 0,
                    $item['class']!==null ? levenshtein($item['class'], $search_key) : 0,
                    $item['order']!==null ? levenshtein($item['order'], $search_key) : 0,
                    $item['family']!==null ? levenshtein($item['family'], $search_key) : 0,
                    $item['genus']!==null ? levenshtein($item['genus'], $search_key) : 0,
                    $item['species']!==null ? levenshtein($item['species'], $search_key) : 0,
                    $item['vernacular_names_eng']!== null ? levenshtein($item['vernacular_names_eng'], $search_key) : 0,
                    $item['vernacular_names_spa']!== null ? levenshtein($item['vernacular_names_spa'], $search_key) : 0,
                    $item['vernacular_names_por']!== null ? levenshtein($item['vernacular_names_por'], $search_key) : 0,
                    $item['vernacular_names_fra']!== null ? levenshtein($item['vernacular_names_fra'], $search_key) : 0,
                    $item['vernacular_names_rus']!== null ? levenshtein($item['vernacular_names_rus'], $search_key) : 0,
                    $item['vernacular_names_deu']!== null ? levenshtein($item['vernacular_names_deu'], $search_key) : 0,
                    $item['vernacular_names_ita']!== null ? levenshtein($item['vernacular_names_ita'], $search_key) : 0,
                    $item['vernacular_names_jpn']!== null ? levenshtein($item['vernacular_names_jpn'], $search_key) : 0,
                    $item['vernacular_names_zho']!== null ? levenshtein($item['vernacular_names_zho'], $search_key) : 0,
                    $item['vernacular_names_kor']!== null ? levenshtein($item['vernacular_names_kor'], $search_key) : 0,
                );
                return $item;
            })
            ->sortBy('__levenshtein');
    }

}
