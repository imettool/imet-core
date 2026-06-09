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

    'definitions' => 'Définition des termes',

    // General elements
    'general_elements' => 'Éléments généraux',
    'country' => 'Pays',
    'name' => 'Nom',
    'category' => 'Catégorie(s)',
    'gazetting' => 'Date de classement',
    'surface' => 'Superficie',
    'agency' => 'Agence',
    'biome' => 'Biome',
    'main_values_protected' => 'Principales valeurs pour lesquelles les aires protégées ont été classées',
    'vision' => 'Vision',
    'mission' => 'Mission',
    'objectives' => 'Objectifs',

    // Evaluation elements
    'evaluation_elements' => 'Évaluation des éléments du cycle de gestion de l\'aire protégée',

    // Operation recommendations
    'operation_recommendations' => 'Recommandations opérationnelles',

    // Planning options
    'planning_options' => 'Du diagnostic IMET aux options de planification',
    'planning_options_info' => [
        'general_info' => '<h6 class="font-bold">Du diagnostic IMET aux premières options de planification</h6>
            <p>IMET fournit un diagnostic structuré des valeurs écologiques, des menaces et des processus de gestion. Ces résultats
            constituent la base d\'un exercice simple de planification initiale fondé sur la Planification des Actions de Conservation (CAP, voir :
            <a target="_blank" href="https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf">https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf)</a>
            selon la logique de The Nature Conservancy (TNC). Bien qu\'IMET ne remplace pas la CAP, les tableaux suivants peuvent être utilisés pour
            identifier les éléments, menaces et actions prioritaires pour les plans de gestion, les plans de travail annuels et d\'autres outils de planification',
    ],

    'annexes' => 'Annexes',
    'forest_cover' => 'Couverture forestière',
    'total_carbon' => 'Carbone total',
    'agricultural_pressure' => 'Pression agricole',
    'forest_cover_percent' => 'Perte et gain forestiers',
    'forest_loss' => 'Perte forestière',
    'forest_gain' => 'Gain forestier',
    'min' => 'Min.',
    'max' => 'Max.',
    'mean' => 'Moyenne',
    'std_dev' => 'Écart-type',
    'sum' => 'Somme',
    'protected_area' => 'Aire protégée.',
    'unprotected_buffer' => 'Zone tampon non protégée de 10 km',

    'ManagementContext' => [
        'title' => 'Contexte de gestion (éléments clés de la gestion)',
        'fields' => [
            'key_species' => 'Espèces clés',
            'habitats' => 'Habitats terrestres et marins - couverture du sol, changement et accaparement des terres',
            'climate_change' => 'Valeurs clés sensibles au changement climatique',
            'ecosystem_services' => 'Services écosystémiques',
            'threats' => 'Menaces',
        ],
    ],

    'ManagementEffectivenessAnalysis' => [
        'title' => 'Analyse de l\'efficacité de la gestion (analyse + analyse SWOT)',
        'fields' => [
            'strengths' => 'Forces',
            'weaknesses' => 'Faiblesses',
            'opportunities' => 'Opportunités',
            'threats' => 'Menaces',
        ],
        'characteristics_elements' => 'Éléments caractéristiques de l\'aire protégée sous la forme d\'un exercice SWOT',
    ],

    'OperatingRecommendations' => [
        'title' => 'Recommandations opérationnelles',
    ],

    'KeyQuestions' => [
        'title' => 'Questions clés',
        'fields' => [
            'priorities' => 'Quelles sont vos priorités de gestion/gouvernance ?',
            'minimum_budget' => 'Quel est votre budget de fonctionnement minimal pour assurer la préservation des valeurs et de l\'importance de votre aire protégée ?',
            'additional_funding' => 'En cas de financement supplémentaire pour la gestion de l\'aire protégée, quelles actions souhaiteriez-vous mener et pendant combien de temps ?',
        ],
    ],

    // Planning Options: Table A
    'KeyConservationElements' => [
        'title' => 'Tableau A. Éléments Clés de Conservation (ECC), attributs et services',
        'fields' => [
            'num_kce' => 'N°',
            'kces' => 'Éléments Clés de Conservation (ECC)',
            'targets_and_es' => 'Cibles secondaires et services écosystémiques primaires',
            'kea' => 'Attributs Écologiques Clés (AEC)',
            'threats' => 'Menaces',
            'note' => 'Notes / Justification',
        ],
        'module_info' => 'Ce tableau A aide les utilisateurs d\'IMET à passer du diagnostic à la planification en identifiant les éléments écologiques
            les plus importants de l\'aire protégée, les services qu\'ils fournissent, leurs caractéristiques essentielles et les menaces sur
            lesquelles il faut agir. Chaque colonne joue un rôle spécifique dans la structuration des premières décisions de planification.',
        'definitions' => [
            'kces' => '<span class="font-bold italic">Éléments Clés de Conservation (ECC)</span> : Éléments écologiques prioritaires (écosystèmes, habitats, espèces parapluies) qui doivent être conservés. Ils déterminent l\'orientation principale des actions de conservation dans l\'aire protégée',
            'targets_es' => '<span class="font-bold italic">Cibles secondaires et services écosystémiques primaires</span> : Les valeurs et services liés à l\'ECC par l\'approche des espèces parapluies signifient que protéger l\'ECC protège également les espèces, habitats et services écosystémiques associés',
            'kea' => '<span class="font-bold italic">Attributs Écologiques Clés (AEC)</span> : Caractéristiques essentielles (superficie, composition, structure, taille de la population) qui définissent l\'intégrité de l\'ECC. Les AEC guident ce qui doit être maintenu, suivi et amélioré.',
            'threats' => '<span class="font-bold italic">Menaces</span> : Pressions qui affectent directement l\'ECC et ses AEC (p. ex. braconnage, déforestation, exploitation minière). N\'incluez que les menaces ayant un impact réel et mesurable.',
        ],
    ],

    // Planning Options: Table B
    'ThreatsAffectingKCEs' => [
        'title' => 'Tableau B. Menaces affectant les éléments clés de conservation',
        'fields' => [
            'threat' => 'Menaces',
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
            'impact' => 'Notation de l\'impact de la menace',
        ],
        'module_info' => 'Le tableau B montre comment chaque menace affecte chaque ECC et met en évidence les points sur lesquels la gestion doit concentrer ses efforts en priorité.
             En plaçant les menaces dans la première colonne et en indiquant leur impact sur les ECC, la matrice offre un aperçu visuel rapide
             des éléments de conservation les plus exposés et des pressions les plus critiques. Cette étape identifie
             les menaces qui requièrent en priorité l\'attention de la gestion et sert de lien direct vers la définition des améliorations nécessaires
             et des activités prioritaires dans le tableau C',
        'definitions' => [
            'threats' => '<span class="font-bold italic">Menaces</span> : Pressions ou activités humaines qui affectent négativement les Éléments Clés de Conservation (ECC).',
            'kce' => '<span class="font-bold italic">ECC 1–10</span> : Colonnes utilisées pour indiquer si chaque menace affecte l\'ECC correspondant et à quelle intensité. ',
        ],
        'ratingLegend' => [
            'impact' => [
                '0' => 'Aucune menace ou menace trop faible pour être prise en compte',
                '1' => 'Menace faible',
                '2' => 'Menace moyenne',
                '3' => 'Menace élevée',
                '4' => 'Menace très élevée',
            ],
        ],
    ],

    // Planning Options: Table C
    'InitialPlanningOptions' => [
        'title' => 'Options de planification initiales (tableau de transition IMET → CAP)',
        'fields' => [
            'conservation_goal' => 'But de conservation (à long terme)',
            'kea' => 'AEC (attributs à maintenir)',
            'main_threat' => 'Principales menaces à traiter',
            'improvement' => 'Améliorations requises',
            'activities' => 'Activités (année prioritaire n°)',
            'indicators' => 'Indicateurs de suivi',
        ],
        'module_info' => 'Le tableau C traduit le diagnostic IMET en actions de conservation concrètes. À partir du but de conservation à long terme
            pour chaque Élément Clé de Conservation (ECC), l\'utilisateur identifie les attributs écologiques qui doivent être maintenus
            et les principales menaces qui entravent ce but. Il détermine ensuite les améliorations nécessaires pour traiter ces menaces.
            Cette analyse oriente alors le choix des activités prioritaires, celles les plus susceptibles de réduire les menaces et de renforcer
            l\'intégrité de l\'ECC. Enfin, des indicateurs de suivi simples sont définis pour suivre les progrès et évaluer l\'efficacité
            de ces activités. Le tableau C établit donc un lien opérationnel direct entre les résultats d\'IMET et une planification de gestion
            actionnable',
        'definitions' => [
            'conservation_goal' => '<span class="font-bold italic">But de conservation (à long terme)</span> : L\'état futur souhaité de l\'Élément Clé de Conservation (ECC) que la gestion vise à atteindre ou à maintenir.',
            'kea' => '<span class="font-bold italic">AEC (attributs à maintenir)</span> : Les caractéristiques écologiques essentielles de l\'ECC qui doivent être préservées (p. ex. superficie, structure, taille de la population).',
            'threats' => '<span class="font-bold italic">Principales menaces à traiter</span> : Les pressions spécifiques qui empêchent l\'atteinte du but de conservation.',
            'improvements' => '<span class="font-bold italic">Améliorations requises</span> : Les changements nécessaires dans la gestion, l\'état ou la gouvernance pour réduire les menaces et maintenir les AEC',
            'activities' => '<span class="font-bold italic">Activités prioritaires (1–2 ans)</span> : Les actions clés à court terme qui contribuent directement à réduire les menaces et à réaliser les améliorations.',
            'monitoring' => '<span class="font-bold italic">Indicateurs de suivi</span> : Variables simples et mesurables utilisées pour suivre les progrès vers le but de conservation et l\'efficacité des activités.',
        ],
    ],

];
