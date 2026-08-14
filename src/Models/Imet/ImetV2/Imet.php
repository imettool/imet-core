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

namespace ImetCore\Models\Imet\ImetV2;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ImetCore\Controllers\Imet\ImetV2\Controller;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Imet as BaseImetForm;
use ImetCore\Models\Imet\ImetV2\Modules\Context\FinancialAvailableResources;
use ImetCore\Models\Imet\ImetV2\Modules\Context\FinancialResourcesBudgetLines;
use ImetCore\Models\Imet\ImetV2\Modules\Context\FinancialResourcesPartners;
use ImetCore\Models\Imet\ImetV2\Modules\Context\Habitats;
use ImetCore\Models\Imet\ImetV2\Modules\Context\ResponsablesInterviewees;
use ImetCore\Models\Imet\ImetV2\Modules\Context\ResponsablesInterviewers;
use ImetCore\Models\Imet\ImetV2\Modules\Context\TerritorialReferenceContext;
use ImetCore\Services\Scores\ImetScores;

class Imet extends BaseImetForm
{
    public static string $version = 'v2';

    protected static ?string $schema = Database::IMET_SCHEMA;

    protected $table = 'forms';

    public static ?array $modules = [

        'general_info' => [
            ResponsablesInterviewers::class,
            ResponsablesInterviewees::class,
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
            Modules\Context\Sectors::class,
            TerritorialReferenceContext::class,
            Modules\Context\Connectivity::class,
            Modules\Context\Spillover::class,
            Modules\Context\Objectives2::class,
        ],
        'resources' => [
            Modules\Context\ManagementStaff::class,
            Modules\Context\ManagementStaffPartners::class,
            Modules\Context\ManagementStaffCommunities::class,
            Modules\Context\FinancialResources::class,
            FinancialAvailableResources::class,
            FinancialResourcesBudgetLines::class,
            FinancialResourcesPartners::class,
            Modules\Context\Equipments::class,
            Modules\Context\Objectives3::class,
        ],
        'key_elements' => [
            Modules\Context\AnimalSpecies::class,
            Modules\Context\VegetalSpecies::class,
            Habitats::class,
            Modules\Context\Objectives4::class,
        ],
        'threats' => [
            Modules\Context\MenacesPressions::class,
            Modules\Context\Objectives5::class,
        ],
        'climate' => [
            Modules\Context\ClimateChange::class,
            Modules\Context\Objectives6::class,
        ],
        'ecosystem_services' => [
            Modules\Context\EcosystemServices::class,
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
     *
     * @return HasMany<Encoder, Imet>
     */
    public function encoder(): HasMany
    {
        return $this->hasMany(Encoder::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'first_name', 'last_name']);
    }

    /**
     * Relation to ResponsablesInterviewees
     *
     * @return HasMany<ResponsablesInterviewees, Imet>
     */
    public function responsible_interviewees(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewees::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'Name']);
    }

    /**
     * Relation to ResponsablesInterviewers
     *
     * @return HasMany<ResponsablesInterviewers, Imet>
     */
    public function responsible_interviewers(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewers::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'Name']);
    }

    /**
     * Get IMET available years for the given PA
     *
     * @return Imet[]|Collection
     */
    public static function getYears($wdpa_id)
    {
        return (new static)
            ->where('wdpa_id', $wdpa_id)
            ->orderBy('Year', 'DESC')
            ->get();
    }

    /**
     * Extent parent method: save user as encoder
     *
     * @throws \Exception
     */
    #[\Override]
    public static function updateModuleAndForm(int $item, Request $request): array
    {
        $return = parent::updateModuleAndForm($item, $request);

        // backup to JSON
        if ($return['status'] == 'success') {
            (new Controller)->backup($item, Imet::$version);
        }

        // Update encoder UPDATED_AT
        $user_info = Auth::user()->getInfo();
        unset($user_info['country']);
        Encoder::touchOnFormUpdate($item, $user_info);

        // Refresh scores
        ImetScores::refresh_scores($item);

        return $return;
    }

    /**
     * Override: apply changes
     */
    #[\Override]
    public static function upgradeModules(array $data, $imet_version = null): array
    {
        if (array_key_exists('FinancialResources', $data)) {
            $data = FinancialAvailableResources::copyCurrencyFromCTX213($data);
            $data = FinancialResourcesBudgetLines::copyCurrencyFromCTX213($data);
            $data = FinancialResourcesPartners::copyCurrencyFromCTX213($data);
        }

        // #### v2.7 -> v2.8 (marine pas): merge CTX 4.3.1, 4.3.2, 4.4 into 4.3 ####
        $data = Habitats::mergeFromCTX432($data);
        $data = Habitats::mergeFromCTX44($data);

        // #### v3.0.0-rc.41 -> v3.0.0-rc.42: move connectivity from CTX2.5 to dedicated module ####
        $data = TerritorialReferenceContext::splitConnectivity($data);

        return parent::upgradeModules($data, $imet_version);
    }
}
