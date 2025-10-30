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
        '1' => 'atende às definições de área protegida da IUCN e / ou CBD',
        '0' => 'atende à definição de CBD de um área conservada',
    ],

    'NonWdpaDesignType' => [
        'Regional',
        'Nacional',
        'Internacional',
        'Não aplicável',
    ],

    'NonWdpaTypology' => [
        '2' => 'principalmente ou inteiramente marinho',
        '1' => 'costeiro: marinho e terrestre',
        '0' => 'principalmente ou totalmente terrestre',
    ],

    'NonWdpaStatus' => [
        'Proposta',
        'Inscrita',
        'Adotada',
        'Designada',
        'Estabelecida',
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
        'marine_and_coastal' => 'Marinho e costeiro',
        'oecm_terrestrial' => 'Conserved area - Terrestrial',
        'oecm_marine' => 'Conserved area - Marine',
        'icca_terrestrial' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine' => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine',
    ],

    'IUCNDesignation' => [
        'IA' => 'IA Reserva Natural Estricta',
        'IB' => 'IB Área Selvagem ',
        'II' => 'II Parque Nacional',
        'III' => 'III Monumento ou Característica Natural ',
        'IV' => 'IV Área de Gestão de Habitats ou Espécies',
        'V' => 'V Paisagem Protegida ',
        'VI' => 'VI Área Protegida com Utilização Sustentável de Qescurces Naturais',
        'not_reported' => 'Não reportado',
    ],

    'MarineDesignation' => [
        'Zona de não-entrada (No-Entry zone)',
        'Zona de Não-Take (No-Take zone)',
        'MPA multi-purposes - Zonas tampão para uso tradicional',
        'MPA multi-purposes - Zonas tampão para actividades educativas e/ou recreativas',
        'MPA multi-purposes - Outros',
        'Reservas marinhas',
        'XRefúgios de vida selvagem',
        'Zona de gestão de peixes',
        'Outros',
    ],

    'EcoType' => [
        'Deserto',
        'Savanas',
        'Miombo',
        'bosque',
        'Floresta seca',
        'Floresta Tropical',
        'Montanha alta',
        'lago / rio',
        'Area húmida',
        'Mangais',
        'Costa',
        'Mar/Oceano',
    ],

    'InstitutionType' => [
        'Académica',
        'Confessioário',
        'Independente',
        'ONG / ASBL',
        'Organizacao Internacional',
        'Privado',
        'Projecto / Programa',
        'Público (Estado)',
        'Outro',
    ],

    'PartnershipsType' => [
        'financeiro',
        'científico',
        'investigação',
        'patrocínio',
        'gemelagem',
        'períscia',
        'serviço de entrega',
        'concessão (exemplo, turismo)',
        'colaboração',
        'PPP (Parceria/Pública/Privada)',
    ],

    'GovernanceModel' => [
        'government' => 'Governança pelo governo',
        'shared' => 'Governança partilhada',
        'private' => 'Governança privada',
        'indigenous' => 'Governança por povos indígenas e comunidades locais',
        'not_reported' => 'Não reportado',
    ],

    'SubGovernanceModel' => [
        'government' => [
            'national' => 'Ministério ou agência federal/nacional',
            'sub_national' => 'Ministério ou agência subnacional',
            'delegated' => 'Gestão delegada pelo governo',
            'other' => 'Outro',
        ],
        'shared' => [
            'transboundary' => 'Governança transfronteiriça',
            'collaborative' => 'Governança colaborativa',
            'joint' => 'Governança conjunta',
            'other' => 'Outro',
        ],
        'private' => [
            'individual' => 'Proprietários de terras individuais',
            'non_profit' => 'Organização sem fins lucrativos',
            'for_profit' => 'Organizações com fins lucrativos',
            'other' => 'Outro',
        ],
        'indigenous' => [
            'indigenous' => 'Povos indígenas',
            'local_communities' => 'Comunidades locais',
            'other' => 'Outro',
        ],
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestre',
        'marine' => 'Marítima',
    ],

    'SpecialDesignation' => [
        'Parques patrimoniais de ASEAN (ASEAN)',
        'Sítios de Aliança de Zero Extinção (AZE)',
        'Convençãocao de Barcelona',
        'Pontos Chave de Biodiversidade',
        'Areas Endémicas de Aves',
        'Areas Selvagens de alta Biodiversidade',
        'Sitios importantes designados pela IUCN para a Biodiversidade de Água Doce',
        'Áreas Importantes de Aves(IBA)',
        'Áreas Importantes de Plantas (IPA)',
        'Areas Chave de Biodiversidade (KBA)',
        'Natura 2000',
        'Areas Marinhas Protegidas de OSPAR',
        'Areas humidas de Ramsar',
        'Espécies de grade',
        'UNESCO MAB',
        'Sítios de Património Mundial',
    ],

    'SpeciesReliability' => [
        'Alta', 'Média', 'Pobre',
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
        '1' => 'Maior',
    ],

];
