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
        'for_profit_organizations' => 'Organizaciones con ánimo de lucro',
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
        'icca_terrestrial' => 'Territorios y áreas conservados por pueblos indígenas y comunidades locales (TICCA) - Terrestre',
        'icca_marine' => 'Territorios y áreas conservados por pueblos indígenas y comunidades locales (TICCA) - Marino',
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
        'lago / río',
        'Wet area',
        'Mangroves',
        'Coast',
        'Sea/Ocean',
    ],

    'InstitutionType' => [
        'Academic',
        'Confessionnel',
        'Independent',
        'ONG / Asociación sin fines de lucro',
        'International organisation',
        'Private',
        'Proyecto / Programa',
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
        'concesión (p. ej. turismo)',
        'collaboration',
        'APP (Asociación Público-Privada)',
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
        'Áreas de aves endémicas',
        'Área silvestre de alta biodiversidad',
        'Sitios importantes de la UICN para la biodiversidad de agua dulce',
        'Áreas importantes para las aves (IBA)',
        'Áreas importantes para las plantas (IPA)',
        'Áreas clave para la biodiversidad (KBA)',
        'Natura 2000',
        'OSPAR Marine Protected Areas',
        'Ramsar Wetlands',
        'Species Grid',
        'UNESCO MAB',
        'Sitios del Patrimonio Mundial',
    ],

    'SpeciesReliability' => [
        'High' => 'Alta',
        'Medium' => 'Media',
        'Poor' => 'Baja',
    ],

    'DocumentedConnectivity' => [
        'no_connectivity' => 'Sin conectividad / muy aislado',
        'limited_connectivity' => 'Conectividad limitada (vínculos estructurales fragmentados o débiles)',
        'moderate_connectivity' => 'Conectividad moderada (continuidad ecológica parcial)',
        'strong_connectivity' => 'Conectividad fuerte (red ecológica integrada)',
    ],
    'EvidenceOfConnectivity' => [
        'no_information' => 'Sin información / no evaluado',
        'only_anecdotal' => 'No, solo información anecdótica',
        'some_indications' => 'Sí, algunas indicaciones (monitoreo limitado, observaciones locales o estudios puntuales)',
        'strong_evidence' => 'Sí, evidencia sólida (marcado, telemetría, estudios genéticos, monitoreo a largo plazo o modelos de dispersión larval)',
    ],
    'EvidencesListConnectivity' => [
        'habitat_mapping' => 'Cartografía de hábitats',
        'corridor_analysis' => 'Análisis de corredores',
        'species_monitoring' => 'Monitoreo de especies',
        'telemetry' => 'Estudios de telemetría o marcado',
        'genetic_studies' => 'Estudios genéticos',
        'marine_current_models' => 'Modelos de corrientes marinas',
        'landscape_fragmentation_analysis' => 'Análisis de fragmentación del paisaje',
        'scientific_publications' => 'Publicaciones científicas',
        'transboundary_agreements' => 'Acuerdos transfronterizos',
        'ecological_knowledge' => 'Conocimiento ecológico local o tradicional',
        'staff_observations' => 'Observaciones de guardaparques / personal',
        'other' => 'Otro',
    ],
    'ConnectivityIntegrationInManagementPlan' => [
        'not_considered' => 'No considerado',
        'mentioned_not_operationalised' => 'Mencionado pero no operacionalizado',
        'partially_integrated' => 'Parcialmente integrado (protección de corredores, zonas de amortiguamiento, acciones de restauración)',
        'fully_integrated' => 'Totalmente integrado a escala de paisaje/seascape (enfoque de red ecológica)',
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
        'artificial' => 'Artificial - plantaciones, jardines, pastizales',
        'desert' => 'Desierto – cálido, frío, templado',
        'forest_temperate_boreal' => 'Bosque - boreal y templado',
        'forest_dry' => 'Bosque - subtropical/tropical seco',
        'forest_moist_lowland' => 'Bosque - subtropical/tropical húmedo de tierras bajas',
        'forest_moist_montane' => 'Bosque - subtropical/tropical húmedo de montaña',
        'grassland_dry_moist' => 'Pastizal - subtropical/tropical seco o húmedo',
        'grassland_temperate' => 'Pastizal - templado',
        'marine_coastal' => 'Marino - costero',
        'marine_coral_reefs' => 'Marino - arrecifes de coral',
        'marine_intertidal' => 'Marino - intermareal',
        'marine_oceanic' => 'Marino - oceánico y de fondos profundos',
        'marine_pelagic' => 'Marino - pelágico',
        'marine_subtidal' => 'Marino - submareal',
        'rocky' => 'Áreas rocosas - montañas, acantilados',
        'savanna_dry' => 'Sabana - seca',
        'savanna_moist' => 'Sabana - húmeda',
        'shrubland_temperate_boreal' => 'Matorral - boreal y templado',
        'shrubland_dry_moist' => 'Matorral - subtropical/tropical seco o húmedo',
        'shrubland_high_altitude' => 'Matorral - subtropical/tropical de alta altitud',
        'swamp' => 'Pantano - subtropical/tropical',
        'wetlands_lakes' => 'Humedales (interiores) - lago',
        'wetlands_rivers' => 'Humedales (interiores) - ríos, arroyos, cascadas',
        'wetlands_shrub' => 'Humedales (interiores) - humedales dominados por arbustos',
    ],

    'EstimatedStatus' => [
        'scarce' => 'Escaso',
        'below_optimum' => 'Por debajo del óptimo',
        'optimum' => 'Óptimo',
        'exceeding_optimum' => 'Por encima del óptimo',
    ],

    'EcosystemServicesImportance' => [
        'null' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Larger',
    ],

];
