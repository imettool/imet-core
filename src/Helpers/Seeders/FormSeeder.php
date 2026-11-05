<?php

/*
 * Copyright (C) 2026 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

declare(strict_types=1);

namespace ImetCore\Helpers\Seeders;

use Illuminate\Support\Facades\App;
use ImetCore\Models\Imet;
use ImetCore\Models\ProtectedArea;
use ModularForms\Seeders\FieldFaker;
use ModularForms\Seeders\FormSeeder as BaseFormSeeder;
use Override;
use Throwable;

class FormSeeder extends BaseFormSeeder
{
    const int NUM_FORMS = 5;

    /**
     * Form classes sharing the same form row, by IMET version
     *
     * @var array<string, array{0: class-string<Imet\Imet>, 1: class-string<Imet\Imet>}>
     */
    private const array FORM_CLASSES = [
        Imet\Imet::IMET_V1 => [Imet\ImetV1\Imet::class, Imet\ImetV1\Imet_Eval::class],
        Imet\Imet::IMET_V2 => [Imet\ImetV2\Imet::class, Imet\ImetV2\Imet_Eval::class],
        Imet\Imet::IMET_OECM => [Imet\ImetOecm\Imet::class, Imet\ImetOecm\Imet_Eval::class],
    ];

    private string $version;

    private string $language;

    private ProtectedArea $protectedArea;

    public function __construct(?FieldFaker $fieldFaker = null)
    {
        parent::__construct($fieldFaker ?? new ImetFieldFaker);
    }

    /**
     * Run the database seeders.
     *
     * @throws Throwable
     */
    public function run(string $version, ?int $num = self::NUM_FORMS): void
    {
        for ($i = 1; $i <= $num; $i++) {
            $this->language = collect(['en', 'fr', 'sp', 'pt'])->random();
            $this->protectedArea = ProtectedArea::query()->inRandomOrder()->first();
            App::setLocale($this->language);
            if (array_key_exists($version, self::FORM_CLASSES)) {
                $this->version = $version;
                $this->seedForm();
            }
        }
    }

    /**
     * Create a new form for the current protected area
     */
    #[Override]
    protected function createForm(): int
    {
        $form_class = self::FORM_CLASSES[$this->version][0];

        return $form_class::query()->insertGetId([
            'Country' => $this->protectedArea->country,
            'Year' => fake()->dateTimeBetween('-4 years')->format('Y'),
            'version' => $form_class::$version,
            'language' => $this->language,
            'wdpa_id' => $this->protectedArea->wdpa_id,
            'name' => $this->protectedArea->name,
            'UpdateDate' => now()->toDateTimeString(),
            'UpdateBy' => 0,
        ]);
    }

    /**
     * Modules of the context and evaluation forms
     */
    #[Override]
    protected function modules(): array
    {
        [$form_class, $eval_class] = self::FORM_CLASSES[$this->version];

        return array_merge(
            $form_class::allModules(),
            $eval_class::allModules()
        );
    }

    /**
     * IMET: force IncludeInStatistics to true
     */
    #[Override]
    protected function mutateRecord(array $record, string $module, int $formId): array
    {
        if (array_key_exists('IncludeInStatistics', $record)) {
            $record['IncludeInStatistics'] = '1';
        }

        return $record;
    }
}
