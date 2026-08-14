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
        'for_profit_organizations' => 'Organizações com fins lucrativos',
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
        'icca_terrestrial' => 'Territórios e áreas conservados por povos indígenas e comunidades locais (ICCA) - Terrestre',
        'icca_marine' => 'Territórios e áreas conservados por povos indígenas e comunidades locais (ICCA) - Marinho',
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
        'High' => 'Alta',
        'Medium' => 'Média',
        'Poor' => 'Pobre',
    ],

    'DocumentedConnectivity' => [
        'no_connectivity' => 'Sem conectividade / muito isolado',
        'limited_connectivity' => 'Conectividade limitada (ligações estruturais fragmentadas ou fracas)',
        'moderate_connectivity' => 'Conectividade moderada (continuidade ecológica parcial)',
        'strong_connectivity' => 'Conectividade forte (rede ecológica integrada)',
    ],
    'EvidenceOfConnectivity' => [
        'no_information' => 'Sem informação / não avaliado',
        'only_anecdotal' => 'Não, apenas informação anedótica',
        'some_indications' => 'Sim, algumas indicações (monitorização limitada, observações locais ou estudos pontuais)',
        'strong_evidence' => 'Sim, evidência forte (marcação, telemetria, estudos genéticos, monitorização a longo prazo ou modelos de dispersão larval)',
    ],
    'EvidencesListConnectivity' => [
        'habitat_mapping' => 'Mapeamento de habitats',
        'corridor_analysis' => 'Análise de corredores',
        'species_monitoring' => 'Monitorização de espécies',
        'telemetry' => 'Estudos de telemetria ou marcação',
        'genetic_studies' => 'Estudos genéticos',
        'marine_current_models' => 'Modelos de correntes marinhas',
        'landscape_fragmentation_analysis' => 'Análise de fragmentação da paisagem',
        'scientific_publications' => 'Publicações científicas',
        'transboundary_agreements' => 'Acordos transfronteiriços',
        'ecological_knowledge' => 'Conhecimento ecológico local ou tradicional',
        'staff_observations' => 'Observações de guardas / pessoal',
        'other' => 'Outro',
    ],
    'ConnectivityIntegrationInManagementPlan' => [
        'not_considered' => 'Não considerado',
        'mentioned_not_operationalised' => 'Mencionado mas não operacionalizado',
        'partially_integrated' => 'Parcialmente integrado (proteção de corredores, zonas tampão, ações de restauro)',
        'fully_integrated' => 'Totalmente integrado à escala da paisagem/seascape (abordagem de rede ecológica)',
    ],

    'SupportingEvidence' => [
        'no_information' => 'Sem informação / não avaliado',
        'only_anecdotal' => 'Não, apenas informação anedótica',
        'some_indicators' => 'Sim, algumas indicações (dados limitados ou estudo pontual)',
        'strong_evidence' => 'Sim, evidência forte (estudos direcionados / monitorização a longo prazo)',
    ],
    'SupportingKeyObservations' => [
        'monitoring_data' => 'Dados de monitorização (ecológica)',
        'scientific_study' => 'Estudo / relatório científico',
        'local_knowledge' => 'Conhecimento local / tradicional',
        'ranger_observations' => 'Observações de guardas / pessoal',
        'other' => 'Outro',
    ],
    'SupportingPerceivedSpeciesChange' => [
        'many_fewer' => 'Muito menos espécies / menos diverso',
        'slightly_fewer' => 'Ligeiramente menos espécies',
        'slightly_more' => 'Ligeiramente mais espécies / mais diverso',
        'many_more' => 'Muito mais espécies / muito mais diverso',
    ],
    'SupportingPerceivedSizeChange' => [
        'much_smaller' => 'Muito menor',
        'slightly_smaller' => 'Ligeiramente menor',
        'slightly_larger' => 'Ligeiramente maior',
        'much_larger' => 'Muito maior',
    ],
    'ProvisioningEvidence' => [
        'no_information' => 'Sem informação / não avaliado',
        'only_anecdotal' => 'Não, apenas informação anedótica',
        'some_indicators' => 'Sim, algumas indicações (dados limitados, estudo pontual, observações parciais)',
        'strong_evidence' => 'Sim, evidência forte (monitorização a longo prazo, estudos direcionados, dados CPUE repetidos)',
    ],
    'ProvisioningKeyObservations' => [
        'fisheries_monitoring' => 'Dados de monitorização das pescas (capturas por saída, tendências CPUE, medições de tamanho)',
        'scientific_reports' => 'Relatórios científicos ou técnicos sobre o desempenho das pescas perto da AP',
        'local_knowledge' => 'Conhecimento local / tradicional dos pescadores sobre as tendências de captura',
        'staff_observations' => 'Observações de funcionários das pescas ou pessoal da AP perto dos limites',
        'market_records' => 'Registos de mercado ou locais de desembarque (quantidades, composição de espécies)',
        'other' => 'Outro',
    ],
    'ProvisioningPerceivedCatchChange' => [
        'much_lower' => 'Muito menor',
        'slightly_lower' => 'Ligeiramente menor',
        'slightly_higher' => 'Ligeiramente maior',
        'much_higher' => 'Muito maior',
    ],
    'ProvisioningPerceivedSpillover' => [
        'worse' => 'Não, a AMP claramente piorou as capturas',
        'no_effect' => 'A AMP teve pouco ou nenhum efeito nas capturas',
        'somewhat_better' => 'A AMP contribuiu de alguma forma para melhores capturas',
        'clearly_better' => 'A AMP claramente contribuiu para melhores capturas',
    ],

    'Habitats' => [
        'artificial' => 'Artificial - plantações, jardins, pastagens',
        'desert' => 'Deserto – quente, frio, temperado',
        'forest_temperate_boreal' => 'Floresta - boreal e temperada',
        'forest_dry' => 'Floresta - subtropical/tropical seca',
        'forest_moist_lowland' => 'Floresta - subtropical/tropical húmida de baixa altitude',
        'forest_moist_montane' => 'Floresta - subtropical/tropical húmida de montanha',
        'grassland_dry_moist' => 'Pradaria - subtropical/tropical seca ou húmida',
        'grassland_temperate' => 'Pradaria - temperada',
        'marine_coastal' => 'Marinho - costeiro',
        'marine_coral_reefs' => 'Marinho - recifes de coral',
        'marine_intertidal' => 'Marinho - intermareal',
        'marine_oceanic' => 'Marinho - oceânico e profundo',
        'marine_pelagic' => 'Marinho - pelágico',
        'marine_subtidal' => 'Marinho - subtidal',
        'rocky' => 'Áreas rochosas - montanhas, falésias',
        'savanna_dry' => 'Savana - seca',
        'savanna_moist' => 'Savana - húmida',
        'shrubland_temperate_boreal' => 'Matagal - boreal e temperado',
        'shrubland_dry_moist' => 'Matagal - subtropical/tropical seco ou húmido',
        'shrubland_high_altitude' => 'Matagal - subtropical/tropical de alta altitude',
        'swamp' => 'Pântano - subtropical/tropical',
        'wetlands_lakes' => 'Zonas húmidas (interiores) - lago',
        'wetlands_rivers' => 'Zonas húmidas (interiores) - rios, ribeiros, quedas de água',
        'wetlands_shrub' => 'Zonas húmidas (interiores) - zonas húmidas dominadas por arbustos',
    ],

    'EstimatedStatus' => [
        'scarce' => 'Escasso',
        'below_optimum' => 'Abaixo do ótimo',
        'optimum' => 'Ótimo',
        'exceeding_optimum' => 'Acima do ótimo',
    ],

    'EcosystemServicesImportance' => [
        'null' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Maior',
    ],

];
