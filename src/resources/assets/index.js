/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

// Global variables - make them accessible from modules and from blade views
window.Laravel = window.Laravel || {};
window.ImetCore = {};

// ############################################
// ##########  Helpers & Components  ##########
// ############################################
window.ImetCore.Helpers = {};
window.ImetCore.Components = {};

// ############################################
// ##################  Apps  ##################
// ############################################
window.ImetCore.Apps = {};

import BaseImet from "./js/apps/Base.js"; // Extend Base from ModularForms
window.ImetCore.Apps.Base = BaseImet;

import FormListImet from "./js/apps/FormList.js";  // Extend FormList from ModularForms
window.ImetCore.Apps.FormList = FormListImet;

import ModuleImet from "./js/apps/Module.js";  // Extend FormList from ModularForms
window.ImetCore.Apps.Module = ModuleImet;

import AssessmentScores from "./js/apps/AssessmentScores.js";
window.ImetCore.Apps.AssessmentScores = AssessmentScores;

import ScalingList from "./js/scaling_up_analysis/ScalingList.js";
window.ImetCore.Apps.ScalingList = ScalingList;

import Report from "./js/scaling_up_analysis/Report.js";
window.ImetCore.Apps.Report = Report;

import Preview from "./js/scaling_up_analysis/Preview.js";
window.ImetCore.Apps.Preview = Preview;

import V1Analysis from "./js/apps/Modules/ImetV1/Analysis.js";
window.ImetCore.Apps.V1Analysis = V1Analysis;

import OECMAnalysis from "./js/apps/Modules/Oecm/OECMAnalysis.js";
window.ImetCore.Apps.OECMAnalysis = OECMAnalysis;

import ExportApp from "./js/apps/Export.js";
window.ImetCore.Apps.ExportApp = ExportApp;

// ############################################
// #############  Custom Modules  #############
// ############################################
window.ImetCore.Apps.Modules = {
    ImetV1: {
        context: {},
        evaluation: {}
    },
    ImetV2: {
        context: {},
        evaluation: {},
        report: {}
    },
    Oecm: {
        context: {},
        evaluation: {}
    }
}

import Create from "./js/apps/Modules/ImetV2/Create";
window.ImetCore.Apps.Modules.ImetV2.Create = Create;

import CreateNonWDPA from "./js/apps/Modules/ImetV2/CreateNonWDPA";
window.ImetCore.Apps.Modules.ImetV2.CreateNonWDPA = CreateNonWDPA;

import CreateOecm from "./js/apps/Modules/ImetV2/Create";
window.ImetCore.Apps.Modules.Oecm.Create = CreateOecm;

import CreateNonWDPAOecm from "./js/apps/Modules/ImetV2/CreateNonWDPA";
window.ImetCore.Apps.Modules.Oecm.CreateNonWDPA = CreateNonWDPAOecm;

// ##### ImetV1 - context #####

import {default as AreasV1} from "./js/apps/Modules/ImetV1/context/Areas";
window.ImetCore.Apps.Modules.ImetV1.context.Areas = AreasV1;

import ControlLevel from "./js/apps/Modules/ImetV1/context/ControlLevel";
window.ImetCore.Apps.Modules.ImetV1.context.ControlLevel = ControlLevel;

import {default as ManagementStaffV1} from "./js/apps/Modules/ImetV1/context/ManagementStaff";
window.ImetCore.Apps.Modules.ImetV1.context.ManagementStaff = ManagementStaffV1;

import {default as FinancialResourcesV1} from "./js/apps/Modules/ImetV1/context/FinancialResources";
window.ImetCore.Apps.Modules.ImetV1.context.FinancialResources = FinancialResourcesV1;

import {default as FinancialAvailableResourcesV1} from "./js/apps/Modules/ImetV1/context/FinancialAvailableResources";
window.ImetCore.Apps.Modules.ImetV1.context.FinancialAvailableResources = FinancialAvailableResourcesV1;

import {default as FinancialResourcesBudgetLinesV1} from "./js/apps/Modules/ImetV1/context/FinancialResourcesBudgetLines";
window.ImetCore.Apps.Modules.ImetV1.context.FinancialResourcesBudgetLines = FinancialResourcesBudgetLinesV1;

import {default as EquipmentsV1} from "./js/apps/Modules/ImetV1/context/Equipments";
window.ImetCore.Apps.Modules.ImetV1.context.Equipments = EquipmentsV1;

import {default as MenacesPressionsV1} from "./js/apps/Modules/ImetV1/context/MenacesPressions";
window.ImetCore.Apps.Modules.ImetV1.context.MenacesPressions = MenacesPressionsV1;

import {default as EcosystemServicesV1} from "./js/apps/Modules/ImetV1/context/EcosystemServices";
window.ImetCore.Apps.Modules.ImetV1.context.EcosystemServices = EcosystemServicesV1;

// ##### ImetV1 - evaluation  #####

import Menaces from "./js/apps/Modules/ImetV1/evaluation/Menaces";
window.ImetCore.Apps.Modules.ImetV1.evaluation.Menaces = Menaces;

import InformationAvailability from "./js/apps/Modules/ImetV1/evaluation/InformationAvailability";
window.ImetCore.Apps.Modules.ImetV1.evaluation.InformationAvailability = InformationAvailability;

import DesignatedValuesConservation from "./js/apps/Modules/ImetV1/evaluation/DesignatedValuesConservation";
window.ImetCore.Apps.Modules.ImetV1.evaluation.DesignatedValuesConservation = DesignatedValuesConservation;

import DesignatedValuesConservationTendency from "./js/apps/Modules/ImetV1/evaluation/DesignatedValuesConservationTendency";
window.ImetCore.Apps.Modules.ImetV1.evaluation.DesignatedValuesConservationTendency = DesignatedValuesConservationTendency;

// ##### ImetV2 - context #####

import Governance from "./js/apps/Modules/ImetV2/context/Governance";
window.ImetCore.Apps.Modules.ImetV2.context.Governance = Governance;

import GeographicalLocation from "./js/apps/Modules/ImetV2/context/GeographicalLocation";
window.ImetCore.Apps.Modules.ImetV2.context.GeographicalLocation = GeographicalLocation;

import Areas from "./js/apps/Modules/ImetV2/context/Areas";
window.ImetCore.Apps.Modules.ImetV2.context.Areas = Areas;

import Sectors from "./js/apps/Modules/ImetV2/context/Sectors";
window.ImetCore.Apps.Modules.ImetV2.context.Sectors = Sectors;

import Spillover from "./js/apps/Modules/ImetV2/context/Spillover.js";
window.ImetCore.Apps.Modules.ImetV2.context.Spillover = Spillover;

import ManagementStaff from "./js/apps/Modules/ImetV2/context/ManagementStaff";
window.ImetCore.Apps.Modules.ImetV2.context.ManagementStaff = ManagementStaff;

import FinancialResources from "./js/apps/Modules/ImetV2/context/FinancialResources";
window.ImetCore.Apps.Modules.ImetV2.context.FinancialResources = FinancialResources;

import FinancialAvailableResources from "./js/apps/Modules/ImetV2/context/FinancialAvailableResources";
window.ImetCore.Apps.Modules.ImetV2.context.FinancialAvailableResources = FinancialAvailableResources;

import FinancialResourcesBudgetLines from "./js/apps/Modules/ImetV2/context/FinancialResourcesBudgetLines";
window.ImetCore.Apps.Modules.ImetV2.context.FinancialResourcesBudgetLines = FinancialResourcesBudgetLines;

import Equipments from "./js/apps/Modules/ImetV2/context/Equipments";
window.ImetCore.Apps.Modules.ImetV2.context.Equipments = Equipments;

import MenacesPressions from "./js/apps/Modules/ImetV2/context/MenacesPressions";
window.ImetCore.Apps.Modules.ImetV2.context.MenacesPressions = MenacesPressions;

import EcosystemServices from "./js/apps/Modules/ImetV2/context/EcosystemServices";
window.ImetCore.Apps.Modules.ImetV2.context.EcosystemServices = EcosystemServices;

// ##### ImetV2 - evaluation #####

import RegulationsAdequacy from "./js/apps/Modules/ImetV2/evaluation/RegulationsAdequacy";
window.ImetCore.Apps.Modules.ImetV2.evaluation.RegulationsAdequacy = RegulationsAdequacy;

import DesignAdequacy from "./js/apps/Modules/ImetV2/evaluation/DesignAdequacy";
window.ImetCore.Apps.Modules.ImetV2.evaluation.DesignAdequacy = DesignAdequacy;

import BoundaryLevel from "./js/apps/Modules/ImetV2/evaluation/BoundaryLevel";
window.ImetCore.Apps.Modules.ImetV2.evaluation.BoundaryLevel = BoundaryLevel;

import ManagementPlan from "./js/apps/Modules/ImetV2/evaluation/ManagementPlan";
window.ImetCore.Apps.Modules.ImetV2.evaluation.ManagementPlan = ManagementPlan;

import WorkPlan from "./js/apps/Modules/ImetV2/evaluation/WorkPlan";
window.ImetCore.Apps.Modules.ImetV2.evaluation.WorkPlan = WorkPlan;

import AssistanceActivities from "./js/apps/Modules/ImetV2/evaluation/AssistanceActivities";
window.ImetCore.Apps.Modules.ImetV2.evaluation.AssistanceActivities = AssistanceActivities;

import LifeQualityImpact from "./js/apps/Modules/ImetV2/evaluation/LifeQualityImpact";
window.ImetCore.Apps.Modules.ImetV2.evaluation.LifeQualityImpact = LifeQualityImpact;

import SupportsAndConstraints from "./js/apps/Modules/ImetV2/evaluation/SupportsAndConstraints";
window.ImetCore.Apps.Modules.ImetV2.evaluation.SupportsAndConstraints = SupportsAndConstraints;

import WorkProgramImplementation from "./js/apps/Modules/ImetV2/evaluation/WorkProgramImplementation";
window.ImetCore.Apps.Modules.ImetV2.evaluation.WorkProgramImplementation = WorkProgramImplementation;

// ##### ImetV2 - report #####

import KeyConservationElements from "./js/apps/Modules/ImetV2/report/KeyConservationElements";
window.ImetCore.Apps.Modules.ImetV2.report.KeyConservationElements = KeyConservationElements;

import ThreatsAffectingKCEs from "./js/apps/Modules/ImetV2/report/ThreatsAffectingKCEs";
window.ImetCore.Apps.Modules.ImetV2.report.ThreatsAffectingKCEs = ThreatsAffectingKCEs;

// ##### OECM - context #####

import GovernanceOecm from "./js/apps/Modules/Oecm/context/Governance";
window.ImetCore.Apps.Modules.Oecm.context.Governance = GovernanceOecm;

import { default as AreasOecm } from "./js/apps/Modules/Oecm/context/Areas";
window.ImetCore.Apps.Modules.Oecm.context.Areas = AreasOecm;

import ManagementRelativeImportance from "./js/apps/Modules/Oecm/context/ManagementRelativeImportance";
window.ImetCore.Apps.Modules.Oecm.context.ManagementRelativeImportance = ManagementRelativeImportance;

import ManagementStaffOecm from "./js/apps/Modules/Oecm/context/ManagementStaff";
window.ImetCore.Apps.Modules.Oecm.context.ManagementStaff = ManagementStaffOecm;

import AnalysisStakeholderSummary from "./js/apps/Modules/Oecm/context/AnalysisStakeholderSummary";
window.ImetCore.Apps.Modules.Oecm.context.AnalysisStakeholderSummary = AnalysisStakeholderSummary;

import AnalysisStakeholder from "./js/apps/Modules/Oecm/context/AnalysisStakeholder";
window.ImetCore.Apps.Modules.Oecm.context.AnalysisStakeholder = AnalysisStakeholder;

// ##### OECM - evaluation #####

import Threats from "./js/apps/Modules/Oecm/evaluation/Threats";
window.ImetCore.Apps.Modules.Oecm.evaluation.Threats = Threats;

import KeyElements from "./js/apps/Modules/Oecm/evaluation/KeyElements";
window.ImetCore.Apps.Modules.Oecm.evaluation.KeyElements = KeyElements;

import KeyElementsImpact from "./js/apps/Modules/Oecm/evaluation/KeyElementsImpact";
window.ImetCore.Apps.Modules.Oecm.evaluation.KeyElementsImpact = KeyElementsImpact;

import LifeQualityImpactOecm from "./js/apps/Modules/Oecm/evaluation/LifeQualityImpact";
window.ImetCore.Apps.Modules.Oecm.evaluation.LifeQualityImpact = LifeQualityImpactOecm;
