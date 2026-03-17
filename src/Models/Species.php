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

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\BaseModel;
use ModularForms\Helpers\Locale;

/**
 * @property string $phylum
 * @property string $class
 * @property string $order
 * @property string $family
 * @property string $genus
 * @property string $species
 * @property string $binomial
 */
class Species extends BaseModel
{
    protected static ?string $schema = Database::COMMON_SCHEMA;

    protected $table = 'species';

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * Get the country's name attribute according to the current locale
     */
    protected function binomial(): Attribute
    {
        return Attribute::make(
            get: fn () => array_key_exists('genus', $this->attributes) && array_key_exists('species', $this->attributes)
                ? $this->attributes['genus'].' '.$this->attributes['species']
                : null
        );
    }

    public static function getScientificName($taxonomy): ?string
    {
        $sciName = null;
        if ($taxonomy !== null) {
            $taxonomy_array = explode('|', $taxonomy);
            $sciName = $taxonomy_array[4].' '.$taxonomy_array[5];
        }

        return $sciName;
    }

    public static function getPlainNameByTaxonomy($taxonomy): ?string
    {
        return $taxonomy != null && self::isTaxonomy($taxonomy)
            ? self::getScientificName($taxonomy)
            : $taxonomy;
    }

    /**
     * Search Species by given string
     */
    public static function searchSpecies(string $search_key): Collection
    {
        // Query the database for species matching the search key
        $species = self::query()
            ->whereLike('phylum', $search_key.'%')
            ->orWhereLike('class', $search_key.'%')
            ->orWhereLike('order', $search_key.'%')
            ->orWhereLike('family', $search_key.'%')
            ->orWhereLike('genus', $search_key.'%')
            ->orWhereLike('species', $search_key.'%')
            ->orWhereLike('vernacular_names_eng', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_spa', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_por', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_fra', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_rus', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_deu', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_ita', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_jpn', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_zho', '%'.$search_key.'%')
            ->orWhereLike('vernacular_names_kor', '%'.$search_key.'%')
            ->orderBy('phylum')
            ->orderBy('class')
            ->orderBy('order')
            ->orderBy('family')
            ->orderBy('genus')
            ->orderBy('species')
            ->limit(299)
            ->get();

        // Sort by Levenshtein distance
        $species = self::sortByLevenshteinDistance($species, $search_key);

        return $species;
    }

    /**
     * Calculate Levenshtein distance for each species
     */
    private static function sortByLevenshteinDistance(Collection $collection, string $search_key): Collection
    {
        return $collection
            ->map(function ($item) use ($search_key): \Illuminate\Database\Eloquent\Model {
                $item['__levenshtein'] = max(
                    $item['phylum'] !== null ? levenshtein($item['phylum'], $search_key) : 0,
                    $item['class'] !== null ? levenshtein($item['class'], $search_key) : 0,
                    $item['order'] !== null ? levenshtein($item['order'], $search_key) : 0,
                    $item['family'] !== null ? levenshtein($item['family'], $search_key) : 0,
                    $item['genus'] !== null ? levenshtein($item['genus'], $search_key) : 0,
                    $item['species'] !== null ? levenshtein($item['species'], $search_key) : 0,
                    $item['vernacular_names_eng'] !== null ? levenshtein($item['vernacular_names_eng'], $search_key) : 0,
                    $item['vernacular_names_spa'] !== null ? levenshtein($item['vernacular_names_spa'], $search_key) : 0,
                    $item['vernacular_names_por'] !== null ? levenshtein($item['vernacular_names_por'], $search_key) : 0,
                    $item['vernacular_names_fra'] !== null ? levenshtein($item['vernacular_names_fra'], $search_key) : 0,
                    $item['vernacular_names_rus'] !== null ? levenshtein($item['vernacular_names_rus'], $search_key) : 0,
                    $item['vernacular_names_deu'] !== null ? levenshtein($item['vernacular_names_deu'], $search_key) : 0,
                    $item['vernacular_names_ita'] !== null ? levenshtein($item['vernacular_names_ita'], $search_key) : 0,
                    $item['vernacular_names_jpn'] !== null ? levenshtein($item['vernacular_names_jpn'], $search_key) : 0,
                    $item['vernacular_names_zho'] !== null ? levenshtein($item['vernacular_names_zho'], $search_key) : 0,
                    $item['vernacular_names_kor'] !== null ? levenshtein($item['vernacular_names_kor'], $search_key) : 0,
                );

                return $item;
            })
            ->sortBy('__levenshtein');
    }

    /**
     * Retrieve species by taxonomy
     */
    public static function getByTaxonomy(?string $taxonomy = null, string $separator = '|'): Species
    {
        return self::isTaxonomy($taxonomy)
            ? (self::query()->where(self::parseTaxonomy($taxonomy, $separator))
                ->first() ?? new self)
            : new self;
    }

    /**
     * Check if the given string contains taxonomy (parts divided by |)
     */
    public static function isTaxonomy(?string $taxonomy = null): bool
    {
        return $taxonomy !== null && substr_count($taxonomy, '|') === 5;
    }

    /**
     * Parse a taxonomy string (all ranking from phylum to species in a single string)
     *
     * @phpstan-return array<string, string>
     */
    public static function parseTaxonomy(string $taxonomy, string $separator = '|'): array
    {
        if (self::isTaxonomy($taxonomy)) {
            $taxonomy_array = explode($separator, $taxonomy);

            return [
                'phylum' => $taxonomy_array[0],
                'class' => $taxonomy_array[1],
                'order' => $taxonomy_array[2],
                'family' => $taxonomy_array[3],
                'genus' => $taxonomy_array[4],
                'species' => $taxonomy_array[5],
            ];
        }

        return [];
    }

    /**
     * Get the vernacular names according to the current locale
     *
     * @return array<string, string>
     */
    public function getVernacularNames(): array
    {
        $locale = Locale::lower();
        $mapped_languages = ['eng'];
        if($locale === 'sp'){
            $mapped_languages = ['spa', 'eng'];
        } else if($locale === 'pt'){
            $mapped_languages = ['por', 'eng'];
        } else if($locale === 'fr'){
            $mapped_languages = ['fra', 'eng'];
        }

        $vernacular_names = [];
        foreach ($mapped_languages as $lang) {
            $vernacular_name = $this->{'vernacular_names_'.$lang} ?? null;
            if ($vernacular_name) {
                $vernacular_names[] = $vernacular_name;
            }
        }

        return $vernacular_names;
    }

    public static function getPreview(?string $taxonomy): string
    {
        if($taxonomy!==null && Species::isTaxonomy($taxonomy)){
            $species = Species::getByTaxonomy($taxonomy);
            $scientific_name = $species->genus . ' ' . $species->species;
            $vernacular_names = implode(', ', $species->getVernacularNames());
            $label = '<div class="font-bold">'.$scientific_name.'</div>';
            if($vernacular_names){
                $label .= '<div class="italic">'.$vernacular_names.'</div>';
            }
            return $label;
        }

        return '';
    }


}
