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

return [

    'languages' => [
        'fr' => 'French',
        'en' => 'English',
        'sp' => 'Spanish',
        'pt' => 'Portuguese',
    ],

    'NonWdpaPaDef' => [
        '1' => 'meets IUCN and/or CBD protected area definitions',
        '0' => 'meets the CBD definition of an conserved area',
    ],

    'NonWdpaDesignType' => [
        'National',
        'Regional',
        'International',
        'Not applicable',
    ],

    'NonWdpaTypology' => [
        '2' => 'predominantly or entirely marine',
        '1' => 'coastal: marine and terrestrial',
        '0' => 'predominantly or entirely terrestrial',
    ],

    'NonWdpaStatus' => [
        'Proposed',
        'Inscribed',
        'Adopted',
        'Designated',
        'Established',
    ],

    'OwnershipType' => [
        'state' => 'State',
        'communal' => 'Community',
        'individual_landowners' => 'Individual landowners',
        'for_profit_organizations' => 'For-profit organisations',
        'nonprofit_organizations' => 'Non-profit organisations',
        'joint_ownership' => 'Joint ownership',
        'multiple_ownership' => 'Multiple ownership',
        'contested' => 'Contested',
        'not_reported' => 'Not Reported',
    ],

    'PaType' => [
        'terrestrial' => 'Terrestrial',
        'marine_and_coastal' => 'Marine and coastal',
        'oecm_terrestrial' => 'Conserved areas - Terrestrial',
        'oecm_marine' => 'Conserved areas - Marine',
        'icca_terrestrial' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine',
    ],

    'IUCNDesignation' => [
        'IA' => 'IA Strict Nature Reserve',
        'IB' => 'IB Wilderness Area',
        'II' => 'II National Park',
        'III' => 'III Natural Monument or Feature',
        'IV' => 'IV HABITAT/Species Management Area',
        'V' => 'V Protected Seascape',
        'VI' => 'VI Protected Area with Sustainable Use of Natural Resources',
        'not_reported' => 'Not reported',
    ],

    'MarineDesignation' => [
        'No-Entry zone',
        'No-Take zone',
        'Multi-purposes MPA - Buffer zones for traditional use',
        'Multi-purposes MPA - Buffer zones for educational and/or recreational activities',
        'Multi-purposes MPA - Other',
        'Marine reserves',
        'Wildlife refuges',
        'Fish management zone',
        'Other',
    ],

    'EcoType' => [
        'Desert',
        'Savannas',
        'Miombo',
        'Woodlands',
        'Dry Forest',
        'Tropical forest',
        'High mountain',
        'lake / river',
        'Wet area',
        'Mangroves',
        'Coast',
        'Sea/Ocean',
    ],

    'InstitutionType' => [
        'Academic',
        'Confessionnel',
        'Independent',
        'NGO / ASBL',
        'International organisation',
        'Private',
        'Project / Program',
        'Public (state)',
        'Other',
    ],

    'PartnershipsType' => [
        'financial',
        'scientific',
        'research',
        'sponsorship',
        'twinning',
        'expertise',
        'service delivery',
        'concession (eg. tourism)',
        'collaboration',
        'PPP (Public/Private Partnership)',
    ],

    'GovernanceModel' => [
        'government' => 'Governance by government',
        'shared' => 'Shared governance',
        'private' => 'Private governance',
        'indigenous' => 'Governance by indigenous peoples and local communities',
        'not_reported' => 'Not Reported',
    ],

    'SubGovernanceModel' => [
        'government' => [
            'national' => 'Federal or national ministry or agency',
            'sub_national' => 'Sub-national ministry or agency',
            'delegated' => 'Government-delegated management',
            'other' => 'Other',
        ],
        'shared' => [
            'transboundary' => 'Transboundary governance',
            'collaborative' => 'Collaborative governance',
            'joint' => 'Joint governance',
            'other' => 'Other',
        ],
        'private' => [
            'individual' => 'Individual landowners',
            'non_profit' => 'Non-profit organisation',
            'for_profit' => 'For-profit organisations',
            'other' => 'Other',
        ],
        'indigenous' => [
            'indigenous' => 'Indigenous peoples',
            'local_communities' => 'Local communities',
            'other' => 'Other',
        ],
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestrial',
        'marine' => 'Marine',
    ],

    'SpecialDesignation' => [
        'ASEAN Heritage Parks (ASEAN)',
        'Alliance for Zero Extinction Sites (AZE)',
        'Barcelona Convention',
        'Biodiversity Hotspots',
        'Endemic Bird Areas',
        'High Biodiversity Wilderness Area',
        'IUCN Important Sites for Freshwater Biodiversity',
        'Important Bird Areas (IBA)',
        'Important Plant Areas (IPA)',
        'Key Biodiversity Areas (KBA)',
        'Natura 2000',
        'OSPAR Marine Protected Areas',
        'Ramsar Wetlands',
        'Species Grid',
        'UNESCO MAB',
        'World Heritage Sites',
    ],

    'SpeciesReliability' => [
        'High', 'Medium', 'Poor',
    ],

    'SupportingEvidence' => [
        'no_information' => 'No information / not assessed',
        'only_anecdotal' => 'No, only anecdotal information',
        'some_indicators' => 'Yes, some indications (limited data or one-off study)',
        'strong_evidence' => 'Yes, strong evidence (targeted studies / long-term monitoring)',
    ],
    'SupportingKeyObservations' => [
        'monitoring_data' => 'Monitoring data (ecological)',
        'scientific_study' => 'Scientific study / report',
        'local_knowledge' => 'Local / traditional knowledge',
        'ranger_observations' => 'Ranger / staff observations',
        'other' => 'Other',
    ],
    'SupportingPerceivedSpeciesChange' => [
        'many_fewer' => 'Many fewer species / less diverse',
        'slightly_fewer' => 'Slightly fewer species',
        'slightly_more' => 'Slightly more species / more diverse',
        'many_more' => 'Many more species / much more diverse',
    ],
    'SupportingPerceivedSizeChange' => [
        'much_smaller' => 'Much smaller',
        'slightly_smaller' => 'Slightly smaller',
        'slightly_larger' => 'Slightly larger',
        'much_larger' => 'Much larger',
    ],
    'ProvisioningEvidence' => [
        'no_information' => 'No information / not assessed',
        'only_anecdotal' => 'No, only anecdotal information',
        'some_indicators' => 'Yes, some indications (limited datasets, one-off study, partial observations)',
        'strong_evidence' => 'Yes, strong evidence (long-term monitoring, targeted studies, repeated CPUE data)',
    ],
    'ProvisioningKeyObservations' => [
        'fisheries_monitoring' => 'Fisheries monitoring data (catch per trip, CPUE trends, size measurements)',
        'scientific_reports' => 'Scientific or technical reports on fisheries performance near the PA',
        'local_knowledge' => 'Local / traditional knowledge from fishers about catch trends',
        'staff_observations' => 'Observations by fisheries officers or PA staff near the boundaries',
        'market_records' => 'Market or landing-site records (quantities, species composition)',
        'other' => 'Other',
    ],
    'ProvisioningPerceivedCatchChange' => [
        'much_lower' => 'Much lower',
        'slightly_lower' => 'Slightly lower',
        'slightly_higher' => 'Slightly higher',
        'much_higher' => 'Much higher',
    ],
    'ProvisioningPerceivedSpillover' => [
        'worse' => 'No, the MPA has clearly made catches worse',
        'no_effect' => 'The MPA has had little or no effect on catches',
        'somewhat_better' => 'The MPA has contributed somewhat to better catches',
        'clearly_better' => 'The MPA has clearly contributed to better catches',
    ],

    'Habitats' => [
        'artificial' => 'Artificial - plantations, gardens, pasturelands',
        'desert' => 'Desert – hot, cold, temperate',
        'forest_temperate_boreal' => 'Forest - boreal and temperate',
        'forest_dry' => 'Forest - subtropical/tropical dry',
        'forest_moist_lowland' => 'Forest - subtropical/tropical moist lowland',
        'forest_moist_montane' => 'Forest - subtropical/tropical moist montane',
        'grassland_dry_moist' => 'Grassland - subtropical/tropical dry or moist',
        'grassland_temperate' => 'Grassland - temperate',
        'marine_coastal' => 'Marine - coastal',
        'marine_coral_reefs' => 'Marine - coral reefs',
        'marine_intertidal' => 'Marine - intertidal',
        'marine_oceanic' => 'Marine - oceanic and deep ocean',
        'marine_pelagic' => 'Marine - pelagic',
        'marine_subtidal' => 'Marine - subtidal',
        'rocky' => 'Rocky areas - mountains, cliffs',
        'savanna_dry' => 'Savanna - dry',
        'savanna_moist' => 'Savanna - moist',
        'shrubland_temperate_boreal' => 'Shrubland - boreal and temperate',
        'shrubland_dry_moist' => 'Shrubland - Subtropical/tropical dry or moist',
        'shrubland_high_altitude' => 'Shrubland - Subtropical/tropical high altitude',
        'swamp' => 'Swamp - subtropical/tropical',
        'wetlands_lakes' => 'Wetlands (inland) - lake',
        'wetlands_rivers' => 'Wetlands (inland) - rivers, streams, waterfalls',
        'wetlands_shrub' => 'Wetlands (inland) - shrub dominated wetlands',
    ],

    'EcosystemServicesImportance' => [
        'null' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Larger',
    ],

];
