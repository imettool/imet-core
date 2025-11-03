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

namespace ImetCore\Models\Imet\v1;

use Illuminate\Database\Eloquent\Relations\HasMany;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Imet as BaseImetForm;
use ImetCore\Models\Imet\v1\Modules\Context\ResponsablesInterviewees;
use ImetCore\Models\Imet\v1\Modules\Context\ResponsablesInterviewers;

class Imet extends BaseImetForm
{
    public static string $version = 'v1';

    protected static ?string $schema = Database::IMET_SCHEMA;

    protected $table = 'forms';

    public static ?array $modules = [

        'general_info' => [
            Modules\Context\ResponsablesInterviewers::class,
            Modules\Context\ResponsablesInterviewees::class,
            Modules\Context\GeneralInfo::class,
            Modules\Context\Governance::class,
            Modules\Context\SpecialStatus::class,
            Modules\Context\Networks::class,
            Modules\Context\Missions::class,
            Modules\Context\Contexts::class,
            Modules\Context\Objectives1::class,
        ],
        'areas' => [
            Modules\Context\GeographicalLocation::class,
            Modules\Context\Areas::class,
            Modules\Context\ControlLevel::class,
            Modules\Context\Sectors::class,
            Modules\Context\TerritorialReferenceContext::class,
            Modules\Context\Objectives2::class,
        ],
        'resources' => [
            Modules\Context\ManagementStaff::class,
            Modules\Context\ManagementStaffPartners::class,
            Modules\Context\ManagementStaffCommunities::class,
            Modules\Context\FinancialResources::class,
            Modules\Context\FinancialAvailableResources::class,
            Modules\Context\FinancialResourcesBudgetLines::class,
            Modules\Context\FinancialResourcesPartners::class,
            Modules\Context\Equipments::class,
            Modules\Context\Objectives3::class,
        ],
        'key_elements' => [
            Modules\Context\AnimalSpecies::class,
            Modules\Context\VegetalSpecies::class,
            Modules\Context\Habitats::class,
            Modules\Context\HabitatsMarine::class,
            Modules\Context\LandCover::class,
            Modules\Context\NonSustainableUsage::class,
            Modules\Context\Objectives4::class,
        ],
        'threats' => [
            Modules\Context\MenacesPressions::class,
            Modules\Context\Objectives5::class,
        ],
        'climate' => [
            Modules\Context\ClimateChangeImportanceElements::class,
            Modules\Context\ClimateChange::class,
            Modules\Context\Objectives6::class,
        ],
        'ecosystem_services' => [
            Modules\Context\EcosystemServices::class,
            Modules\Context\EcosystemServicesTendance::class,
            Modules\Context\Objectives7::class,
        ],
        'objectives' => [
            Modules\Context\Objectives1::class,
            Modules\Context\Objectives2::class,
            Modules\Context\Objectives3::class,
            Modules\Context\Objectives4::class,
            Modules\Context\Objectives5::class,
            Modules\Context\Objectives6::class,
            Modules\Context\Objectives7::class,
        ],
    ];

    /**
     * Relation to Encoder (only name)
     */
    public function encoder(): HasMany
    {
        return $this->hasMany(Encoder::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'first_name', 'last_name']);
    }

    /**
     * Relation to ResponsablesInterviewees
     */
    public function responsible_interviewees(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewees::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'Name']);
    }

    /**
     * Relation to ResponsablesInterviewers
     */
    public function responsible_interviewers(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewers::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'Name']);
    }
}
