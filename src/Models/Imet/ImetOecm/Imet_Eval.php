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

namespace ImetCore\Models\Imet\ImetOecm;

use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\AchievedObjectives;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\AdministrativeManagement;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\AssistanceActivities;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\BoundaryLevel;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\BudgetAdequacy;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\BudgetSecurization;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\CapacityAdequacy;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\DesignAdequacy;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\Designation;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\EmpowermentGovernance;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\EnvironmentalEducation;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\EquipmentMaintenance;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\HRmanagementPolitics;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\InformationAvailability;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\KeyElements;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\KeyElementsImpact;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\LawEnforcementImplementation;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\LifeQualityImpact;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ManagementActivities;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ManagementEquipmentAdequacy;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ManagementGovernance;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ManagementPlan;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\NaturalResourcesMonitoring;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\Objectives;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ObjectivesContext;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ObjectivesIntrants;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ObjectivesPlanification;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ObjectivesProcessus;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\RegulationsAdequacy;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\StaffCompetence;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\StakeholderCooperation;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\SupportsAndConstraints;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\SupportsAndConstraintsIntegration;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\Threats;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ThreatsBiodiversity;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ThreatsIntegration;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\VisitorsManagement;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\WorkPlan;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\WorkProgramImplementation;

class Imet_Eval extends Imet
{
    public static ?array $modules = [
        'context' => [
            Designation::class,
            SupportsAndConstraints::class,
            SupportsAndConstraintsIntegration::class,
            ThreatsBiodiversity::class,
            Threats::class,             // histogram
            //   + score scale from -100 to 0
            ThreatsIntegration::class,  // sort ranking
            KeyElements::class,         // Formula: DONE
            ObjectivesContext::class,
        ],
        'planning' => [
            RegulationsAdequacy::class,
            DesignAdequacy::class,
            BoundaryLevel::class,
            ManagementPlan::class,
            WorkPlan::class,
            Objectives::class,
            ObjectivesPlanification::class,
        ],
        'inputs' => [
            InformationAvailability::class,
            CapacityAdequacy::class,
            BudgetAdequacy::class,
            BudgetSecurization::class,
            ManagementEquipmentAdequacy::class,
            ObjectivesIntrants::class,
        ],
        'process' => [
            StaffCompetence::class,
            HRmanagementPolitics::class,
            EmpowermentGovernance::class,
            AdministrativeManagement::class,
            EquipmentMaintenance::class,
            ManagementActivities::class,
            NaturalResourcesMonitoring::class,
            LawEnforcementImplementation::class,
            StakeholderCooperation::class,
            AssistanceActivities::class,
            EnvironmentalEducation::class,
            VisitorsManagement::class,
            ObjectivesProcessus::class,

        ],
        'outputs' => [
            WorkProgramImplementation::class,
            ManagementGovernance::class,
        ],
        'outcomes' => [
            AchievedObjectives::class,
            KeyElementsImpact::class,       // No formula yet
            LifeQualityImpact::class,
        ],
        'objectives' => [
            ObjectivesContext::class,
            ObjectivesPlanification::class,
            ObjectivesIntrants::class,
            ObjectivesProcessus::class,

        ],
        'management_effectiveness' => [],
    ];
}
