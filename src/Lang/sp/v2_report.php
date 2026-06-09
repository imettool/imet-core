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

    'definitions' => 'Definición de los términos',

    // General elements
    'general_elements' => 'Elementos generales',
    'country' => 'País',
    'name' => 'Nombre',
    'category' => 'Categoría(s)',
    'gazetting' => 'Fecha de declaración oficial',
    'surface' => 'Superficie',
    'agency' => 'Agencia',
    'biome' => 'Bioma',
    'main_values_protected' => 'Principales valores por los que se han declarado las áreas protegidas',
    'vision' => 'Visión',
    'mission' => 'Misión',
    'objectives' => 'Objetivos',

    // Evaluation elements
    'evaluation_elements' => 'Evaluación de los elementos del ciclo de gestión del área protegida',

    // Operation recommendations
    'operation_recommendations' => 'Recomendaciones operativas',

    // Planning options
    'planning_options' => 'Del diagnóstico IMET a las opciones de planificación',
    'planning_options_info' => [
        'general_info' => '<h6 class="font-bold">Del diagnóstico IMET a las opciones de planificación iniciales</h6>
            <p>IMET proporciona un diagnóstico estructurado de los valores ecológicos, las amenazas y los procesos de gestión. Estos resultados
            constituyen la base de un ejercicio sencillo de planificación inicial basado en la Planificación de Acciones de Conservación (CAP, véase:
            <a target="_blank" href="https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf">https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf)</a>
            según la lógica de The Nature Conservancy (TNC). Aunque IMET no sustituye a la CAP, las siguientes tablas pueden utilizarse para
            identificar los elementos, amenazas y acciones prioritarios para los planes de gestión, los planes de trabajo anuales y otras herramientas de planificación',
    ],

    'annexes' => 'Anexos',
    'forest_cover' => 'Cobertura forestal',
    'total_carbon' => 'Carbono total',
    'agricultural_pressure' => 'Presión agrícola',
    'forest_cover_percent' => 'Pérdida y ganancia forestal',
    'forest_loss' => 'Pérdida forestal',
    'forest_gain' => 'Ganancia forestal',
    'min' => 'Mín.',
    'max' => 'Máx.',
    'mean' => 'Media',
    'std_dev' => 'Desv. est.',
    'sum' => 'Suma',
    'protected_area' => 'Área protegida.',
    'unprotected_buffer' => 'Zona de amortiguamiento no protegida de 10 km',

    'ManagementContext' => [
        'title' => 'Contexto de gestión (elementos clave de la gestión)',
        'fields' => [
            'key_species' => 'Especies clave',
            'habitats' => 'Hábitats terrestres y marinos - cobertura del suelo, cambio y ocupación del suelo',
            'climate_change' => 'Valores clave sensibles al cambio climático',
            'ecosystem_services' => 'Servicios ecosistémicos',
            'threats' => 'Amenazas',
        ],
    ],

    'ManagementEffectivenessAnalysis' => [
        'title' => 'Análisis de la eficacia de la gestión (análisis + análisis DAFO)',
        'fields' => [
            'strengths' => 'Fortalezas',
            'weaknesses' => 'Debilidades',
            'opportunities' => 'Oportunidades',
            'threats' => 'Amenazas',
        ],
        'characteristics_elements' => 'Elementos característicos del área protegida en forma de un ejercicio DAFO',
    ],

    'OperatingRecommendations' => [
        'title' => 'Recomendaciones operativas',
    ],

    'KeyQuestions' => [
        'title' => 'Preguntas clave',
        'fields' => [
            'priorities' => '¿Cuáles son sus prioridades de gestión/gobernanza?',
            'minimum_budget' => '¿Cuál es su presupuesto operativo mínimo para garantizar la preservación de los valores y la importancia de su área protegida?',
            'additional_funding' => 'En caso de financiación adicional para la gestión del área protegida, ¿qué acciones le gustaría emprender y durante cuánto tiempo?',
        ],
    ],

    // Planning Options: Table A
    'KeyConservationElements' => [
        'title' => 'Tabla A. Elementos Clave de Conservación (ECC), atributos y servicios',
        'fields' => [
            'num_kce' => 'N.º',
            'kces' => 'Elementos Clave de Conservación (ECC)',
            'targets_and_es' => 'Objetivos secundarios y servicios ecosistémicos primarios',
            'kea' => 'Atributos Ecológicos Clave (AEC)',
            'threats' => 'Amenazas',
            'note' => 'Notas / Justificación',
        ],
        'module_info' => 'Esta tabla A ayuda a los usuarios de IMET a pasar del diagnóstico a la planificación identificando los elementos ecológicos
            más importantes del área protegida, los servicios que prestan, sus características esenciales y las amenazas sobre las que
            actuar. Cada columna desempeña un papel específico en la estructuración de las primeras decisiones de planificación.',
        'definitions' => [
            'kces' => '<span class="font-bold italic">Elementos Clave de Conservación (ECC)</span>: Elementos ecológicos prioritarios (ecosistemas, hábitats, especies paraguas) que deben conservarse. Determinan la dirección principal de las acciones de conservación en el área protegida',
            'targets_es' => '<span class="font-bold italic">Objetivos secundarios y servicios ecosistémicos primarios</span>: Los valores y servicios vinculados al ECC mediante el enfoque de especies paraguas implican que proteger el ECC también protege las especies, hábitats y servicios ecosistémicos asociados',
            'kea' => '<span class="font-bold italic">Atributos Ecológicos Clave (AEC)</span>: Características esenciales (superficie, composición, estructura, tamaño de la población) que definen la integridad del ECC. Los AEC orientan lo que debe mantenerse, monitorearse y mejorarse.',
            'threats' => '<span class="font-bold italic">Amenazas</span>: Presiones que afectan directamente al ECC y a sus AEC (p. ej. caza furtiva, deforestación, minería). Incluya únicamente las amenazas que tengan un impacto real y medible.',
        ],
    ],

    // Planning Options: Table B
    'ThreatsAffectingKCEs' => [
        'title' => 'Tabla B. Amenazas que afectan a los elementos clave de conservación',
        'fields' => [
            'threat' => 'Amenazas',
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
            'impact' => 'Valoración del impacto de la amenaza',
        ],
        'module_info' => 'La tabla B muestra cómo cada amenaza afecta a cada ECC y resalta dónde debe centrar la gestión sus esfuerzos en primer lugar.
             Al situar las amenazas en la primera columna y marcar su impacto sobre los ECC, la matriz ofrece una rápida visión
             visual de los elementos de conservación más expuestos y de las presiones más críticas. Este paso identifica
             las amenazas que requieren atención prioritaria de la gestión y sirve de puente directo hacia la definición de las mejoras necesarias
             y las actividades prioritarias en la tabla C',
        'definitions' => [
            'threats' => '<span class="font-bold italic">Amenazas</span>: Presiones o actividades humanas que afectan negativamente a los Elementos Clave de Conservación (ECC).',
            'kce' => '<span class="font-bold italic">ECC 1–10</span>: Columnas utilizadas para indicar si cada amenaza afecta al ECC correspondiente y con qué intensidad. ',
        ],
        'ratingLegend' => [
            'impact' => [
                '0' => 'Sin amenaza o amenaza demasiado baja para ser considerada',
                '1' => 'Amenaza baja',
                '2' => 'Amenaza media',
                '3' => 'Amenaza alta',
                '4' => 'Amenaza muy alta',
            ],
        ],
    ],

    // Planning Options: Table C
    'InitialPlanningOptions' => [
        'title' => 'Opciones de planificación iniciales (tabla de transición IMET → CAP)',
        'fields' => [
            'conservation_goal' => 'Meta de conservación (a largo plazo)',
            'kea' => 'AEC (atributos a mantener)',
            'main_threat' => 'Principales amenazas a abordar',
            'improvement' => 'Mejoras requeridas',
            'activities' => 'Actividades (año prioritario n.º)',
            'indicators' => 'Indicadores de seguimiento',
        ],
        'module_info' => 'La tabla C traduce el diagnóstico IMET en acciones de conservación prácticas. Partiendo de la meta de conservación a largo plazo
            para cada Elemento Clave de Conservación (ECC), el usuario identifica los atributos ecológicos que deben mantenerse
            y las principales amenazas que obstaculizan esta meta. A continuación, determina las mejoras necesarias para abordar esas amenazas.
            Este análisis orienta luego la selección de las actividades prioritarias, aquellas con mayor probabilidad de reducir las amenazas y fortalecer
            la integridad del ECC. Por último, se definen indicadores de seguimiento sencillos para seguir el progreso y evaluar la eficacia
            de estas actividades. La tabla C proporciona, por tanto, un vínculo operativo directo entre los resultados de IMET y una planificación de gestión
            ejecutable',
        'definitions' => [
            'conservation_goal' => '<span class="font-bold italic">Meta de conservación (a largo plazo)</span>: La condición futura deseada del Elemento Clave de Conservación (ECC) que la gestión pretende alcanzar o mantener.',
            'kea' => '<span class="font-bold italic">AEC (atributos a mantener)</span>: Las características ecológicas esenciales del ECC que deben preservarse (p. ej. superficie, estructura, tamaño de la población).',
            'threats' => '<span class="font-bold italic">Principales amenazas a abordar</span>: Las presiones específicas que impiden alcanzar la meta de conservación.',
            'improvements' => '<span class="font-bold italic">Mejoras requeridas</span>: Los cambios necesarios en la gestión, el estado o la gobernanza para reducir las amenazas y mantener los AEC',
            'activities' => '<span class="font-bold italic">Actividades prioritarias (1–2 años)</span>: Las acciones clave a corto plazo que contribuyen directamente a reducir las amenazas y lograr las mejoras.',
            'monitoring' => '<span class="font-bold italic">Indicadores de seguimiento</span>: Variables sencillas y medibles utilizadas para seguir el progreso hacia la meta de conservación y la eficacia de las actividades.',
        ],
    ],

];
