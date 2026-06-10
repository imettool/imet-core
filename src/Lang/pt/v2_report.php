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

    'definitions' => 'Definição dos termos',

    // General elements
    'general_elements' => 'Elementos gerais',
    'country' => 'País',
    'name' => 'Nome',
    'category' => 'Categoria(s)',
    'gazetting' => 'Data de classificação oficial',
    'surface' => 'Superfície',
    'agency' => 'Agência',
    'biome' => 'Bioma',
    'main_values_protected' => 'Principais valores pelos quais as áreas protegidas foram classificadas',
    'vision' => 'Visão',
    'mission' => 'Missão',
    'objectives' => 'Objetivos',

    // Evaluation elements
    'evaluation_elements' => 'Avaliação dos elementos do ciclo de gestão da área protegida',

    // Operation recommendations
    'operation_recommendations' => 'Recomendações operacionais',

    // Planning options
    'planning_options' => 'Do diagnóstico IMET às opções de planeamento',
    'planning_options_info' => [
        'general_info' => '<h6 class="font-bold">Do diagnóstico IMET às opções de planeamento iniciais</h6>
            <p>O IMET fornece um diagnóstico estruturado dos valores ecológicos, das ameaças e dos processos de gestão. Estes resultados
            constituem a base de um exercício simples de planeamento inicial baseado no Planeamento de Ações de Conservação (CAP, ver:
            <a target="_blank" href="https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf">https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf)</a>
            segundo a lógica da The Nature Conservancy (TNC). Embora o IMET não substitua o CAP, as tabelas seguintes podem ser utilizadas para
            identificar os elementos, ameaças e ações prioritários para os planos de gestão, os planos de trabalho anuais e outras ferramentas de planeamento',
    ],

    'annexes' => 'Anexos',
    'forest_cover' => 'Cobertura florestal',
    'total_carbon' => 'Carbono total',
    'agricultural_pressure' => 'Pressão agrícola',
    'forest_cover_percent' => 'Perda e ganho florestal',
    'forest_loss' => 'Perda florestal',
    'forest_gain' => 'Ganho florestal',
    'min' => 'Mín.',
    'max' => 'Máx.',
    'mean' => 'Média',
    'std_dev' => 'Desv. padrão',
    'sum' => 'Soma',
    'protected_area' => 'Área protegida.',
    'unprotected_buffer' => 'Zona tampão não protegida de 10 km',

    'ManagementContext' => [
        'title' => 'Contexto de gestão (elementos-chave da gestão)',
        'fields' => [
            'key_species' => 'Espécies-chave',
            'habitats' => 'Habitats terrestres e marinhos - cobertura do solo, alteração e apropriação do solo',
            'climate_change' => 'Valores-chave sensíveis às alterações climáticas',
            'ecosystem_services' => 'Serviços ecossistémicos',
            'threats' => 'Ameaças',
        ],
    ],

    'ManagementEffectivenessAnalysis' => [
        'title' => 'Análise da eficácia da gestão (análise + análise SWOT)',
        'fields' => [
            'strengths' => 'Pontos fortes',
            'weaknesses' => 'Pontos fracos',
            'opportunities' => 'Oportunidades',
            'threats' => 'Ameaças',
        ],
        'characteristics_elements' => 'Elementos característicos da área protegida sob a forma de um exercício SWOT',
    ],

    'OperatingRecommendations' => [
        'title' => 'Recomendações operacionais',
    ],

    'KeyQuestions' => [
        'title' => 'Questões-chave',
        'fields' => [
            'priorities' => 'Quais são as suas prioridades de gestão/governação?',
            'minimum_budget' => 'Qual é o seu orçamento operacional mínimo para garantir a preservação dos valores e da importância da sua área protegida?',
            'additional_funding' => 'No caso de financiamento adicional para a gestão da área protegida, que ações gostaria de realizar e durante quanto tempo?',
        ],
    ],

    // Planning Options: Table A
    'KeyConservationElements' => [
        'title' => 'Tabela A. Elementos-Chave de Conservação (ECC), atributos e serviços',
        'fields' => [
            'num_kce' => 'N.º',
            'kces' => 'Elementos-Chave de Conservação (ECC)',
            'targets_and_es' => 'Alvos secundários e serviços ecossistémicos primários',
            'kea' => 'Atributos Ecológicos-Chave (AEC)',
            'threats' => 'Ameaças',
            'note' => 'Notas / Justificação',
        ],
        'module_info' => 'Esta tabela A ajuda os utilizadores do IMET a passar do diagnóstico ao planeamento, identificando os elementos ecológicos
            mais importantes da área protegida, os serviços que prestam, as suas características essenciais e as ameaças sobre as quais
            atuar. Cada coluna desempenha um papel específico na estruturação das primeiras decisões de planeamento.',
        'definitions' => [
            'kces' => '<span class="font-bold italic">Elementos-Chave de Conservação (ECC)</span>: Elementos ecológicos prioritários (ecossistemas, habitats, espécies-guarda-chuva) que devem ser conservados. Determinam a orientação principal das ações de conservação na área protegida',
            'targets_es' => '<span class="font-bold italic">Alvos secundários e serviços ecossistémicos primários</span>: Os valores e serviços ligados ao ECC através da abordagem das espécies-guarda-chuva significam que proteger o ECC protege também as espécies, habitats e serviços ecossistémicos associados',
            'kea' => '<span class="font-bold italic">Atributos Ecológicos-Chave (AEC)</span>: Características essenciais (área, composição, estrutura, dimensão da população) que definem a integridade do ECC. Os AEC orientam o que deve ser mantido, monitorizado e melhorado.',
            'threats' => '<span class="font-bold italic">Ameaças</span>: Pressões que afetam diretamente o ECC e os seus AEC (p. ex. caça furtiva, desflorestação, mineração). Inclua apenas as ameaças que tenham um impacto real e mensurável.',
        ],
    ],

    // Planning Options: Table B
    'ThreatsAffectingKCEs' => [
        'title' => 'Tabela B. Ameaças que afetam os elementos-chave de conservação',
        'fields' => [
            'threat' => 'Ameaças',
            'kce1' => 'ECC 1',
            'kce2' => 'ECC 2',
            'kce3' => 'ECC 3',
            'kce4' => 'ECC 4',
            'kce5' => 'ECC 5',
            'kce6' => 'ECC 6',
            'kce7' => 'ECC 7',
            'kce8' => 'ECC 8',
            'kce9' => 'ECC 9',
            'kce10' => 'ECC 10',
            'impact' => 'Classificação do impacto da ameaça',
        ],
        'module_info' => 'A tabela B mostra como cada ameaça afeta cada ECC e destaca onde a gestão deve concentrar os seus esforços em primeiro lugar.
             Ao colocar as ameaças na primeira coluna e ao marcar o seu impacto sobre os ECC, a matriz oferece uma rápida visão
             visual dos elementos de conservação mais expostos e das pressões mais críticas. Esta etapa identifica
             as ameaças que requerem atenção prioritária da gestão e serve de ponte direta para a definição das melhorias necessárias
             e das atividades prioritárias na tabela C',
        'definitions' => [
            'threats' => '<span class="font-bold italic">Ameaças</span>: Pressões ou atividades humanas que afetam negativamente os Elementos-Chave de Conservação (ECC).',
            'kce' => '<span class="font-bold italic">ECC 1–10</span>: Colunas utilizadas para indicar se cada ameaça afeta o ECC correspondente e com que intensidade. ',
        ],
        'ratingLegend' => [
            'impact' => [
                '0' => 'Sem ameaça ou ameaça demasiado baixa para ser considerada',
                '1' => 'Ameaça baixa',
                '2' => 'Ameaça média',
                '3' => 'Ameaça elevada',
                '4' => 'Ameaça muito elevada',
            ],
        ],
    ],

    // Planning Options: Table C
    'InitialPlanningOptions' => [
        'title' => 'Opções de planeamento iniciais (tabela de transição IMET → CAP)',
        'fields' => [
            'conservation_goal' => 'Meta de conservação (a longo prazo)',
            'kea' => 'AEC (atributos a manter)',
            'main_threat' => 'Principais ameaças a abordar',
            'improvement' => 'Melhorias necessárias',
            'activities' => 'Atividades (ano prioritário n.º)',
            'indicators' => 'Indicadores de monitorização',
        ],
        'module_info' => 'A tabela C traduz o diagnóstico IMET em ações de conservação práticas. A partir da meta de conservação a longo prazo
            para cada Elemento-Chave de Conservação (ECC), o utilizador identifica os atributos ecológicos que devem ser mantidos
            e as principais ameaças que dificultam esta meta. Em seguida, determina as melhorias necessárias para abordar essas ameaças.
            Esta análise orienta depois a seleção das atividades prioritárias, aquelas com maior probabilidade de reduzir as ameaças e reforçar
            a integridade do ECC. Por fim, são definidos indicadores de monitorização simples para acompanhar o progresso e avaliar a eficácia
            destas atividades. A tabela C fornece, assim, uma ligação operacional direta entre os resultados do IMET e um planeamento de gestão
            executável',
        'definitions' => [
            'conservation_goal' => '<span class="font-bold italic">Meta de conservação (a longo prazo)</span>: A condição futura desejada do Elemento-Chave de Conservação (ECC) que a gestão pretende alcançar ou manter.',
            'kea' => '<span class="font-bold italic">AEC (atributos a manter)</span>: As características ecológicas essenciais do ECC que devem ser preservadas (p. ex. área, estrutura, dimensão da população).',
            'threats' => '<span class="font-bold italic">Principais ameaças a abordar</span>: As pressões específicas que impedem que a meta de conservação seja alcançada.',
            'improvements' => '<span class="font-bold italic">Melhorias necessárias</span>: As mudanças necessárias na gestão, no estado ou na governação para reduzir as ameaças e manter os AEC',
            'activities' => '<span class="font-bold italic">Atividades prioritárias (1–2 anos)</span>: As ações-chave de curto prazo que contribuem diretamente para reduzir as ameaças e alcançar as melhorias.',
            'monitoring' => '<span class="font-bold italic">Indicadores de monitorização</span>: Variáveis simples e mensuráveis utilizadas para acompanhar o progresso em direção à meta de conservação e a eficácia das atividades.',
        ],
    ],

];
