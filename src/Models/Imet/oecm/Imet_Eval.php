<?php

namespace ImetCore\Models\Imet\oecm;

use ImetCore\Models\Imet\oecm\Modules\Evaluation\AchievedObjectives;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\AdministrativeManagement;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\AssistanceActivities;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\BoundaryLevel;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\BudgetAdequacy;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\BudgetSecurization;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\CapacityAdequacy;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElementsImpact;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\DesignAdequacy;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\InformationAvailability;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementEquipmentAdequacy;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\EmpowermentGovernance;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\EnvironmentalEducation;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\EquipmentMaintenance;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\LawEnforcementImplementation;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\LifeQualityImpact;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementActivities;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementGovernance;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementPlan;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\NaturalResourcesMonitoring;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\Objectives;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesContext;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesIntrants;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesPlanification;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesProcessus;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\RegulationsAdequacy;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\StakeholderCooperation;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraintsIntegration;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\Threats;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ThreatsBiodiversity;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\ThreatsIntegration;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\VisitorsManagement;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkPlan;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\StaffCompetence;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\HRmanagementPolitics;
use ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkProgramImplementation;

class Imet_Eval extends Imet
{

    public static $modules = [
        'context' => [
            Designation::class,
            SupportsAndConstraints::class,
            SupportsAndConstraintsIntegration::class,
            ThreatsBiodiversity::class,
            Threats::class,             // histogram
                                        //   + score scale from -100 to 0
            ThreatsIntegration::class,  // sort ranking
            KeyElements::class,         // Formula: DONE
            ObjectivesContext::class
        ],
        'planning' => [
            RegulationsAdequacy::class,
            DesignAdequacy::class,
            BoundaryLevel::class,
            ManagementPlan::class,
            WorkPlan::class,
            Objectives::class,
            ObjectivesPlanification::class
        ],
        'inputs' => [
            InformationAvailability::class,
            CapacityAdequacy::class,
            BudgetAdequacy::class,
            BudgetSecurization::class,
            ManagementEquipmentAdequacy::class,
            ObjectivesIntrants::class
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
            ManagementGovernance::class
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
