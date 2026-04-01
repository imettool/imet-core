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
        '1' => 'cumple con las definiciones de áreas protegidas de la UICN y / o CBD',
        '0' => 'cumple con la definición de CBD de área conservada',
    ],

    'NonWdpaDesignType' => [
        'Regional',
        'Nacional',
        'Internacional',
        'No aplicable',
    ],

    'NonWdpaTypology' => [
        '2' => 'principalmente o enteramente marino',
        '1' => 'costero: marino y terrestre',
        '0' => 'principalmente o enteramente terrestre',
    ],

    'NonWdpaStatus' => [
        'Propuesta',
        'Inscrita',
        'Adoptada',
        'Designada',
        'Establecida',
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
        'terrestrial' => 'Terrestre',
        'marine_and_coastal' => 'Marina y costera',
        'oecm_terrestrial' => 'Conserved area - Terrestrial',
        'oecm_marine' => 'Conserved area - Marine',
        'icca_terrestrial' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine',
    ],

    'IUCNDesignation' => [
        'IA' => 'IA Reserva Natural Estricta ',
        'IB' => 'IB Área natural silvestre',
        'II' => 'II Parque Nacional',
        'III' => 'III Monumento o elemento natural',
        'IV' => 'IV Área de manejo de hábitats / especies',
        'V' => 'V Paisaje terrestre y marino protegido',
        'VI' => 'VI Área protegida manejada',
        'not_reported' => 'Not reported',
    ],

    'MarineDesignation' => [
        'Zona de exclusión (No-Entry zone)',
        'Zona de no captura (No-Take zone)',
        'AMP polivalente - Zonas de amortiguación para usos tradicionales',
        'AMP polivalente - Zonas de amortiguación para actividades educativas y/o recreativas',
        'AMP polivalente - Otros ',
        'Reservas marinas',
        'Refugios de vida silvestre',
        'Zona de gestión pesquera',
        'Otros',
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
        'government' => 'Gobernanza por el gobierno',
        'shared' => 'Gobernanza compartida',
        'private' => 'Gobernanza privada',
        'indigenous' => 'Gobernanza por pueblos indígenas y comunidades locales',
        'not_reported' => 'No informado',
    ],

    'SubGovernanceModel' => [
        'government' => [
            'national' => 'Ministerio o agencia federal o nacional',
            'sub_national' => 'Ministerio o agencia subnacional',
            'delegated' => 'Gestión delegada por el gobierno',
            'other' => 'Otro',
        ],
        'shared' => [
            'transboundary' => 'Gobernanza transfronteriza',
            'collaborative' => 'Gobernanza colaborativa',
            'joint' => 'Gobernanza conjunta',
            'other' => 'Otro',
        ],
        'private' => [
            'individual' => 'Propietarios individuales',
            'non_profit' => 'Organización sin fines de lucro',
            'for_profit' => 'Organizaciones con fines de lucro',
            'other' => 'Otro',
        ],
        'indigenous' => [
            'indigenous' => 'Pueblos indígenas',
            'local_communities' => 'Comunidades locales',
            'other' => 'Otro',
        ],
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestre',
        'marine' => 'Marítimo',
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

    'DocumentedConnectivity' => [
        'no_connectivity' => 'Sin conectividad / muy aislado',
        'limited_connectivity' => 'Conectividad limitada (vínculos estructurales fragmentados o débiles)',
        'moderate_connectivity' => 'Conectividad moderada (continuidad ecológica parcial)',
        'strong_connectivity' => 'Conectividad fuerte (red ecológica integrada)',
    ],
    'EvidenceOfConnectivity' => [
        'no_information' => 'Sin información',
        'only_anecdotal' => 'Información anecdótica',
        'some_indications' => 'Algunas indicaciones',
        'strong_evidence' => 'Evidencia sólida (marcado, telemetría, estudios genéticos, modelos de dispersión larval)',
    ],
    'EvidencesListConnectivity' => [
        'habitat_mapping' => 'Cartografía de hábitats',
        'corridor_analysis' => 'Análisis de corredores',
        'marine_current_models' => 'Modelos de corrientes marinas',
        'landscape_fragmentation_index' => 'Índice de fragmentación del paisaje',
        'transboundary_agreements' => 'Acuerdos transfronterizos',
        'scientific_publications' => 'Publicaciones científicas',
    ],
    'ConnectivityIntegrationInManagementPlan' => [
        'not_considered' => 'No considerado',
        'mentioned_not_operationalised' => 'Mencionado pero no operacionalizado',
        'partially_integrated' => 'Parcialmente integrado (protección de corredores, zonificación de amortiguación)',
        'fully_integrated' => 'Totalmente integrado a escala de paisaje/seascape (enfoque de gestión a nivel de red)',
    ],

    'SupportingEvidence' => [
        'no_information' => 'Sin información / no evaluado',
        'only_anecdotal' => 'No, solo información anecdótica',
        'some_indicators' => 'Sí, algunas indicaciones (datos limitados o estudio puntual)',
        'strong_evidence' => 'Sí, evidencia sólida (estudios dirigidos / monitoreo a largo plazo)',
    ],
    'SupportingKeyObservations' => [
        'monitoring_data' => 'Datos de monitoreo (ecológico)',
        'scientific_study' => 'Estudio / informe científico',
        'local_knowledge' => 'Conocimiento local / tradicional',
        'ranger_observations' => 'Observaciones de guardabosques / personal',
        'other' => 'Otro',
    ],
    'SupportingPerceivedSpeciesChange' => [
        'many_fewer' => 'Muchas menos especies / menos diverso',
        'slightly_fewer' => 'Ligeramente menos especies',
        'slightly_more' => 'Ligeramente más especies / más diverso',
        'many_more' => 'Muchas más especies / mucho más diverso',
    ],
    'SupportingPerceivedSizeChange' => [
        'much_smaller' => 'Mucho más pequeño',
        'slightly_smaller' => 'Ligeramente más pequeño',
        'slightly_larger' => 'Ligeramente más grande',
        'much_larger' => 'Mucho más grande',
    ],
    'ProvisioningEvidence' => [
        'no_information' => 'Sin información / no evaluado',
        'only_anecdotal' => 'No, solo información anecdótica',
        'some_indicators' => 'Sí, algunas indicaciones (datos limitados, estudio puntual, observaciones parciales)',
        'strong_evidence' => 'Sí, evidencia sólida (monitoreo a largo plazo, estudios dirigidos, datos CPUE repetidos)',
    ],
    'ProvisioningKeyObservations' => [
        'fisheries_monitoring' => 'Datos de monitoreo pesquero (capturas por salida, tendencias CPUE, medidas de talla)',
        'scientific_reports' => 'Informes científicos o técnicos sobre el rendimiento pesquero cerca del AP',
        'local_knowledge' => 'Conocimiento local / tradicional de los pescadores sobre las tendencias de captura',
        'staff_observations' => 'Observaciones de funcionarios de pesca o personal del AP cerca de los límites',
        'market_records' => 'Registros de mercado o sitios de desembarque (cantidades, composición de especies)',
        'other' => 'Otro',
    ],
    'ProvisioningPerceivedCatchChange' => [
        'much_lower' => 'Mucho menor',
        'slightly_lower' => 'Ligeramente menor',
        'slightly_higher' => 'Ligeramente mayor',
        'much_higher' => 'Mucho mayor',
    ],
    'ProvisioningPerceivedSpillover' => [
        'worse' => 'No, el AMP ha empeorado claramente las capturas',
        'no_effect' => 'El AMP ha tenido poco o ningún efecto en las capturas',
        'somewhat_better' => 'El AMP ha contribuido algo a mejorar las capturas',
        'clearly_better' => 'El AMP ha contribuido claramente a mejorar las capturas',
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
