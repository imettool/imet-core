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
        'fr' => 'Français',
        'en' => 'Anglais',
        'sp' => 'Espagnol',
        'pt' => 'Portugais',
    ],

    'NonWdpaPaDef' => [
        '1' => 'répond aux définitions des aires protégées de l\'UICN et/ou de la CDB',
        '0' => 'répond à la définition CBD d\'un espace conservé',
    ],

    'NonWdpaDesignType' => [
        'Régional',
        'National',
        'International',
        'Non applicable',
    ],

    'NonWdpaTypology' => [
        '2' => 'principalement ou entièrement marine',
        '1' => 'côtière: marine et terrestre',
        '0' => 'principalement ou entièrement terrestre',
    ],

    'NonWdpaStatus' => [
        'Proposé',
        'Inscrit',
        'Adopté',
        'Désigné',
        'Établi',
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
        'terrestrial' => 'terrestre',
        'marine_and_coastal' => 'maritime et côtier',
        'oecm_terrestrial' => 'Conserved areas - Terrestrial',
        'oecm_marine' => 'Conserved areas - Marine',
        'icca_terrestrial' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine',
    ],

    'IUCNDesignation' => [
        'IA' => 'IA Réserve naturelle intégrale',
        'IB' => 'IB Zone de nature sauvage',
        'II' => 'II Parc national',
        'III' => 'III Natural Monument or Feature',
        'IV' => 'IV Aire de gestion des habitats/espèces',
        'V' => 'V Paysage terrestre/marin protégé',
        'VI' => 'VI Zone de gestion de ressources protégées',
        'not_reported' => 'Not reported',
    ],

    'MarineDesignation' => [
        'Zone d’interdiction d’accès (No-Entry zone)',
        'Zone de non-prélèvement (No-Take zone)',
        'AMP à buts multiples — Zones tampons pour l’utilisation traditionnelle',
        'AMP à buts multiples — Zones tampons pour les activités éducatives et/ou récréatives',
        'AMP à buts multiples — Autre ',
        'Réserves marines ',
        'Refuges pour la faune sauvage',
        'Zone de gestion de pêche',
        'Autre',
    ],

    'EcoType' => [
        'Désert',
        'Savanes',
        'Miombo',
        'Forêts claires',
        'Forêts sèches',
        'Forêts tropicales',
        'Hautes montagnes',
        'Lacs / Rivières',
        'Zones humides',
        'Mangroves',
        'Côtière',
        'Mer/Océan',
    ],

    'InstitutionType' => [
        'Académique',
        'Confessionnel',
        'Indépendant',
        'ONG / ASBL',
        'Organisation internationale',
        'Privé',
        'Projet / Programme',
        'Public (étatique)',
        'Autre',
    ],

    'PartnershipsType' => [
        'Financier',
        'scientifique',
        'recherche',
        'parrainage',
        'jumelage',
        'expertise',
        'prestation de service',
        'concession (p.ex. tourisme)',
        'collaboration',
        'PPP (Partenariat Publique/Privé)',
    ],

    'GovernanceModel' => [
        'government' => 'Gouvernance par le gouvernement',
        'shared' => 'Gouvernance partagée',
        'private' => 'Gouvernance privée',
        'indigenous' => 'Gouvernance par les peuples indigènes et les communautés locales',
        'not_reported' => 'Non communiqué',
    ],

    'SubGovernanceModel' => [
        'government' => [
            'national' => 'Ministère ou agence nationale (fédérale)',
            'sub_national' => 'Ministère ou agence infranationale',
            'delegated' => 'Gestion déléguée par le gouvernement',
            'other' => 'Autre',
        ],
        'shared' => [
            'transboundary' => 'Gouvernance transfrontalière',
            'collaborative' => 'Gouvernance collaborative',
            'joint' => 'Gouvernance conjointe',
            'other' => 'Autre',
        ],
        'private' => [
            'individual' => 'Propriétaires fonciers individuels',
            'non_profit' => 'Organisation à but non lucratif',
            'for_profit' => 'Organisations à but lucratif',
            'other' => 'Autre',
        ],
        'indigenous' => [
            'indigenous' => 'Peuples indigènes',
            'local_communities' => 'Communautés locales',
            'other' => 'Autre',
        ],
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestre',
        'marine' => 'Maritime',
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
        'High' => 'Haute',
        'Medium' => 'Moyenne',
        'Poor' => 'Faible',
    ],

    'DocumentedConnectivity' => [
        'no_connectivity' => 'Pas de connectivité / très isolé',
        'limited_connectivity' => 'Connectivité limitée (liens structurels fragmentés ou faibles)',
        'moderate_connectivity' => 'Connectivité modérée (continuité écologique partielle)',
        'strong_connectivity' => 'Connectivité forte (réseau écologique intégré)',
    ],
    'EvidenceOfConnectivity' => [
        'no_information' => 'Pas d\'information / non évalué',
        'only_anecdotal' => 'Non, seulement des informations anecdotiques',
        'some_indications' => 'Oui, quelques indications (suivi limité, observations locales ou études ponctuelles)',
        'strong_evidence' => 'Oui, preuves solides (marquage, télémétrie, études génétiques, suivi à long terme ou modèles de dispersion larvaire)',
    ],
    'EvidencesListConnectivity' => [
        'habitat_mapping' => 'Cartographie des habitats',
        'corridor_analysis' => 'Analyse des corridors',
        'species_monitoring' => 'Suivi des espèces',
        'telemetry' => 'Études de télémétrie ou de marquage',
        'genetic_studies' => 'Études génétiques',
        'marine_current_models' => 'Modèles de courants marins',
        'landscape_fragmentation_analysis' => 'Analyse de la fragmentation du paysage',
        'scientific_publications' => 'Publications scientifiques',
        'transboundary_agreements' => 'Accords transfrontaliers',
        'ecological_knowledge' => 'Connaissances écologiques locales ou traditionnelles',
        'staff_observations' => 'Observations des gardes / du personnel',
        'other' => 'Autre',
    ],
    'ConnectivityIntegrationInManagementPlan' => [
        'not_considered' => 'Non pris en compte',
        'mentioned_not_operationalised' => 'Mentionné mais non opérationnalisé',
        'partially_integrated' => 'Partiellement intégré (protection des corridors, zones tampons, actions de restauration)',
        'fully_integrated' => 'Pleinement intégré à l\'échelle du paysage terrestre/marin (approche de réseau écologique)',
    ],

    'SupportingEvidence' => [
        'no_information' => 'Pas d\'information / non évalué',
        'only_anecdotal' => 'Non, seulement des informations anecdotiques',
        'some_indicators' => 'Oui, quelques indications (données limitées ou étude ponctuelle)',
        'strong_evidence' => 'Oui, preuves solides (études ciblées / suivi à long terme)',
    ],
    'SupportingKeyObservations' => [
        'monitoring_data' => 'Données de suivi (écologique)',
        'scientific_study' => 'Étude / rapport scientifique',
        'local_knowledge' => 'Connaissances locales / traditionnelles',
        'ranger_observations' => 'Observations des gardes / agents',
        'other' => 'Autre',
    ],
    'SupportingPerceivedSpeciesChange' => [
        'many_fewer' => 'Beaucoup moins d\'espèces / moins diversifié',
        'slightly_fewer' => 'Légèrement moins d\'espèces',
        'slightly_more' => 'Légèrement plus d\'espèces / plus diversifié',
        'many_more' => 'Beaucoup plus d\'espèces / bien plus diversifié',
    ],
    'SupportingPerceivedSizeChange' => [
        'much_smaller' => 'Beaucoup plus petit',
        'slightly_smaller' => 'Légèrement plus petit',
        'slightly_larger' => 'Légèrement plus grand',
        'much_larger' => 'Beaucoup plus grand',
    ],
    'ProvisioningEvidence' => [
        'no_information' => 'Pas d\'information / non évalué',
        'only_anecdotal' => 'Non, seulement des informations anecdotiques',
        'some_indicators' => 'Oui, quelques indications (données limitées, étude ponctuelle, observations partielles)',
        'strong_evidence' => 'Oui, preuves solides (suivi à long terme, études ciblées, données CPUE répétées)',
    ],
    'ProvisioningKeyObservations' => [
        'fisheries_monitoring' => 'Données de suivi des pêcheries (captures par sortie, tendances CPUE, mesures de taille)',
        'scientific_reports' => 'Rapports scientifiques ou techniques sur les performances des pêcheries près de l\'AP',
        'local_knowledge' => 'Connaissances locales / traditionnelles des pêcheurs sur les tendances des captures',
        'staff_observations' => 'Observations des agents des pêcheries ou du personnel de l\'AP près des limites',
        'market_records' => 'Registres des marchés ou des sites de débarquement (quantités, composition des espèces)',
        'other' => 'Autre',
    ],
    'ProvisioningPerceivedCatchChange' => [
        'much_lower' => 'Beaucoup plus faible',
        'slightly_lower' => 'Légèrement plus faible',
        'slightly_higher' => 'Légèrement plus élevé',
        'much_higher' => 'Beaucoup plus élevé',
    ],
    'ProvisioningPerceivedSpillover' => [
        'worse' => 'Non, l\'AMP a clairement aggravé les captures',
        'no_effect' => 'L\'AMP a eu peu ou pas d\'effet sur les captures',
        'somewhat_better' => 'L\'AMP a quelque peu contribué à l\'amélioration des captures',
        'clearly_better' => 'L\'AMP a clairement contribué à l\'amélioration des captures',
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

    'EstimatedStatus' => [
        'scarce' => 'Rare',
        'below_optimum' => 'En dessous de l\'optimum',
        'optimum' => 'Optimum',
        'exceeding_optimum' => 'Dépassant l\'optimum',
    ],

    'EcosystemServicesImportance' => [
        'null' => null,        // need to force string keys
        '0' => 'Locale',
        '1' => 'Plus grand',
    ],

];
