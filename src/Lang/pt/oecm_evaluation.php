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
    '_Objectives' => [
        'title' => 'Definição de objectivos',
        'fields' => [
            'Element' => 'Elemento/Indicador',
            'Status' => 'Dados de referencia',
            'Objective' => 'Objetivo - Status ótimo ou favorável',
            'comments' => 'Comentários',
        ],
    ],
    'Designation' => [
        'title' => 'Designações',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Integracao',
            'SignificativeClassification' => 'Designação altamente significativa',
            'IncludeInStatistics' => 'Deveria ser uma prioridade na gestão?',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'sem integração',
                'baixa integração',
                'integração moderada',
                'alta integração',
            ],
        ],
        'module_subTitle' => 'Valor e Importancia - Designação',
        'module_info_EvaluationQuestion' => [
            'Avaliar a integração dos valores e da importância das designações (designação nacional e designações internacionais, p. ex. sítio do Património Mundial ou sítio Ramsar) para a gestão da área conservada',
        ],
        'warning_on_save' => 'ATENÇÃO!! <br /> Qualquer modificação pode causar perda de dados nos seguintes módulos (se já preenchidos): <i>I1, PR6</i>',
    ],
    'KeyElements' => [
        'title' => 'Elementos chave da área conservada',
        'fields' => [
            'Aspect' => 'Elemento chave / serviço',
            'Importance' => 'Importancia',
            'EvaluationScore' => 'Integracao',
            'IncludeInStatistics' => 'Deveria ser uma prioridade na gestão?',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Serviços de ecossistema',
            'group1' => 'Elementos chave da biodiversidade',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'sem integração',
                'baixa integração',
                'integração moderada',
                'alta integração',
            ],
        ],
        'module_subTitle' => 'Elementos chave animais, plantas, habitats (protegidos, explorados, em desaparecimento, invasores, etc.) e serviços (aprovisionamento, controlo, culturais, de suporte)',
        'module_info_EvaluationQuestion' => [
            'A área conservada priorizou os elementos chave na sua gestão? A avaliação deve apreciar a necessidade de priorizar os elementos chave na gestão e governação da área conservada. A avaliação utiliza uma lista de classificação baseada nas análises de SA1, SA2 e C3.1.1.',
        ],
        'module_info_Rating' => [
            'Avaliar a necessidade de priorizar os elementos chave na gestão e governação da área conservada',
        ],
        'from_group' => 'Da categoria',
        'key_elements_importance_composition' => 'Composição da importância: :imp_dir (de :num_dir parte(s) interessada(s) directa(s)) + :imp_ind (de :num_ind parte(s) interessada(s) indirecta(s))',
        'num_stakeholders' => 'Indicado por :num_dir parte(s) interessada(s) directa(s) e :num_ind parte(s) interessada(s) indirecta(s)',
        'ranking' => 'Classificação',
        'warning_on_save' => 'ATENÇÃO!! <br /> Qualquer modificação pode causar perda de dados nos seguintes módulos (se já preenchidos): <i>P6, I1, PR6</i>',
    ],
    'SupportsAndConstraints' => [
        'title' => 'Restrições ou apoios das partes interessadas',
        'fields' => [
            'Stakeholder' => 'Parte interessada',
            'Weight' => 'Envolvimento da parte interessada (0-100)',
            'ConstraintLevel' => 'Nível do constrangimento/conflito ou apoio/conformidade',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Utilizadores directos',
            'group1' => 'Utilizadores indirectos',
        ],
        'ratingLegend' => [
            'ConstraintLevel' => [
                '-3' => 'Graves restrições/conflitos geradas por esta parte interessada',
                '-2' => 'Restrições/conflitos geradas por esta parte interessada',
                '-1' => 'Algumas restrições/conflitos geradas por esta parte interessada',
                '0' => 'Não condiciona nem apoia o papel desta parte interessada',
                '+1' => 'Alguns apoios/conformidades desta parte interessada',
                '+2' => 'Apoio/conformidade (menor - moderado - severo)',
                '+3' => 'Forte apoio/conformidade desta parte interessada',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'As restrições/conflitos ou os apoios/conformidades das partes interessadas podem ser medidos pela sua intensidade em restringir/entrar em conflito ou apoiar/estar em conformidade com a área conservada',
        ],
        'module_info_Rating' => [
            'Avaliar as restrições/conflitos ou os factores de apoio/conformidade mais importantes do ambiente político, institucional e social na gestão da área conservada',
        ],
    ],
    'SupportsAndConstraintsIntegration' => [
        'title' => 'Integração das restrições ou apoios das partes interessadas na gestão e governação',
        'fields' => [
            'Stakeholder' => 'Parte interessada',
            'Integration' => 'Integracao',
            'IncludeInStatistics' => 'Deveria ser uma prioridade na gestão?',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Utilizadores directos',
            'group1' => 'Utilizadores indirectos',
        ],
        'ratingLegend' => [
            'Integration' => [
                'sem integração',
                'baixa integração',
                'integração moderada',
                'alta integração',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A avaliação aprecia a necessidade de priorizar a minimização das restrições à gestão ou a maximização do apoio das partes interessadas na gestão da área conservada. A avaliação utiliza a lista de classificação baseada na integração das pontuações de restrição/conflito (C2.1) ou de apoio/conformidade das partes interessadas com os valores de envolvimento das partes interessadas na gestão da área conservada (SA1 do contexto de intervenção).',
        ],
        'module_info_Rating' => [
            'Avaliar a integração actual, na gestão, das restrições ou apoios das partes interessadas',
        ],
        'ranking' => 'Classificação (C2.1)',
        'warning_on_save' => 'ATENÇÃO!! <br /> Qualquer modificação pode causar perda de dados nos seguintes módulos (se já preenchidos): <i>I1, PR6</i>',
    ],
    'ThreatsBiodiversity' => [
        'title' => 'Análise das ameaças aos elementos chave de biodiversidade da área conservada',
        'fields' => [
            'Criteria' => 'Critério',
            'Impact' => 'Impacto/ Severidade',
            'Extension' => 'Escala/ Extenção',
            'Duration' => 'Duração/Irreversibilidade',
            'Trend' => 'Tendencia',
            'Probability' => 'Probabilidade para ameacas no futuro',
            'Note' => 'Nota',
        ],
        'groups' => [
            'group0' => 'Animais',
            'group1' => 'Plantas',
            'group2' => 'Habitats',
        ],
        'ratingLegend' => [
            'Impact' => [
                'Ligeiro',
                'Moderado',
                'Alto',
                'Grave',
            ],
            'Extension' => [
                'Localizado <5%',
                'Disperso 5-15%',
                'Amplamente disperso 15-50%',
                'Em toda a parte >50%',
            ],
            'Duration' => [
                'Curto prazo < 5 anos',
                'Médio prazo 5-20 anos',
                'Muito longo prazo 20-100 anos',
                'Permanente >100 anos',
            ],
            'Trend' => [
                '-2' => 'Decrescendo',
                '-1' => 'Decrescendo ligeiramente',
                '0' => 'Sem mudança',
                '1' => 'Aumento ligeiramente',
                '2' => 'Aumentando',
            ],
            'Probability' => [
                'Muito baixa',
                'Baixa',
                'Médiana',
                'Alto',
            ],
        ],
        'module_info' => 'Avaliar o nível das ameaças que afectam o elemento chave de biodiversidade identificado em CTX4.1, CTX4.2, CTX4.3',
    ],
    'Threats' => [
        'title' => 'Análise das ameaças à área conservada',
        'fields' => [
            'Value' => 'Valores',
            'Impact' => 'Impacto/ Severidade',
            'Extension' => 'Escala/ Extenção',
            'Duration' => 'Duração/Irreversibilidade',
            'Trend' => 'Tendencia',
            'Probability' => 'Probabilidade para ameacas no futuro',
        ],
        'ratingLegend' => [
            'Impact' => [
                'Ligeiro',
                'Moderado',
                'Alto',
                'Grave',
            ],
            'Extension' => [
                'Localizado <5%',
                'Disperso 5-15%',
                'Amplamente disperso 15-50%',
                'Em toda a parte >50%',
            ],
            'Duration' => [
                'Curto prazo < 5 anos',
                'Médio prazo 5-20 anos',
                'Muito longo prazo 20-100 anos',
                'Permanente >100 anos',
            ],
            'Trend' => [
                '-2' => 'Decrescendo',
                '-1' => 'Decrescendo ligeiramente',
                '0' => 'Sem mudança',
                '1' => 'Aumento ligeiramente',
                '2' => 'Aumentando',
            ],
            'Probability' => [
                'Muito baixa',
                'Baixa',
                'Médiana',
                'Alto',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A área conservada identificou claramente, na sua gestão, as ameaças que poderiam afectar a biodiversidade, o património cultural ou os serviços ecossistémicos da área?',
        ],
        'module_info_Rating' => [
            'Avaliar o nível das ameaças mais importantes na gestão da área conservada com base na análise da calculadora de ameaças no ponto SA 2 do Contexto de intervenção, automaticamente reportada abaixo',
        ],
        'num_stakeholders' => 'Indicado por :num_dir parte(s) interessada(s) directa(s) e :num_ind parte(s) interessada(s) indirecta(s)',
    ],
    'ThreatsIntegration' => [
        'title' => 'Integração das ameaças',
        'fields' => [
            'Threat' => 'Ameaça',
            'Integration' => 'Integracao',
            'IncludeInStatistics' => 'Deveria ser uma prioridade na gestão?',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'Integration' => [
                'sem integração',
                'baixa integração',
                'integração moderada',
                'alta integração',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A avaliação aprecia a necessidade de priorizar as ameaças para minimizar os seus efeitos e o seu impacto na gestão da área conservada. A avaliação utiliza uma lista de classificação baseada na análise de ameaças de SA.2 e C3.1.2',
        ],
        'module_info_Rating' => [
            'Avaliar a integração actual das ameaças na gestão da área conservada',
        ],
        'ranking' => 'Classificação (C3.1)',
        'warning_on_save' => 'ATENÇÃO!! <br /> Qualquer modificação pode causar perda de dados nos seguintes módulos (se já preenchidos): <i>I1, PR6</i>',
    ],
    'RegulationsAdequacy' => [
        'title' => 'Adequação de provisoes legais e regulatórias',
        'fields' => [
            'Regulation' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Publicação oficial e designação (p. ex. área conservada, floresta comunitária)',
            'Clareza da demarcação legal da área conservada (p. ex. limites naturais como rios, limites não naturais, direitos consuetudinários, enclaves).',
            'Regras internas para a gestão da área conservada',
            'Ratificação e aplicação de convenções internacionais (CITES, CBD, Nagoya, CMS, Património Mundial, RAMSAR, etc.)',
            'Leis estabelecidas localmente sobre a área conservada e a conservação (períodos de defeso espaciais e temporais para a colheita, a caça e a pesca; limites de quotas para o controlo do número e da dimensão das embarcações; proibições de métodos ou artes de colheita, caça ou pesca, etc.)',
            'Leis ambientais nacionais (gestão dos recursos naturais, conservação, área conservada)',
            'Outras leis nacionais (direitos fundiários e de propriedade, impostos, legislação comercial, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Totalmente inadequado',
                '1' => 'Um pouco inadequado',
                '2' => 'Suficiente',
                '3' => 'Totalmente adequado',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'As disposições legais e regulamentares actuais são adequadas para as actividades de conservação e de gestão dos recursos naturais na área conservada?',
            '<i>Uma legislação e disposições regulamentares adequadas são a base de um quadro de governação e gestão eficaz e robusto para a área conservada e, sobretudo, para assegurar a sua sustentabilidade a longo prazo para as gerações actuais e futuras</i>',
        ],
        'module_info_Rating' => [
            'Identificar e avaliar a adequação das disposições legais e regulamentares actuais para a conservação e a gestão dos recursos naturais na área conservada',
        ],
    ],
    'DesignAdequacy' => [
        'title' => 'Concepção e configuração da área conservada',
        'fields' => [
            'Values' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Tamanho (área de superfície)',
            'Configuração ou forma da área conservada',
            'Integração da zona limítrofe (exterior à área conservada, com regras especiais de utilização dos recursos para a integridade da bacia hidrográfica, corredores para a fauna, actividades de colheita, caça e pesca, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Totalmente inadequado',
                '1' => 'Um pouco inadequado',
                '2' => 'Suficiente',
                '3' => 'Totalmente adequado',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A concepção e a configuração da área conservada são adequadas para a gestão e governação sustentáveis dos seus elementos chave?',
            'A análise deve mostrar se a concepção e a configuração são adequadas à gestão e governação sustentáveis dos elementos chave, ou se deve ser proposta uma configuração melhorada, caso seja viável.',
        ],
        'module_info_Rating' => [
            'Avaliar se a concepção e a configuração da área conservada (com base na análise do ponto CTX2 do Contexto de intervenção) são adequadas para assegurar que os seus elementos chave possam ser bem geridos.',
        ],
    ],
    'BoundaryLevel' => [
        'title' => 'Demarcação da área conservada',
        'fields' => [
            'Boundaries' => 'Grau de demarcação dos limites',
            'BoundariesComments' => 'Comentários/Explicaçõe',
            'Adequacy' => 'Adequação dos limites',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Correspondência dos limites demarcados no que diz respeito à situação jurídica',
            'Adequação de limites demarcados',
            'Limites demarcados por elementos naturais (por exemplo, rios)',
            'Limites claramente demarcados, inequívocos e, portanto, facilmente interpretados (por exemplo, sinais, postes, marcadores, cercas, bóias, etc.)',
            'Reconhecimento dos limites pelas autoridades',
            'Reconhecimento dos limitese fronteiras pelas comunidades/utilizadores',
            'Abordagem de colaboração, incluindo agências nacionais e partes interessadas relevantes na demarcação dos limites',
            'Publicação de informações sobre a demarcação dos limites',
            'Demarcação e desenvolvimento dos limites legais coerentes com os estatutos legais e leis internacionais, se necessário',
            'Demarcação utilizando a fonte oficial de dados de referência',
            'Limites registados com coordenadas geográficas (grau, min, seg)',
            'Demarcação de zonas de utilização de AP (zoneamento)',
            'Demarcação de fronteiras, ou parte delas, que são ambulatórias [por exemplo, margens, rios, etc.] e podem precisar de ser revistas',
            'Demarcação por elementos naturais utilizando uma declaração clara (por exemplo, dados de marés ou de inundações fluviais - média de águas baixas, média de águas altas, etc.)',
        ],
        'ratingLegend' => [
            'Boundaries' => [
                '0–15%',
                '16–30%',
                '31–45%',
                '46–60%',
                '61–75%',
                '76–90%',
                '91–100%',
            ],
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Completamente inadequada (Falta de correspondência com o enquadramento legal / demarcada aleatoriamente, 0-30% das necessidades)',
                '1' => 'Algo inadequada (Correspondência inadequada com o enquadramento legal / demarcação ambígua, 31-60% das necessidades)',
                '2' => 'Adequada (Correspondência bastante adequada com o enquadramento legal / não claramente demarcada, 61-90% das necessidades)',
                '3' => 'Totalmente adequada (Correspondência total com o enquadramento legal / claramente demarcada, 91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'O limite da área conservada está marcado e é adequado?',
            'A demarcação das áreas conservadas é útil do ponto de vista jurídico, uma vez que permite definir exactamente onde podem ser aplicados os controlos específicos da área conservada (p. ex. a monitorização e as sanções podem ser aplicadas em caso de utilização não sustentável dos elementos chave).',
        ],
        'module_info_Rating' => [
            'Avaliar <ol type="A"><li>o grau em que os limites das áreas conservadas estão marcados</li><li>a adequação da demarcação dos limites para a gestão da área conservada</li></ol>',
        ],
    ],
    'ManagementPlan' => [
        'title' => 'Plano de gestão',
        'fields' => [
            'PlanExistence' => 'A) Existe um plano de gestão?',
            'PrintedCopy' => 'A entidade de gestão dispõe de uma cópia impressa?',
            'KnowledgePercentage' => 'Percentagem de membros ou empregados a quem o plano foi explicado',
            'PlanUptoDate' => 'O plano de gestão está actualizado?',
            'PlanApproved' => 'O plano de gestão foi aprovado?',
            'PlanImplemented' => 'O plano de gestão foi implementado?',
            'PlanAdequacyScore' => 'B) Adequação quanto à clareza e à aplicabilidade do plano de gestão',
            'Comments' => 'Comentários / Explicação',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                'menos de 10%',
                '10–50%',
                '51%-80%',
                'mais de 80%',
            ],
            'PlanAdequacyScore' => [
                'A clareza e a aplicabilidade da visão, da missão e dos objectivos são completamente inadequadas (0-30% das necessidades)',
                'A clareza e aplicabilidade da visão, missão e objectivos são de certa forma inadequados (31-60% das necessidades)',
                'A clareza e aplicabilidade da visão, missão e objectivos são adequados (61-90% das necessidades)',
                'A clareza e aplicabilidade da visão, missão e objectivos são totalmente adequados (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Existe um plano de gestão? Em caso afirmativo, é adequado e prático de implementar para a área conservada?',
            'O Plano de Gestão é um documento que define a abordagem e os objectivos de gestão. É essencial para o sucesso do plano a mais ampla consulta possível às partes interessadas e a definição de objectivos que possam ser acordados e respeitados por todos os que têm interesse na utilização e na sobrevivência contínua da área em causa (de IUCN/WDPA: Guidelines for recognising and reporting other effective area-based conservation measures, 2017)',
        ],
        'module_info_Rating' => [
            'Avaliar: A) o estado do plano de gestão, B) a adequação quanto à clareza e à aplicabilidade:',
        ],
    ],
    'WorkPlan' => [
        'title' => 'Plano de trabalho',
        'fields' => [
            'PlanExistence' => 'A) Existe um plano de trabalho? Sim/não',
            'PrintedCopy' => 'A entidade de gestão dispõe de uma cópia impressa?',
            'KnowledgePercentage' => 'Percentagem de membros ou empregados a quem o plano foi explicado',
            'PlanUptoDate' => 'O plano de trabalho está actualizado (abrangendo o período actual)? Sim/não',
            'PlanApproved' => 'O plano de trabalho foi oficialmente aprovado? Sim/não',
            'PlanImplemented' => 'O plano de trabalho ou o plano de monitorização foi implementado? Sim/não',
            'PlanAdequacyScore' => 'B) Adequação quanto à clareza e à aplicabilidade das actividades e dos resultados estabelecidos no plano de trabalho/acção ou no plano de monitorização',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                'menos de 10%',
                '10–50%',
                '51%-80%',
                'mais de 80%',
            ],
            'PlanAdequacyScore' => [
                'A clareza e aplicabilidade das actividades e resultados esperados são totalmente inadequados',
                'A clareza e aplicabilidade das actividades e resultados esperados são algo inadequados ',
                'A clareza e aplicabilidade das actividades e os resultados esperados são adequados',
                'A clareza e aplicabilidade das actividades e os resultados esperados são totalmente adequados',
            ],
        ],
        'module_info_Rating' => 'Avaliar: A) o estado do plano de trabalho, B) a clareza e a aplicabilidade das actividades e resultados estabelecidos no plano de trabalho',
        'module_info_EvaluationQuestion' => [
            'Existe um plano de trabalho? Em caso afirmativo, é adequado e prático de implementar para a área conservada?',
            'Um plano de trabalho descreve as actividades específicas a implementar e permite acompanhar os progressos na obtenção dos resultados da área conservada. Fornece a informação necessária para medir o sucesso da área conservada nos seus esforços de conservação (efeitos).',
        ],
    ],
    'Objectives' => [
        'title' => 'Objectivos da área conservada',
        'fields' => [
            'Objective' => 'Objectivo',
            'Existence' => 'Existente no plano de gestão',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Adequação dos objectivos do plano de gestão para os elementos chave',
            'group1' => 'Objectivos prospectivos para os elementos chave priorizados na gestão, reportados automaticamente a partir do Contexto de gestão',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'totalmente inadequado (0-30% das necessidades)',
                '1' => 'Algo inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Os objectivos definidos para a área conservada são adequados?',
            'As metas e os objectivos da área conservada devem ser claramente compreendidos. Devem ser bem definidos e formulados de modo a facilitar a monitorização, mas devem também estar relacionados com os valores chave da área conservada (ou seja, espécies ou ecossistemas importantes) ou com as principais áreas da actividade de gestão (p. ex. turismo, educação).',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação dos objectivos do plano de gestão aos elementos chave da área conservada, com base nos objectivos existentes no plano de gestão e no Contexto de gestão',
        ],
        'warning_on_save' => 'ATENÇÃO!! <br /> Qualquer modificação pode causar perda de dados nos seguintes módulos (se já preenchidos): <i>O/C1</i>',
    ],
    'ObjectivesContext' => [
        'module_info' => 'Estabelecer e descrever os objectivos de conservação para o Contexto de gestão da área conservada. Os objectivos listados abaixo serão utilizados para melhorar a gestão e, mais especificamente, para as fases de planificação, de mobilização de recursos (intrantes) e de processo, bem como para o acompanhamento das actividades de gestão da área conservada.',
    ],
    'ObjectivesPlanification' => [
        'module_info' => 'Estabelecer e descrever os objectivos de conservação para a planificação da área conservada<br />Os objectivos listados abaixo serão utilizados para melhorar a gestão e, mais especificamente, para as fases de planificação, de mobilização de recursos (intrantes) e de processo, bem como para o acompanhamento das actividades de gestão da área conservada.',
    ],
    'InformationAvailability' => [
        'title' => 'Informação Básica',
        'fields' => [
            'Element' => 'Classificação – Conceito medido – Variável',
            'EvaluationScore' => 'Disponibilidade de informação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'nenhuma ou pouca informação disponível para ajudar na gestão (0-30% das necessidades)',
                'Informação disponível muito limitada - insuficiente para apoiar a gestão (31-60% das necessidades)',
                'informação disponível mas moderadamente suficiente para ajudar na gestão (61-90% das necessidades)',
                'informação disponível e largamente suficiente para ajudar na gestão (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Dispõe de informação suficiente e relevante para apoiar o processo de tomada de decisão da área conservada?',
            'Uma gestão eficaz da área conservada exige conhecimento e informação suficientes para fundamentar a tomada de decisão. Sem informação, é muito improvável que exista uma boa gestão.',
        ],
        'module_info_Rating' => [
            'Avaliar a disponibilidade da informação necessária para apoiar a gestão dos elementos chave da área conservada, priorizados na gestão, reportados automaticamente a partir do Contexto de gestão',
        ],
    ],
    'CapacityAdequacy' => [
        'title' => 'Capacidades de gestão e governação',
        'fields' => [
            'Member' => 'Membro',
            'Weight' => 'Envolvimento',
            'Adequacy' => 'Adequação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Composição e pessoal ou membros da Entidade de Gestão (reportado automaticamente por CTX 3.1.2)',
            'group1' => 'Partes interessadas envolvidas na gestão ou na utilização dos recursos naturais (reportado automaticamente por SA.1 e SA.2).',
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'Capacidades do pessoal inexistentes ou muito baixas (0-30% das necessidades)',
                'Capacidades insuficientes do pessoal (31-60% das necessidades)',
                'Capacidades do pessoal adequadas, mas são necessárias melhorias adicionais (61-90% das necessidades)',
                'Capacidades do pessoal completamente suficientes (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A entidade ou entidades responsáveis pela gestão e governação têm capacidade suficiente para gerir e governar a área conservada?',
        ],
        'module_info_Rating' => [
            'Recursos humanos qualificados, competentes, empenhados e adequados são fundamentais para o sucesso das áreas conservadas.',
        ],
    ],
    'BudgetAdequacy' => [
        'title' => 'Orçamento actual',
        'fields' => [
            'EvaluationScore' => 'Adequação do orçamento actual',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'Sem orçamento (0% das necessidades)',
                'Inadequado mesmo para actividades de gestão essenciais (entre 1 e 25% dos requisitos)',
                'Inadequado para muitas actividades de gestão (26-50% dos requisitos)',
                'Adequado para actividades essenciais de gestão (entre 51 e 70% dos requisitos)',
                'Adequado para muitas mas não todas as actividades (entre 71% e 90% dos requisitos)',
                'Adequado para todas as actividades (91% ou mais dos requisitos)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'O orçamento actual é adequado para uma gestão apropriada da área conservada?',
            'As áreas conservadas preparam os seus orçamentos operacionais anuais todos os anos ou para vários anos. Documentos essenciais de planeamento financeiro e orçamental são necessários para melhorar a eficiência e a eficácia operacionais.',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação do financiamento do ano corrente da área conservada em relação aos requisitos de conservação (com base na análise do contexto de intervenção, ponto CTX 3.2)',
        ],
    ],
    'BudgetSecurization' => [
        'title' => 'Assegurar o orçamento',
        'fields' => [
            'Percentage' => 'A) Avaliar em percentagem a "Segurança do financiamento futuro"',
            'EvaluationScore' => 'B) Avaliar em anos o "Período de segurança do financiamento futuro"',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'Percentage' => [
                'As necessidades financeiras básicas para a gestão da área conservada não estão asseguradas (0–20% das necessidades asseguradas)',
                'As necessidades financeiras básicas para a gestão da área conservada estão muito fracamente asseguradas (21–40% das necessidades asseguradas)',
                'As necessidades financeiras básicas para a gestão da área conservada estão fracamente asseguradas (41-60% das necessidades asseguradas)',
                'As necessidades financeiras básicas para a gestão da área conservada estão parcialmente asseguradas (61–75% das necessidades asseguradas)',
                'As necessidades financeiras básicas para a gestão da área conservada estão relativamente bem asseguradas (76-90% das necessidades asseguradas)',
                'As necessidades financeiras básicas para a gestão da área conservada estão asseguradas (> 90% das necessidades asseguradas)',
            ],
            'EvaluationScore' => [
                'As necessidades financeiras básicas para a gestão da área conservada estão asseguradas apenas para 1 ano (ano corrente)',
                'As necessidades financeiras básicas para a gestão da área conservada estão asseguradas para 2 anos (ano corrente +1 ano)',
                'As necessidades financeiras básicas para a gestão da área conservada estão asseguradas para 3 anos (ano corrente +2 anos)',
                'As necessidades financeiras básicas para a gestão da área conservada estão asseguradas para 4 – e mais anos. (ano corrente +3 anos e mais)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Que parte do orçamento necessário está assegurada, e por quanto tempo, para cobrir as necessidades básicas de gestão da área conservada?',
            'Um orçamento seguro e fiável é fundamental para o planeamento e a gestão da área conservada, para actividades de grande escala e de longo prazo.',
        ],
        'module_info_Rating' => [
            'Avaliar: A) a segurança do financiamento e B) o período de segurança do financiamento para os próximos anos em relação aos requisitos de conservação na área conservada',
        ],
    ],
    'ManagementEquipmentAdequacy' => [
        'title' => 'Infra-estruturas, equipamento e instalações',
        'fields' => [
            'Equipment' => 'Critério – Conceito medido – Variável',
            'Adequacy' => 'A) a adequação das infra-estruturas, equipamentos e instalações (resultados calculados automaticamente com base na análise do contexto de intervenção, ponto CTX 3.3),',
            'PresentNeeds' => 'B) Necessidades actuais de disponibilidade para a gestão da área conservada',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'adequacy' => 'Adequação de infra-estruturas, equipamento e instalações',
        'ratingLegend' => [
            'Adequacy' => [
                'totalmente inadequado (0-30% das necessidades)',
                'Algo inadequado (31-60% das necessidades)',
                'Adequado (61-90% das necessidades)',
                'Totalmente adequado (91-100% das necessidades)',
            ],
            'PresentNeeds' => [
                'Normal',
                'Alto',
                'Muito alto',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'As infra-estruturas, os equipamentos e as instalações da área conservada são adequados aos requisitos de gestão? As infra-estruturas, os equipamentos e as instalações são importantes para assegurar e melhorar a eficiência e a eficácia operacionais da área conservada.',
        ],
        'module_info_Rating' => [
            'Avaliar: A) a adequação das infra-estruturas, equipamentos e instalações (resultados calculados automaticamente com base na análise do contexto de intervenção, ponto CTX 3.3), B) as necessidades actuais de disponibilidade de infra-estruturas, equipamentos e instalações específicos para a área conservada',
        ],
    ],
    'ObjectivesIntrants' => [
        'module_info' => 'Estabelecer e descrever os objectivos de conservação para os intrantes da área conservada<br />Os objectivos listados abaixo serão utilizados para melhorar a gestão e, mais especificamente, para as fases de planificação, de mobilização de recursos (intrantes) e de processo, bem como para o acompanhamento das actividades de gestão da área conservada.',
    ],
    'ObjectivesProcessus' => [
        'module_info' => 'Estabelecer e descrever os objectivos de conservação relacionados com o processo de implementação da área conservada. Os objectivos introduzidos abaixo serão utilizados para melhorar a gestão e, mais especificamente, para as fases de planificação, de mobilização de recursos (intrantes) e de processo, bem como para o acompanhamento das actividades de gestão da área conservada.',
    ],
    'StaffCompetence' => [
        'title' => 'Competências/formação do pessoal',
        'fields' => [
            'Member' => 'Critério – Conceito medido – Variável',
            'Weight' => 'Envolvimento',
            'Adequacy' => 'Adequação das actividades de reforço de capacidades para a entidade de gestão da área conservada',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Composição e pessoal ou membros da área conservada',
            'group1' => 'Partes interessadas envolvidas na gestão e na utilização dos recursos naturais da área conservada',
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'Actividades de reforço de capacidades completamente inadequadas',
                'Actividades de reforço de capacidades algo adequadas',
                'Actividades de reforço de capacidades adequadas, mas são necessárias melhorias',
                'Actividades de reforço de capacidades totalmente adequadas (suficientes e actualizadas)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A entidade específica, ou combinação de entidades, de Gestão e Governação da área conservada está a implementar programa(s) de formação e de reforço de capacidades adequado(s) que responda(m) às necessidades dos seus membros na concretização dos objectivos da área conservada?',
            'Uma força de trabalho qualificada, competente e empenhada é fundamental para o sucesso das áreas conservadas',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das actividades de reforço de capacidades para os membros da entidade específica, ou combinação de entidades, de Gestão e Governação da área conservada (identificados em CTX 3.1.2 e CTX 5 – Utilizadores directos)',
        ],
    ],
    'HRmanagementPolitics' => [
        'title' => 'Políticas e procedimentos de recursos humanos',
        'fields' => [
            'Conditions' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação das politicas e procedimentos de gestão dos recursos humanos',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Remuneração e benefícios para os empregados',
            'Compensações em tarefas baseadas na participação',
            'Atribuição de funções ou tarefas',
            'Saúde, segurança e protecção',
            'Género e equidade étnica',
            'Gestão das relações com as partes interessadas na atribuição das tarefas a realizar',
            'Regras que reduzem o favoritismo e a discriminação na atribuição de tarefas',
            'Equidade na responsabilização pelas actividades realizadas',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'totalmente inadequado (0-30% das necessidades)',
                '1' => 'Algo inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A entidade específica, ou combinação de entidades, de Gestão e Governação da área conservada adoptou políticas de gestão adequadas para motivar e reter os seus recursos humanos?',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das disposições das políticas de gestão dos recursos humanos',
            'Adequação das políticas de gestão dos recursos humanos:',
        ],
        'module_info' => 'Disposições das políticas de gestão dos recursos humanos da entidade específica, ou combinação de entidades, de Gestão e Governação da área conservada (identificadas em SA 1 ou CTX 3.1.1):',
    ],
    'AdministrativeManagement' => [
        'title' => 'Orçamento e finanças',
        'fields' => [
            'Aspect' => 'Critério - Conceito Medido – Variável',
            'EvaluationScore' => 'Classificação: Estabelecimento dos elementos básicos da gestão orçamental e financeira',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Responsabilização: é capaz de explicar e demonstrar a todas as partes interessadas como utilizou os seus recursos e o que alcançou',
            'Transparência: a sua organização é transparente quanto ao seu trabalho e às suas finanças, disponibilizando informação a todas as partes interessadas',
            'Integridade: os indivíduos da sua organização estão a operar com honestidade e propriedade.',
            'Gestão responsável dos recursos financeiros: a sua organização cuida bem dos recursos financeiros que lhe foram atribuídos e assegura que são utilizados para o fim previsto',
            'Normas contabilísticas: o sistema da sua organização para manter registos e documentação financeira segue as normas contabilísticas externas aceites.\'',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Nunca',
                '1' => 'Raramente',
                '2' => 'Por vezes',
                '3' => 'Muitas vezes',
                '4' => 'Sempre',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'O orçamento e os recursos financeiros são bem geridos para satisfazer os requisitos essenciais e prioritários de gestão da área conservada?',
            'A gestão orçamental e financeira de uma área conservada deve ser robusta para permitir uma orçamentação e uma afectação de recursos adequadas. Só é possível alcançar uma gestão orçamental e financeira eficaz se existir um plano de gestão e de trabalho sólido, com objectivos claros.',
        ],
        'module_info_Rating' => [
            'Avaliar a implementação dos elementos básicos que devem existir para alcançar boas práticas na gestão orçamental e financeira.',
        ],
    ],
    'EquipmentMaintenance' => [
        'title' => 'Manutenção das infra-estruturas',
        'fields' => [
            'Equipment' => 'Critério - Conceito Medido – Variável',
            'EvaluationScore' => 'Classificação: Adequação de manutenção',
            'AdequacyLevel' => 'Valor de CTX 3.3',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'totalmente inadequado (0-30% das necessidades)',
                '1' => 'Algo inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'As infra-estruturas, os equipamentos e as instalações da área conservada são adequadamente mantidos?',
            'Infra-estruturas, equipamentos e instalações mal mantidos não só se deterioram mais rapidamente, como também desperdiçam recursos e degradam fundamentalmente a capacidade da área conservada de alcançar os seus objectivos.',
        ],
        'module_info_Rating' => [
            'Avaliar o nível de manutenção das infra-estruturas, equipamentos e instalações em relação aos requisitos de gestão da área conservada (com base na análise do contexto de intervenção, ponto CTX 3.3)',
        ],
    ],
    'ManagementActivities' => [
        'title' => 'Gestão dos elementos chave',
        'fields' => [
            'Activity' => 'Critério - Conceito Medido – Variável',
            'EvaluationScore' => 'Adequação das acções de gestão',
            'InManagementPlan' => 'Acção incluída no plano de gestão',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Elementos chave da área conservada',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'totalmente inadequado (0-30% das necessidades)',
                '1' => 'Algo inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Existem acções de gestão específicas para os elementos chave da área conservada?',
            'Para assegurar uma gestão sustentável dos elementos chave da área conservada, a(s) parte(s) interessada(s)/associação(ões) de gestão deve(m) avaliar as práticas e acções, que podem incluir a conservação/restauro de espécies animais (p. ex. abelhas) e vegetais (p. ex. farmacopeia), a gestão do fogo, trabalhos de revegetação, o controlo de espécies invasoras, a gestão dos recursos culturais, a contenção de ameaças, etc.',
        ],
        'module_info_Rating' => [
            'Com base na lista dos elementos chave identificados no Contexto de intervenção SA 2 e priorizados na análise de Gestão C1, C2, C3.2 e C4, avaliar a adequação das práticas e acções de gestão relacionadas.',
        ],
    ],
    'LawEnforcementImplementation' => [
        'title' => 'Resolução de questões litigiosas',
        'fields' => [
            'Element' => 'Critério – Conceito medido – Variável',
            'Adequacy' => 'Adequação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Actividades de controlo terrestre e marítimo',
            'group1' => 'Acções em resposta a actividades ilegais ou resolução de questões litigiosas',
        ],
        'predefined_values' => [
            'group0' => [
                'Gestão da organização das unidades/grupos de controlo',
                'Número de unidades/grupos de controlo por mês',
                'Utilização de controlo colaborativo conseguido através da colaboração com as partes interessadas',
                'Organização de unidades/grupos de controlo em colaboração com agentes florestais e marítimos e oficiais juramentados',
                'Unidades/grupos de controlo equipados com meios diversos (p. ex. tipos de patrulha como pontos de observação, a pé, de bicicleta, de motociclo, unidades/grupos apoiados por veículos/embarcações, etc.)',
                'Utilização de GPS ou de outras ferramentas de apoio para realizar o briefing e o debriefing das unidades/grupos de controlo',
                'Realização de controlo por unidades/grupos que operam durante a noite ou em horários não programados',
                'Actualização contínua e utilização de uma ficha informativa simples que descreve o zonamento, os controlos, as restrições e as actividades ilegais',
            ],
            'group1' => [
                'Unidade específica ou administrador/guarda que orienta e apoia as unidades/grupos de controlo contra actividades ilegais ou questões litigiosas',
                'Organização de um sistema de informadores que orienta e apoia as unidades/grupos de controlo contra actividades ilegais ou questões litigiosas',
                'Sistema de aplicação de acções legais contra actividades ilegais',
                'Acórdãos obtidos em tribunal',
                'Sistema para resolver questões litigiosas',
                'Decisões obtidas ao abrigo de regras tradicionais',
                'Colaboração com ONG especializadas em legislação terrestre e marinha, aplicação da lei, etc. (direitos, regras, etc.) sobre a sustentabilidade da gestão dos elementos chave da área conservada',
            ],
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Quão adequados são o controlo e as acções contra actividades ilegais destinados a garantir a sustentabilidade da gestão dos elementos chave da área conservada?',
            'O controlo (actividades de observação e recolha de dados) é uma actividade essencial para fazer cumprir as regras legais, tradicionais e específicas existentes, de modo a assegurar a gestão a longo prazo dos elementos chave da área conservada.',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação dos elementos da gestão das patrulhas das áreas protegidas orientadas para assegurar a protecção a longo prazo da biodiversidade e de outros valores',
            'Avaliar a actuação contra actividades ilegais ou para resolver questões litigiosas na sustentabilidade da gestão dos elementos chave da área conservada',
        ],
    ],
    'StakeholderCooperation' => [
        'title' => 'Colaboração das partes interessadas',
        'fields' => [
            'Element' => 'Critério – Conceito medido – Variável',
            'Weight' => 'Envolvimento da parte interessada (0-100)',
            'Cooperation' => 'Grau de cooperação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Utilizadores directos',
            'group1' => 'Utilizadores indirectos',
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Sem cooperação - Sem representação ou consulta das partes interessadas, sem envolvimento, sem consideração do conhecimento e das perspectivas locais',
                '1' => 'Muito pouca cooperação - Representação ou consulta das partes interessadas esporádica, envolvimento mínimo, conhecimento e perspectivas locais pouco considerados',
                '2' => 'Cooperação moderada - Representação ou consulta moderada das partes interessadas, envolvimento ocasional, alguma consideração do conhecimento e das perspectivas locais',
                '3' => 'Cooperação muito elevada - Representação ou consulta das partes interessadas bem estabelecida, envolvimento alargado, plena consideração do conhecimento e das perspectivas locais',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Existem medidas para melhorar a cooperação das partes interessadas na governação e gestão da área conservada?',
            'A avaliação visa determinar em que medida existem medidas para assegurar a cooperação e a participação efectiva das partes interessadas, que contribuem para a legitimidade e a eficácia da governação da área conservada.',
        ],
        'module_info_Rating' => [
            'Avaliar o grau de envolvimento e participação das partes interessadas, o seu empenho e a integração do conhecimento e das perspectivas locais na governação e gestão da área conservada',
        ],
    ],
    'AssistanceActivities' => [
        'title' => 'Benefícios para as comunidades locais',
        'fields' => [
            'Activity' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação de actividades para proporcionar benefícios/assistência',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Elementos dos padrões materiais do nível de vida',
            'group1' => 'Elementos dos padrões imateriais de nível de vida',
        ],
        'predefined_values' => [
            'group0' => [
                'Apoio à segurança alimentar (pequena agricultura, pesca de pequena escala, colheita, caça, etc.)',
                'Apoio às empresas locais (transformação da produção agroalimentar, pesca, construção de abrigos para barcos, estacionamento de barcos, produtos florestais, etc.)',
                'Apoio às empresas de turismo (distribuição das receitas do turismo, produtos tradicionais e artesanato para turistas, produtos agrícolas ou do mar, etc.)',
                'Apoio a percursos de financiamento local',
                'Apoio a resolução-compensação do conflito homem-fauna selvagem',
                'Apoio ao emprego de recursos humanos locais na área conservada, no turismo, etc.',
                'Apoio a prestadores de serviços locais',
                'Fornecimento de recursos naturais em caso de necessidade (p. ex. água, fibras, etc. das áreas conservadas durante crises, ou contribuição material para edifícios sociais como hospitais e escolas)',
                'Fornecimento de energia, ligação eléctrica, abastecimento e ligação de água, construção, manutenção e melhoria de estradas, etc.',
            ],
            'group1' => [
                'Minimização de conflitos e reforço da gestão e da utilização sustentáveis dos elementos chave da área conservada (de aprovisionamento e culturais)',
                'Disponibilização de infra-estruturas de educação e de saúde (ou seja, edifícios, água potável)',
                'Prestação de serviços educativos (ensino) e de serviços de saúde (cuidados de saúde)',
                'Prestação de serviços culturais (físicos – intelectuais – emblemáticos – espirituais – interacção a partir dos serviços da área conservada)',
                'Facilitação da resolução de problemas sociais',
                'Reforço da identidade e do sentido de pertença dos povos indígenas e das comunidades locais (IPLC)',
                'Minimização de conflitos e reforço da gestão e da utilização sustentáveis dos elementos chave da área conservada (de aprovisionamento e culturais)',
                'Disponibilização de infra-estruturas de educação e de saúde (ou seja, edifícios, água potável)',
                'Prestação de serviços educativos (ensino) e de serviços de saúde (cuidados de saúde)',
                'Prestação de serviços culturais (físicos – intelectuais – emblemáticos – espirituais – interacção a partir dos serviços da área conservada)',
                'Facilitação da resolução de problemas sociais',
                'Reforço da identidade e do sentido de pertença dos povos indígenas e das comunidades locais (IPLC)',
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A área conservada realiza actividades/programas concebidos para proporcionar benefícios/assistência adequados às comunidades?',
            'As áreas conservadas devem contribuir para o desenvolvimento sustentável e o bem-estar económico das partes interessadas. Assim, as normas internacionais de boas práticas promovem uma avaliação da área conservada que contabilize tanto os resultados ecológicos como os socioeconómicos (Fontes UNESCO - IUCN).',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das actividades/programas que a área conservada realiza para proporcionar benefícios/assistência às partes interessadas.',
        ],
    ],
    'EnvironmentalEducation' => [
        'title' => 'Educação ambiental',
        'fields' => [
            'Activity' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação das actividades de educação ambiental e sensibilização do público',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Programas de conservação das partes interessadas da área conservada',
            'Programas de sensibilização das partes interessadas da área conservada',
            'Programas de sensibilização de partes interessadas que não as da área conservada',
            'Programa de educação ambiental nas escolas da paisagem da área conservada',
            'Programas de rádio e televisão sobre a área conservada (p. ex. em rádios comunitárias)',
            'Conferências e debates sobre a área conservada',
            'Visitas guiadas para as partes interessadas na área conservada',
            'Operações de resíduos e limpeza',
            'Sensibilização do público (p. ex. ecomuseus)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A área conservada realiza actividades/programas de educação ambiental e de sensibilização do público especificamente ligados às necessidades e aos objectivos de conservação/gestão dos elementos chave?',
            'A educação ambiental pode ajudar as pessoas a equilibrar as suas próprias necessidades vitais com as necessidades do ambiente natural que presta serviços (de aprovisionamento, de regulação, culturais e de suporte) às partes interessadas dentro e fora, perto e longe da área conservada (tendo em conta a designação específica da área conservada). Isto pode ser conseguido aumentando a sensibilização e alterando efectivamente a perspectiva das partes interessadas sobre a área conservada',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das actividades/programas de educação ambiental e de sensibilização do público apoiados pela área conservada',
        ],
    ],
    'VisitorsManagement' => [
        'title' => 'Gestão do turismo',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação das instalações e serviços dos visitantes',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Existência de objectivos específicos para o turismo e a gestão de visitantes',
            'Existência de procedimentos de gestão do turismo',
            'Aumentar a consciencialização sobre as actividades de ecoturismo',
            'Acções para minimizar as mudanças induzidas pelo homem (transporte, alojamento e actividades de lazer)',
            'Diversificação turística através da promoção dos valores biofísicos, culturais e sociais',
            'Benefícios económicos assegurados para a gestão e governação das áreas conservadas',
            'Gestão do alojamento, da restauração e das actividades de lazer (também para pessoas com deficiência)',
            'Guias turísticos na área conservada',
            'Dados de monitorização de turismo',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A área conservada gere (concebe, estabelece, mantém e melhora) as instalações e os serviços necessários aos visitantes e o impacto do turismo ambiental?',
            'O turismo ocorre em contextos históricos, culturais e geográficos únicos, envolvendo múltiplos valores e partes interessadas da área conservada. Uma gestão eficaz do turismo na área conservada exige a apreciação e a compreensão dos contextos de sustentabilidade ambiental, social e económica e uma gestão compatível das instalações e serviços para visitantes.',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação da gestão das instalações e serviços para visitantes e do impacto no turismo ambiental e cultural da área conservada',
        ],
    ],
    'NaturalResourcesMonitoring' => [
        'title' => 'Monitorização e Investigação',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação da monitorização',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'predefined_values' => [
            'Utilização dos dados da monitorização para induzir mudanças na gestão e governação da área conservada',
            'Monitorização dos elementos chave',
            'Monitorização das ameaças à área conservada',
            'Monitorização do nível de vida material e imaterial das partes interessadas',
            'Investigação sobre os elementos chave',
            'Investigação sobre o nível de vida material e imaterial das partes interessadas',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Os sistemas de monitorização e investigação são adequados para acompanhar eficazmente os elementos chave da área conservada?',
            'Para antecipar problemas potenciais e planear as melhores intervenções, é indispensável uma compreensão sólida das tendências dos elementos chave ambientais e dos serviços da área conservada, como a biodiversidade, o aprovisionamento (água, alimentos, etc.), a qualidade da floresta, as ameaças, etc.',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação dos sistemas de monitorização e investigação existentes para os elementos chave da área conservada',
        ],
    ],
    'WorkProgramImplementation' => [
        'title' => 'Implementação das actividades do plano de trabalho/acção',
        'fields' => [
            'Category' => 'Categorias de actividades',
            'Activity' => 'Actividade',
            'TargetedActivity' => 'Actividade Planificada',
            'EvaluationScore' => 'Nível de implementação',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'Nível de implementação nulo ou muito baixo das actividades previstas para o último ano (entre 0 e 25%)',
                'Nível de implementação baixo das actividades previstas para o último ano (entre 26 e 50%)',
                'Nível de implementação moderado das actividades previstas para o último ano (entre 51 e 75%)',
                'Nível de implementação elevado das actividades previstas para o último ano (entre 76 e 100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Em que medida a área conservada implementou as principais actividades do plano de trabalho/acção?',
            'A implementação é a realização, ou execução, do plano de trabalho/acção anual ou plurianual relativo às actividades da área conservada',
        ],
        'module_info_Rating' => [
            'Avaliar o nível de implementação das prioridades definidas no plano de trabalho/acção do ano anterior (na caixa de comentários indique o ano de referência se utilizar um plano de trabalho/acção plurianual)',
            '<b>Categoria de actividades</b>: gestão dos elementos chave, controlo, educação ambiental, gestão do turismo, etc.',
            '<b>Actividade</b>: acção pertencente a uma das principais categorias de actividades, executada para alcançar um fim específico',
            'Sem um plano de trabalho/acção, pode referir-se às categorias e às actividades do elemento Processo: gestão e protecção dos elementos chave; relações com as partes interessadas; turismo; monitorização e investigação; etc.',
        ],
    ],
    'ManagementGovernance' => [
        'title' => 'Controlo da área',
        'fields' => [
            'Patrol' => 'A) Área abrangida pelo controlo',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'Patrol' => [
                'A área abrangida pelo controlo é mínima (de 0 a 25% da superfície)',
                'A área abrangida pelo controlo é limitada (de 26 a 50% da superfície)',
                'A área abrangida pelo controlo é razoável (de 51 a 75% da superfície)',
                'A área abrangida pelo controlo é muito boa (mais de 76% da superfície)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Qual é a extensão actual do controlo da gestão e da governação dos elementos chave da área conservada?',
            'A capacidade de assegurar o controlo e a recolha de informação sobre os elementos chave priorizados na gestão e governação da área conservada previne ou minimiza actividades ilegais ou questões litigiosas.',
        ],
        'module_info_Rating' => [
            'Avaliar o controlo dos elementos chave priorizados na gestão e governação da área conservada.',
        ],
    ],
    'AchievedObjectives' => [
        'title' => 'Concretização dos objectivos a longo prazo da gestão e governação da área conservada',
        'fields' => [
            'Objective' => 'Principais Objectivos Geral/Objectivo a longo prazo',
            'EvaluationScore' => 'Nível de alcance dos objectivos',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'nenhum ou muito baixo nível de realização (entre 0 e 25%).',
                'baixo nível de realização (entre 26 e 50%)',
                'nível de realização moderado (entre 51 e 75%)',
                'alto nível de realização (entre 76 e 100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Em que medida a área conservada alcançou os principais objectivos do seu plano de gestão e governação? (Com base na análise do contexto de intervenção, ponto CTX1.5 Visão – Objectivos, ou nos elementos de Planificação, ponto P6 – Objectivos existentes do plano de gestão).',
            'As metas e os objectivos de uma área conservada devem ser claramente compreendidos para que a gestão seja bem-sucedida com base em resultados mensuráveis.',
        ],
        'module_info_Rating' => [
            'Avaliar o nível de concretização das principais metas/objectivos a longo prazo relacionados com os elementos chave da área conservada.',
        ],
    ],
    'KeyElementsImpact' => [
        'title' => 'Efeitos sobre os elementos chave de conservação',
        'fields' => [
            'KeyElement' => 'Elementos chave da conservação',
            'StatusSH' => 'estado',
            'TrendSH' => 'Tendencia',
            'EffectSH' => 'Efeito',
            'ReliabilitySH' => 'Fiabilidade da informação',
            'CommentsSH' => 'Comentários/Explicaçõe',
            'StatusER' => 'estado',
            'TrendER' => 'Tendencia',
            'EffectER' => 'Efeito',
            'ReliabilityER' => 'Fiabilidade da informação',
            'CommentsER' => 'Comentários/Explicaçõe',
        ],
        'from_sa' => 'Das partes interessadas',
        'from_external_source' => 'De fonte externa',
        'groups' => [
            'group0' => 'Espécies animais chave',
            'group1' => 'Espécies vegetais chave',
            'group2' => 'Habitats chave',
        ],
        'module_info_EvaluationQuestion' => [
            'A gestão e a governação exercem efeitos positivos ou negativos sobre os elementos chave de conservação da área conservada?',
            'Um dos principais objectivos da área conservada é obter resultados positivos e sustentados para a conservação in situ da biodiversidade. A comparação das avaliações dos utilizadores directos com as dos utilizadores indirectos e com dados técnicos sobre o mesmo elemento chave permite uma análise e interpretação detalhadas dos resultados, evidenciando observações específicas, discrepâncias, áreas de convergência e eventuais recomendações de alteração ou de adopção de boas práticas. Os resultados da comparação entre a avaliação interna e os dados externos sobre os mesmos elementos chave de conservação podem ser indicados na secção de comentários.',
        ],
        'module_info_Rating' => [
            'Assegurar uma dupla análise de A) estado e B) tendências dos elementos chave de conservação da área conservada, a partir de dados das partes interessadas e de fontes externas',
        ],
        'ratingLegend' => [
            'StatusSH' => [
                '-2' => 'Decrescendo',
                '-1' => 'Decrescendo ligeiramente',
                '0' => 'Sem mudança',
                '+1' => 'Aumento ligeiramente',
                '+2' => 'Aumentando',
            ],
            'TrendSH' => [
                '-2' => 'Decrescendo',
                '-1' => 'Decrescendo ligeiramente',
                '0' => 'Sem mudança',
                '+1' => 'Aumento ligeiramente',
                '+2' => 'Aumentando',
            ],
        ],
    ],
    'LifeQualityImpact' => [
        'title' => 'Impactos sobre as comunidades locais',
        'fields' => [
            'Element' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Efeitos',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Elementos dos padrões materiais do nível de vida',
            'group1' => 'Elementos dos padrões imateriais de nível de vida',
        ],
        'predefined_values' => [
            'group0' => [
                'Segurança alimentar (pequena agricultura, pesca de pequena escala, colheita, caça, etc.)',
                'Empresas locais (transformação da produção agroalimentar, pesca, construção de abrigos para barcos, estacionamento de barcos, produtos florestais, etc.)',
                'Resolução de conflitos entre o homem e a fauna selvagem - compensação',
                'Emprego de recursos humanos locais na área conservada, no turismo, etc.',
                'Recursos naturais em caso de necessidade (p. ex. água, fibras, etc. das áreas conservadas durante crises, ou contribuição material para edifícios sociais como hospitais e escolas)',
                'Fornecimento de energia, ligação eléctrica, abastecimento e ligação de água, construção, manutenção e melhoria de estradas, etc.',
            ],
            'group1' => [
                'Conflitos e reforço da gestão e da utilização sustentáveis dos elementos chave da área conservada (de aprovisionamento e culturais)',
                'Infra-estruturas de educação e de saúde (ou seja, edifícios, água potável)',
                'Serviços educativos (ensino), serviços de saúde (cuidados de saúde)',
                'Serviços culturais (físicos – intelectuais – emblemáticos – espirituais – interacção a partir dos serviços da área conservada)',
                'Resolução de problemas sociais',
                'Identidade e sentido de pertença dos povos indígenas e das comunidades locais (IPLC)',
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '-3' => 'Efeitos altamente prejudiciais',
                '-2' => 'Efeitos nocivos',
                '-1' => 'Efeitos ligeiramente prejudiciais',
                '0' => 'Neutro',
                '+1' => 'Efeitos ligeiramente favoráveis',
                '+2' => 'Efeitos favoráveis',
                '+3' => 'Efeitos altamente favoráveis',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A gestão e a governação da área conservada exercem efeitos positivos ou negativos sobre a qualidade de vida das partes interessadas?',
            'A gestão e a governação da área conservada devem ter grande cuidado com os efeitos sobre a qualidade de vida das partes interessadas locais. A disponibilidade de recursos essenciais pode afectar a qualidade de vida através de impactos no consumo, no rendimento e na riqueza (nível de vida material) e na boa vida, na saúde e nas relações sociais e culturais (nível de vida imaterial).',
        ],
        'module_info_Rating' => [
            'Avaliar os efeitos da gestão e da governação da área conservada sobre as partes interessadas.',
        ],
    ],
    'EmpowermentGovernance' => [
        'title' => 'Partes interessadas, capacitação',
        'fields' => [
            'Conditions' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação da capacitação das partes interessadas',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'groups' => [
            'group0' => 'Envolvimento',
            'group1' => 'RESPONSABILIDADE',
            'group2' => 'ORIENTAÇÃO',
        ],
        'predefined_values' => [
            'group0' => [
                'Representação: mecanismos existentes que assegurem a representação legítima das partes interessadas na tomada de decisão da área conservada',
                'Aceitação: compreensão e reconhecimento dos direitos consuetudinários sobre os serviços ecossistémicos',
                'Aceitação: aceitação social da legitimidade dos direitos legais sobre os serviços ecossistémicos',
                'Orientação para o consenso: tomada de decisão que mantém um diálogo activo e procura o consenso sobre soluções que respondam, pelo menos em parte, às preocupações e aos interesses de todos',
            ],
            'group1' => [
                'Respeito pelos acordos: monitorização do cumprimento dos acordos estabelecidos entre as diferentes partes interessadas',
                'Equidade na relação custo-benefício associada à conservação: maximizar os benefícios ecológicos, sociais, económicos e culturais das áreas conservadas sem incorrer em custos desnecessários nem causar danos às comunidades locais',
                'Eficiência da gestão: aplicação da governação existente dos serviços ecossistémicos de forma eficaz e eficiente na obtenção dos benefícios ecológicos, sociais, económicos e culturais da área conservada',
            ],
            'group2' => [
                'Orientação (Visão): desenvolvimento e aplicação de uma visão estratégica coerente (perspectiva de longo prazo) baseada em valores acordados e na compreensão das complexidades ecológicas, históricas, sociais e culturais',
                'Legalização: promover a legalização dos direitos das partes interessadas na gestão e governação dos serviços ecossistémicos, maximizando os benefícios ecológicos, sociais, económicos e culturais das áreas protegidas e conservadas',
                'Respeito pelos valores: apoiar a melhoria de todos os valores ecológicos, de aprovisionamento, de controlo e culturais da área conservada em benefício das comunidades',
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área conservada',
                '0' => 'totalmente inadequado (0-30% das necessidades)',
                '1' => 'Algo inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A gestão da área conservada promove activamente iniciativas de capacitação das partes interessadas para assegurar um maior envolvimento destas, tendo em vista uma implementação mais eficaz e com maior impacto das medidas de conservação baseadas em áreas?',
            'A capacitação das partes interessadas constitui uma pedra angular na gestão e governação de uma área conservada, desempenhando um papel decisivo na promoção de um envolvimento significativo, da responsabilidade partilhada e da tomada de decisão colaborativa entre partes interessadas diversas. Ao capacitar as partes interessadas, a área conservada procura mobilizar o seu conhecimento, perspectivas e contributos colectivos, conduzindo, em última análise, a uma implementação mais abrangente, sustentável e eficaz das medidas de conservação baseadas em áreas',
        ],
        'module_info_Rating' => [
            'Avaliar a promoção de iniciativas de capacitação das partes interessadas para uma implementação mais abrangente, sustentável e eficaz das medidas de conservação baseadas em áreas',
        ],
    ],
];
