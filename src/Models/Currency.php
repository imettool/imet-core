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

use ImetCore\Helpers\Database;
use ModularForms\Models\Utils\Currency as BaseCurrency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class Currency
 *
 * @property string $iso
 * @property string $name_fr
 * @property string $name_en
 * @property string $name_sp
 *
 * @package ImetCore\Models
 */
class Currency extends BaseCurrency
{
    protected static ?string $schema = Database::COMMON_SCHEMA;
    protected $table = 'currencies';
    protected $primaryKey = 'iso';

    /**
     * Override: get the table name with schema
     */
    #[\Override]
    public function getTable(): string
    {
        return Database::getTable(static::$schema, $this->table);
    }

    /**
     * Override: get locale of IMET form
     */
    public static function imetV1List(string $type = 'PAIRS', ?Collection $collection = null, array $fields = []): array
    {
        $lang = App::getLocale() ?? Config::get('app.locale');
        return parent::selectionList('FIELDS', $collection, ['name_'.$lang, 'iso3']);
    }

}
