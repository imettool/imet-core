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
        'title' => 'Estableciendo objetivos',
        'fields' => [
            'Element' => 'Elemento / indicador',
            'Status' => 'Linea base',
            'Objective' => 'Objetivo – Estado óptimo o favorable',
            'comments' => 'Observaciones',
        ],
    ],
    'Designation' => [
        'title' => 'Designaciones',
        'fields' => [
            'Aspect' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Integración',
            'SignificativeClassification' => 'Designación altamente significativa',
            'IncludeInStatistics' => '¿Debería ser una prioridad en la gestión?',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'no hay integración',
                'baja integración',
                'integración moderada',
                'alta integración',
            ],
        ],
        'module_subTitle' => 'Valor e importancia - Designaciones',
        'module_info_EvaluationQuestion' => [
            'Evaluar la integración de los valores y de la importancia de las designaciones (designación nacional y designaciones internacionales, p. ej. sitio del Patrimonio Mundial o sitio Ramsar) para la gestión del área conservada',
        ],
        'warning_on_save' => '¡¡ATENCIÓN!! <br /> Cualquier modificación puede causar pérdida de datos en los siguientes módulos (si ya están rellenados): <i>I1, PR6</i>',
    ],
    'KeyElements' => [
        'title' => 'Elementos clave del área conservada',
        'fields' => [
            'Aspect' => 'Elemento clave / servicio',
            'Importance' => 'Importancia',
            'EvaluationScore' => 'Integración',
            'IncludeInStatistics' => '¿Debería ser una prioridad en la gestión?',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Servicios de los ecosistemas',
            'group1' => 'Elementos clave de la biodiversidad',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'no hay integración',
                'baja integración',
                'integración moderada',
                'alta integración',
            ],
        ],
        'module_subTitle' => 'Elementos clave animales, plantas, hábitats (protegidos, explotados, en desaparición, invasores, etc.) y servicios (aprovisionamiento, control, culturales, de apoyo)',
        'module_info_EvaluationQuestion' => [
            '¿Ha priorizado el área conservada los elementos clave en su gestión? La evaluación debe apreciar la necesidad de priorizar los elementos clave en la gestión y gobernanza del área conservada. La evaluación utiliza una lista de clasificación basada en los análisis de SA1, SA2 y C3.1.1.',
        ],
        'module_info_Rating' => [
            'Evaluar la necesidad de priorizar los elementos clave en la gestión y gobernanza del área conservada',
        ],
        'from_group' => 'De la categoría',
        'key_elements_importance_composition' => 'Composición de la importancia: :imp_dir (de :num_dir parte(s) interesada(s) directa(s)) + :imp_ind (de :num_ind parte(s) interesada(s) indirecta(s))',
        'num_stakeholders' => 'Indicado por :num_dir parte(s) interesada(s) directa(s) y :num_ind parte(s) interesada(s) indirecta(s)',
        'ranking' => 'Clasificación',
        'warning_on_save' => '¡¡ATENCIÓN!! <br /> Cualquier modificación puede causar pérdida de datos en los siguientes módulos (si ya están rellenados): <i>P6, I1, PR6</i>',
    ],
    'SupportsAndConstraints' => [
        'title' => 'Restricciones o apoyos de las partes interesadas',
        'fields' => [
            'Stakeholder' => 'Parte interesada',
            'Weight' => 'Implicación de la parte interesada (0-100)',
            'ConstraintLevel' => 'Nivel de la restricción/conflicto o del apoyo/cumplimiento',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Usuarios directos',
            'group1' => 'Usuarios indirectos',
        ],
        'ratingLegend' => [
            'ConstraintLevel' => [
                '-3' => 'Severas limitaciones/conflictos generadas por este actor',
                '-2' => 'Restricciones generadas por este actor',
                '-1' => 'Algunas limitaciones/conflictos generadas por este actor',
                '0' => 'No existe apoyo/cumplimiento por parte de este actor',
                '+1' => 'Algo de apoyo/cumplimiento por parte de este actor',
                '+2' => 'Apoyo/cumplimiento por parte de este actor',
                '+3' => 'Apoyo/cumplimiento importante por parte de este actor',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Las restricciones/conflictos o los apoyos/conformidades de las partes interesadas pueden medirse por su intensidad al restringir/entrar en conflicto o apoyar/cumplir con el área conservada',
        ],
        'module_info_Rating' => [
            'Evaluar las restricciones/conflictos o los factores de apoyo/conformidad más importantes del entorno político, institucional y social en la gestión del área conservada',
        ],
    ],
    'SupportsAndConstraintsIntegration' => [
        'title' => 'Integración de las restricciones o apoyos de las partes interesadas en la gestión y la gobernanza',
        'fields' => [
            'Stakeholder' => 'Parte interesada',
            'Integration' => 'Integración',
            'IncludeInStatistics' => '¿Debería ser una prioridad en la gestión?',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Usuarios directos',
            'group1' => 'Usuarios indirectos',
        ],
        'ratingLegend' => [
            'Integration' => [
                'no hay integración',
                'baja integración',
                'integración moderada',
                'alta integración',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'La evaluación aprecia la necesidad de priorizar la minimización de las restricciones a la gestión o la maximización del apoyo de las partes interesadas en la gestión del área conservada. La evaluación utiliza la lista de clasificación basada en la integración de las puntuaciones de restricción/conflicto (C2.1) o de apoyo/conformidad de las partes interesadas con los valores de implicación de las partes interesadas en la gestión del área conservada (SA1 del contexto de intervención).',
        ],
        'module_info_Rating' => [
            'Evaluar la integración actual, en la gestión, de las restricciones o apoyos de las partes interesadas',
        ],
        'ranking' => 'Clasificación (C2.1)',
        'warning_on_save' => '¡¡ATENCIÓN!! <br /> Cualquier modificación puede causar pérdida de datos en los siguientes módulos (si ya están rellenados): <i>I1, PR6</i>',
    ],
    'ThreatsBiodiversity' => [
        'title' => 'Análisis de las amenazas a los elementos clave de biodiversidad del área conservada',
        'fields' => [
            'Criteria' => 'Criterio',
            'Impact' => 'Impacto/Severidad',
            'Extension' => 'Escala/Extensión',
            'Duration' => 'Duración/Irreversibilidad',
            'Trend' => 'Tendencia',
            'Probability' => 'Probabilidad de una amenaza en el futuro',
            'Note' => 'Nota',
        ],
        'groups' => [
            'group0' => 'Animales',
            'group1' => 'Plantas',
            'group2' => 'Hábitats',
        ],
        'ratingLegend' => [
            'Impact' => [
                'Leve',
                'Moderado',
                'alto',
                'Grave',
            ],
            'Extension' => [
                'Localizado <5%',
                'Disperso 5-15%',
                'Ampliamente disperso 15-50%',
                'En todas partes >50%',
            ],
            'Duration' => [
                'Corto plazo < 5 años',
                'Medio plazo 5-20 años',
                'Muy largo plazo 20-100 años',
                'Permanente >100 años',
            ],
            'Trend' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'Sin cambios',
                '1' => 'Ligeramente creciente',
                '2' => 'Incrementa',
            ],
            'Probability' => [
                'muy bajo',
                'bajo',
                'Promedio',
                'alto',
            ],
        ],
        'module_info' => 'Evaluar el nivel de las amenazas que afectan al elemento clave de biodiversidad identificado en CTX4.1, CTX4.2, CTX4.3',
    ],
    'Threats' => [
        'title' => 'Análisis de las amenazas al área conservada',
        'fields' => [
            'Value' => 'Valores',
            'Impact' => 'Impacto/Severidad',
            'Extension' => 'Escala/Extensión',
            'Duration' => 'Duración/Irreversibilidad',
            'Trend' => 'Tendencia',
            'Probability' => 'Probabilidad de una amenaza en el futuro',
        ],
        'ratingLegend' => [
            'Impact' => [
                'Leve',
                'Moderado',
                'alto',
                'Grave',
            ],
            'Extension' => [
                'Localizado <5%',
                'Disperso 5-15%',
                'Ampliamente disperso 15-50%',
                'En todas partes >50%',
            ],
            'Duration' => [
                'Corto plazo < 5 años',
                'Medio plazo 5-20 años',
                'Muy largo plazo 20-100 años',
                'Permanente >100 años',
            ],
            'Trend' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'Sin cambios',
                '1' => 'Ligeramente creciente',
                '2' => 'Incrementa',
            ],
            'Probability' => [
                'muy bajo',
                'bajo',
                'Promedio',
                'alto',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Ha identificado claramente el área conservada, en su gestión, las amenazas que podrían afectar a la biodiversidad, el patrimonio cultural o los servicios ecosistémicos del área?',
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de las amenazas más importantes en la gestión del área conservada a partir del análisis de la calculadora de amenazas en el punto SA 2 del Contexto de intervención, reportado automáticamente más abajo',
        ],
        'num_stakeholders' => 'Indicado por :num_dir parte(s) interesada(s) directa(s) y :num_ind parte(s) interesada(s) indirecta(s)',
    ],
    'ThreatsIntegration' => [
        'title' => 'Integración de las amenazas',
        'fields' => [
            'Threat' => 'Amenaza',
            'Integration' => 'Integración',
            'IncludeInStatistics' => '¿Debería ser una prioridad en la gestión?',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'Integration' => [
                'no hay integración',
                'baja integración',
                'integración moderada',
                'alta integración',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'La evaluación aprecia la necesidad de priorizar las amenazas para minimizar sus efectos y su impacto en la gestión del área conservada. La evaluación utiliza una lista de clasificación basada en el análisis de amenazas de SA.2 y C3.1.2',
        ],
        'module_info_Rating' => [
            'Evaluar la integración actual de las amenazas en la gestión del área conservada',
        ],
        'ranking' => 'Clasificación (C3.1)',
        'warning_on_save' => '¡¡ATENCIÓN!! <br /> Cualquier modificación puede causar pérdida de datos en los siguientes módulos (si ya están rellenados): <i>I1, PR6</i>',
    ],
    'RegulationsAdequacy' => [
        'title' => 'Adecuación de las disposiciones legales y reglamentarias',
        'fields' => [
            'Regulation' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Publicación oficial y designación (p. ej. área conservada, bosque comunitario)',
            'Claridad de la demarcación legal del área conservada (p. ej. límites naturales como ríos, límites no naturales, derechos consuetudinarios, enclaves).',
            'Normas internas para la gestión del área conservada',
            'Ratificación y aplicación de las convenciones internacionales (CITES, CDB, Nagoya, CMS, Patrimonio Mundial, RAMSAR, etc.)',
            'Leyes establecidas localmente sobre el área conservada y la conservación (vedas espaciales y temporales de recolección, caza y pesca; límites de cuotas para el control del número y el tamaño de las embarcaciones; prohibiciones de métodos o artes de recolección, caza o pesca, etc.)',
            'Leyes ambientales nacionales (gestión de los recursos naturales, conservación, área conservada)',
            'Otras leyes nacionales (derechos sobre la tierra y la propiedad, impuestos, legislación mercantil, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuado',
                '1' => 'Algo inadecuado',
                '2' => 'Adecuado',
                '3' => 'Completamente adecuado',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuadas las disposiciones legales y reglamentarias actuales para las actividades de conservación y de gestión de los recursos naturales en el área conservada?',
            '<i>Una legislación y unas disposiciones reglamentarias adecuadas son la base de un marco de gobernanza y gestión eficaz y robusto para el área conservada y, sobre todo, para asegurar su sostenibilidad a largo plazo para las generaciones actuales y futuras</i>',
        ],
        'module_info_Rating' => [
            'Identificar y evaluar la adecuación de las disposiciones legales y reglamentarias actuales para la conservación y la gestión de los recursos naturales en el área conservada',
        ],
    ],
    'DesignAdequacy' => [
        'title' => 'Diseño y configuración del área conservada',
        'fields' => [
            'Values' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Tamaño (superficie)',
            'Configuración o forma del área conservada',
            'Integración de la zona limítrofe (exterior al área conservada, con normas especiales de uso de los recursos para la integridad de la cuenca hidrográfica, corredores para la fauna, actividades de recolección, caza y pesca, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuado',
                '1' => 'Algo inadecuado',
                '2' => 'Adecuado',
                '3' => 'Completamente adecuado',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuados el diseño y la configuración del área conservada para la gestión y la gobernanza sostenibles de sus elementos clave?',
            'El análisis debe mostrar si el diseño y la configuración son adecuados para la gestión y la gobernanza sostenibles de los elementos clave, o si debe proponerse una configuración mejorada, si es viable.',
        ],
        'module_info_Rating' => [
            'Evaluar si el diseño y la configuración del área conservada (a partir del análisis del punto CTX2 del Contexto de intervención) son adecuados para asegurar que sus elementos clave puedan gestionarse bien.',
        ],
    ],
    'BoundaryLevel' => [
        'title' => 'Demarcación del área conservada',
        'fields' => [
            'Boundaries' => 'Grado de los límites marcados',
            'BoundariesComments' => 'Comentarios/explicaciones',
            'Adequacy' => 'Adecuación de los límites',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Correspondencia de los límites marcados con respecto a la situación jurídica',
            'Adecuación de los límites marcados',
            'Límites marcados por elementos naturales (por ejemplo, ríos)',
            'Límites claramente demarcados, inequívocos y, por lo tanto, fáciles de interpretar (por ejemplo, señales, postes, marcadores, cercas, boyas, etc.)',
            'Reconocimiento de los límites por parte de las autoridades',
            'Reconocimiento de los límites por parte de las comunidades/usuarios',
            'Enfoque de colaboración que incluye agencias nacionales y partes interesadas relevantes en la demarcación de fronteras',
            'Publicación de información de la demarcación de fronteras',
            'Demarcación y desarrollo de los límites legales en consonancia con los estatutos jurídicos y el derecho internacional, de ser necesario',
            'Demarcación utilizando la fuente oficial de datos de referencia',
            'Límites registrados con coordenadas geográficas (grado, min, seg)',
            'Demarcación de las zonas de uso de la AP (zonificación)',
            'Demarcación de límites, o parte de ellos, que son ambulatorios [por ejemplo, riberas, ríos, etc.] y que pueden necesitar ser revisados',
            'Demarcación por elementos naturales mediante una declaración clara (por ejemplo, datos de las mareas o de las inundaciones fluviales: bajamar media, pleamar media, etc.)',
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
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuada (Falta de correspondencia con el marco legal / demarcada aleatoriamente, 0-30% de las necesidades)',
                '1' => 'Algo inadecuada (Correspondencia inadecuada con el marco legal / demarcación ambigua, 31-60% de las necesidades)',
                '2' => 'Adecuada (Correspondencia bastante adecuada con el marco legal / no claramente demarcada, 61-90% de las necesidades)',
                '3' => 'Totalmente adecuada (Correspondencia total con el marco legal / claramente demarcada, 91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Está marcado y es adecuado el límite del área conservada?',
            'La demarcación de las áreas conservadas es útil desde el punto de vista jurídico, ya que permite definir exactamente dónde pueden aplicarse los controles específicos del área conservada (p. ej. el seguimiento y las sanciones pueden aplicarse en caso de uso no sostenible de los elementos clave).',
        ],
        'module_info_Rating' => [
            'Evaluar <ol type="A"><li>el grado en que están marcados los límites de las áreas conservadas</li><li>la adecuación de la demarcación de los límites para la gestión del área conservada</li></ol>',
        ],
    ],
    'ManagementPlan' => [
        'title' => 'Plan de Gestión, Plan Rector o Plan de Manejo',
        'fields' => [
            'PlanExistence' => 'A) ¿Existe un plan de gestión?',
            'PrintedCopy' => '¿Dispone la entidad de gestión de una copia impresa?',
            'KnowledgePercentage' => 'Porcentaje de miembros o empleados a quienes se explicó el plan',
            'PlanUptoDate' => '¿Está actualizado el plan de gestión?',
            'PlanApproved' => '¿Se ha aprobado el plan de gestión?',
            'PlanImplemented' => '¿Se ha implementado el plan de gestión?',
            'PlanAdequacyScore' => 'B) Adecuación en cuanto a la claridad y la aplicabilidad del plan de gestión',
            'Comments' => 'Comentarios / Explicación',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                'menos del 10%',
                '10–50%',
                '51%-80%',
                'más del 80%',
            ],
            'PlanAdequacyScore' => [
                'La claridad y la aplicabilidad de la visión, la misión y los objetivos son completamente inadecuadas (0-30% de las necesidades)',
                'La claridad y la aplicabilidad de la visión, la misión y los objetivos son algo inadecuados (31-60% de las necesidades)',
                'La claridad y la aplicabilidad de la visión, la misión y los objetivos son adecuados (61-90% de las necesidades)',
                'La claridad y la aplicabilidad de la visión, la misión y los objetivos son plenamente adecuados (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Existe un plan de gestión? En caso afirmativo, ¿es adecuado y práctico de implementar para el área conservada?',
            'El Plan de Gestión es un documento que define el enfoque y los objetivos de gestión. Es esencial para el éxito del plan la consulta más amplia posible a las partes interesadas y la definición de objetivos que puedan ser acordados y respetados por todos quienes tienen interés en el uso y la supervivencia continuada del área en cuestión (de IUCN/WDPA: Guidelines for recognising and reporting other effective area-based conservation measures, 2017)',
        ],
        'module_info_Rating' => [
            'Evaluar: A) el estado del plan de gestión, B) la adecuación en cuanto a la claridad y la aplicabilidad:',
        ],
    ],
    'WorkPlan' => [
        'title' => 'Plan de trabajo',
        'fields' => [
            'PlanExistence' => 'A) ¿Existe un plan de trabajo? Sí/no',
            'PrintedCopy' => '¿Dispone la entidad de gestión de una copia impresa?',
            'KnowledgePercentage' => 'Porcentaje de miembros o empleados a quienes se explicó el plan',
            'PlanUptoDate' => '¿Está actualizado el plan de trabajo (cubriendo el periodo actual)? Sí/no',
            'PlanApproved' => '¿Ha sido aprobado oficialmente el plan de trabajo? Sí/no',
            'PlanImplemented' => '¿Se ha implementado el plan de trabajo o el plan de seguimiento? Sí/no',
            'PlanAdequacyScore' => 'B) Adecuación en cuanto a la claridad y la aplicabilidad de las actividades y los resultados establecidos en el plan de trabajo/acción o en el plan de seguimiento',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                'menos del 10%',
                '10–50%',
                '51%-80%',
                'más del 80%',
            ],
            'PlanAdequacyScore' => [
                'La claridad y la aplicabilidad de las actividades y los resultados previstos son totalmente inadecuados',
                'La claridad y la aplicabilidad de las actividades y los resultados previstos son algo inadecuados',
                'La claridad y la aplicabilidad de las actividades y los resultados previstos son adecuadas',
                'La claridad y la aplicabilidad de las actividades y los resultados previstos son plenamente adecuados',
            ],
        ],
        'module_info_Rating' => 'Evaluar: A) el estado del plan de trabajo, B) la claridad y la aplicabilidad de las actividades y resultados establecidos en el plan de trabajo',
        'module_info_EvaluationQuestion' => [
            '¿Existe un plan de trabajo? En caso afirmativo, ¿es adecuado y práctico de implementar para el área conservada?',
            'Un plan de trabajo describe las actividades específicas que deben implementarse y permite seguir los progresos en la obtención de los resultados del área conservada. Proporciona la información necesaria para medir el éxito del área conservada en sus esfuerzos de conservación (efectos).',
        ],
    ],
    'Objectives' => [
        'title' => 'Objetivos del área conservada',
        'fields' => [
            'Objective' => 'Objetivo',
            'Existence' => 'Existente en el plan de gestión',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Adecuación de los objetivos del plan de gestión para los elementos clave',
            'group1' => 'Objetivos prospectivos para los elementos clave priorizados en la gestión, reportados automáticamente desde el Contexto de gestión',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuados los objetivos definidos para el área conservada?',
            'Las metas y los objetivos del área conservada deben comprenderse claramente. Deben estar bien definidos y formulados de modo que faciliten el seguimiento, pero también deben estar relacionados con los valores clave del área conservada (es decir, especies o ecosistemas importantes) o con las principales áreas de la actividad de gestión (p. ej. turismo, educación).',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de los objetivos del plan de gestión a los elementos clave del área conservada, a partir de los objetivos existentes en el plan de gestión y en el Contexto de gestión',
        ],
        'warning_on_save' => '¡¡ATENCIÓN!! <br /> Cualquier modificación puede causar pérdida de datos en los siguientes módulos (si ya están rellenados): <i>O/C1</i>',
    ],
    'ObjectivesContext' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para el Contexto de gestión del área conservada. Los objetivos enumerados a continuación se utilizarán para mejorar la gestión y, más concretamente, para las fases de planificación, de movilización de recursos (insumos) y de proceso, así como para el seguimiento de las actividades de gestión del área conservada.',
    ],
    'ObjectivesPlanification' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para la planificación del área conservada<br />Los objetivos enumerados a continuación se utilizarán para mejorar la gestión y, más concretamente, para las fases de planificación, de movilización de recursos (insumos) y de proceso, así como para el seguimiento de las actividades de gestión del área conservada.',
    ],
    'InformationAvailability' => [
        'title' => 'Información básica',
        'fields' => [
            'Element' => 'Clasificación - Concepto medido - Variables',
            'EvaluationScore' => 'Disponibilidad de información',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'No hay o hay poca información disponible para ayudar en la gestión (0-30% de las necesidades)',
                'Información disponible muy limitada - insuficiente para apoyar la gestión (31-60% de las necesidades)',
                'Información disponible pero moderadamente suficiente para ayudar a la gestión (61-90% de las necesidades)',
                'Información disponible y en gran medida suficiente para ayudar a la gestión (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Dispone de información suficiente y relevante para apoyar el proceso de toma de decisiones del área conservada?',
            'Una gestión eficaz del área conservada exige conocimiento e información suficientes para fundamentar la toma de decisiones. Sin información, es muy improbable que exista una buena gestión.',
        ],
        'module_info_Rating' => [
            'Evaluar la disponibilidad de la información necesaria para apoyar la gestión de los elementos clave del área conservada, priorizados en la gestión, reportados automáticamente desde el Contexto de gestión',
        ],
    ],
    'CapacityAdequacy' => [
        'title' => 'Capacidades de gestión y gobernanza',
        'fields' => [
            'Member' => 'Miembro',
            'Weight' => 'Implicación',
            'Adequacy' => 'Adecuación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Composición y personal o miembros de la Entidad de Gestión (reportado automáticamente por CTX 3.1.2)',
            'group1' => 'Partes interesadas implicadas en la gestión o el uso de los recursos naturales (reportado automáticamente por SA.1 y SA.2).',
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'Capacidades del personal inexistentes o muy bajas (0-30% de las necesidades)',
                'Capacidades de personal insuficientes (31-60% de las necesidades)',
                'Capacidades del personal adecuadas, pero se requieren mejoras adicionales (61-90% de las necesidades)',
                'Capacidades del personal completamente suficientes (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Tiene la entidad o entidades responsables de la gestión y la gobernanza capacidad suficiente para gestionar y gobernar el área conservada?',
        ],
        'module_info_Rating' => [
            'Unos recursos humanos cualificados, competentes, comprometidos y adecuados son fundamentales para el éxito de las áreas conservadas.',
        ],
    ],
    'BudgetAdequacy' => [
        'title' => 'Presupuesto actual',
        'fields' => [
            'EvaluationScore' => 'Adecuación del presupuesto actual',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'Sin presupuesto (0% de las necesidades)',
                'Insuficiente incluso para las actividades de gestión esenciales (entre el 1 y el 25% de las necesidades)',
                'Insuficiente para muchas actividades de gestión (26-50% de las necesidades)',
                'Adecuado para las actividades esenciales de gestión (entre el 51 y el 70% de las necesidades)',
                'Adecuado para muchas, pero no todas las actividades (entre el 71% y el 90% de las necesidades)',
                'Adecuado para todas las actividades (91% o más de los requisitos)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Es adecuado el presupuesto actual para una gestión apropiada del área conservada?',
            'Las áreas conservadas preparan sus presupuestos operativos anuales cada año o para varios años. Los documentos esenciales de planificación financiera y presupuestaria son necesarios para mejorar la eficiencia y la eficacia operativas.',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de la financiación del año en curso del área conservada en relación con los requisitos de conservación (a partir del análisis del contexto de intervención, punto CTX 3.2)',
        ],
    ],
    'BudgetSecurization' => [
        'title' => 'Seguridad del presupuesto',
        'fields' => [
            'Percentage' => 'A) Evaluar, en porcentaje, la "Seguridad de financiamiento futuro"',
            'EvaluationScore' => 'B) Evaluar, en años, el "Período de seguridad del financiamiento futuro".',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'Percentage' => [
                'Las necesidades financieras básicas para la gestión del área conservada no están aseguradas (0–20% de las necesidades aseguradas)',
                'Las necesidades financieras básicas para la gestión del área conservada están muy débilmente aseguradas (21–40% de las necesidades aseguradas)',
                'Las necesidades financieras básicas para la gestión del área conservada están débilmente aseguradas (41-60% de las necesidades aseguradas)',
                'Las necesidades financieras básicas para la gestión del área conservada están parcialmente aseguradas (61–75% de las necesidades aseguradas)',
                'Las necesidades financieras básicas para la gestión del área conservada están relativamente bien aseguradas (76-90% de las necesidades aseguradas)',
                'Las necesidades financieras básicas para la gestión del área conservada están aseguradas (> 90% de las necesidades aseguradas)',
            ],
            'EvaluationScore' => [
                'Las necesidades financieras básicas para la gestión del área conservada están aseguradas solo para 1 año (año en curso)',
                'Las necesidades financieras básicas para la gestión del área conservada están aseguradas para 2 años (año en curso +1 año)',
                'Las necesidades financieras básicas para la gestión del área conservada están aseguradas para 3 años (año en curso +2 años)',
                'Las necesidades financieras básicas para la gestión del área conservada están aseguradas para 4 – y más años. (año en curso +3 años y más)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Qué parte del presupuesto necesario está asegurada, y por cuánto tiempo, para cubrir las necesidades básicas de gestión del área conservada?',
            'Un presupuesto seguro y fiable es fundamental para la planificación y la gestión del área conservada, para actividades de gran escala y de largo plazo.',
        ],
        'module_info_Rating' => [
            'Evaluar: A) la seguridad de la financiación y B) el periodo de seguridad de la financiación para los próximos años en relación con los requisitos de conservación en el área conservada',
        ],
    ],
    'ManagementEquipmentAdequacy' => [
        'title' => 'Infraestructura, equipo e instalaciones',
        'fields' => [
            'Equipment' => 'Criterios - Concepto medido - Variable',
            'Adequacy' => 'A) Adecuación de la infraestructura, el equipo y las instalaciones (CTX 3.3)',
            'PresentNeeds' => 'B) Necesidades actuales de disponibilidad para la gestión del área conservada',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'adequacy' => 'Adecuación de la infraestructura, el equipo y las instalaciones',
        'ratingLegend' => [
            'Adequacy' => [
                'Totalmente inadecuado (0-30% de las necesidades)',
                'Algo inadecuado (31-60% de las necesidades)',
                'Adecuado (61-90% de las necesidades)',
                'Totalmente adecuado (91-100% de las necesidades)',
            ],
            'PresentNeeds' => [
                'Normal',
                'alto',
                'Muy alto',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuados las infraestructuras, los equipamientos y las instalaciones del área conservada para los requisitos de gestión? Las infraestructuras, los equipamientos y las instalaciones son importantes para asegurar y mejorar la eficiencia y la eficacia operativas del área conservada.',
        ],
        'module_info_Rating' => [
            'Evaluar: A) la adecuación de las infraestructuras, los equipamientos y las instalaciones (resultados calculados automáticamente a partir del análisis del contexto de intervención, punto CTX 3.3), B) las necesidades actuales de disponibilidad de infraestructuras, equipamientos e instalaciones específicos para el área conservada',
        ],
    ],
    'ObjectivesIntrants' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para los insumos del área conservada<br />Los objetivos enumerados a continuación se utilizarán para mejorar la gestión y, más concretamente, para las fases de planificación, de movilización de recursos (insumos) y de proceso, así como para el seguimiento de las actividades de gestión del área conservada.',
    ],
    'ObjectivesProcessus' => [
        'module_info' => 'Establecer y describir los objetivos de conservación relacionados con el proceso de implementación del área conservada. Los objetivos introducidos a continuación se utilizarán para mejorar la gestión y, más concretamente, para las fases de planificación, de movilización de recursos (insumos) y de proceso, así como para el seguimiento de las actividades de gestión del área conservada.',
    ],
    'StaffCompetence' => [
        'title' => 'Competencias/formación del personal',
        'fields' => [
            'Member' => 'Criterios - Concepto medido - Variable',
            'Weight' => 'Implicación',
            'Adequacy' => 'Adecuación de las actividades de refuerzo de capacidades para la entidad de gestión del área conservada',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Composición y personal o miembros del área conservada',
            'group1' => 'Partes interesadas implicadas en la gestión y el uso de los recursos naturales del área conservada',
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'Actividades de refuerzo de capacidades completamente inadecuadas',
                'Actividades de refuerzo de capacidades algo adecuadas',
                'Actividades de refuerzo de capacidades adecuadas, pero se necesitan mejoras',
                'Actividades de refuerzo de capacidades totalmente adecuadas (suficientes y actualizadas)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Está la entidad específica, o combinación de entidades, de Gestión y Gobernanza del área conservada implementando programa(s) de formación y de refuerzo de capacidades adecuado(s) que responda(n) a las necesidades de sus miembros en la consecución de los objetivos del área conservada?',
            'Una fuerza de trabajo cualificada, competente y comprometida es fundamental para el éxito de las áreas conservadas',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de las actividades de refuerzo de capacidades para los miembros de la entidad específica, o combinación de entidades, de Gestión y Gobernanza del área conservada (identificados en CTX 3.1.2 y CTX 5 – Usuarios directos)',
        ],
    ],
    'HRmanagementPolitics' => [
        'title' => 'Políticas y procedimientos de recursos humanos',
        'fields' => [
            'Conditions' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación de las políticas y procedimientos de gestión de los recursos humanos',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Remuneración y prestaciones para los empleados',
            'Compensaciones en tareas basadas en la participación',
            'Asignación de puestos o tareas',
            'Salud y seguridad',
            'Equidad de género y étnica',
            'Gestión de las relaciones con las partes interesadas en la asignación de las tareas a realizar',
            'Normas que reducen el favoritismo y la discriminación en la asignación de tareas',
            'Equidad en la rendición de cuentas por las actividades realizadas',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Ha adoptado la entidad específica, o combinación de entidades, de Gestión y Gobernanza del área conservada políticas de gestión adecuadas para motivar y retener sus recursos humanos?',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de las disposiciones de las políticas de gestión de los recursos humanos',
            'Adecuación de las políticas de gestión de los recursos humanos:',
        ],
        'module_info' => 'Disposiciones de las políticas de gestión de los recursos humanos de la entidad específica, o combinación de entidades, de Gestión y Gobernanza del área conservada (identificadas en SA 1 o CTX 3.1.1):',
    ],
    'AdministrativeManagement' => [
        'title' => 'Presupuesto y finanzas',
        'fields' => [
            'Aspect' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Establecimiento de los elementos básicos de la gestión presupuestaria y financiera',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Rendición de cuentas: es capaz de explicar y demostrar a todas las partes interesadas cómo ha utilizado sus recursos y qué ha logrado',
            'Transparencia: su organización es transparente en cuanto a su trabajo y sus finanzas, poniendo información a disposición de todas las partes interesadas',
            'Integridad: los individuos en su organización están operando con honestidad y decoro.',
            'Gestión responsable de los recursos financieros: su organización cuida bien de los recursos financieros que le han sido asignados y asegura que se utilizan para el fin previsto',
            'Normas de contabilidad: el sistema de su organización para mantener los registros y la documentación financiera sigue las normas de contabilidad externas aceptadas.',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Nunca',
                '1' => 'Raramente',
                '2' => 'A veces',
                '3' => 'A menudo',
                '4' => 'Siempre',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Se gestionan bien el presupuesto y los recursos financieros para satisfacer los requisitos esenciales y prioritarios de gestión del área conservada?',
            'La gestión presupuestaria y financiera de un área conservada debe ser robusta para permitir una presupuestación y una asignación de recursos adecuadas. Solo es posible alcanzar una gestión presupuestaria y financiera eficaz si existe un plan de gestión y de trabajo sólido, con objetivos claros.',
        ],
        'module_info_Rating' => [
            'Evaluar la implantación de los elementos básicos que deben existir para alcanzar buenas prácticas en la gestión presupuestaria y financiera.',
        ],
    ],
    'EquipmentMaintenance' => [
        'title' => 'Mantenimiento de las infraestructuras',
        'fields' => [
            'Equipment' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Clasificación: Adecuación del mantenimiento',
            'AdequacyLevel' => 'Valor de CTX 3.3',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Se mantienen adecuadamente las infraestructuras, los equipamientos y las instalaciones del área conservada?',
            'Unas infraestructuras, equipamientos e instalaciones mal mantenidos no solo se deterioran más rápidamente, sino que además desperdician recursos y degradan fundamentalmente la capacidad del área conservada de alcanzar sus objetivos.',
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de mantenimiento de las infraestructuras, los equipamientos y las instalaciones en relación con los requisitos de gestión del área conservada (a partir del análisis del contexto de intervención, punto CTX 3.3)',
        ],
    ],
    'ManagementActivities' => [
        'title' => 'Gestión de los elementos clave',
        'fields' => [
            'Activity' => 'Criterio - Concepto medido  - Variables',
            'EvaluationScore' => 'Adecuación de las medidas de gestión',
            'InManagementPlan' => 'Medidas incluidas en el plan de gestión',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Elementos clave del área conservada',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Existen acciones de gestión específicas para los elementos clave del área conservada?',
            'Para asegurar una gestión sostenible de los elementos clave del área conservada, la(s) parte(s) interesada(s)/asociación(es) de gestión debe(n) evaluar las prácticas y acciones, que pueden incluir la conservación/restauración de especies animales (p. ej. abejas) y vegetales (p. ej. farmacopea), la gestión del fuego, trabajos de revegetación, el control de especies invasoras, la gestión de los recursos culturales, la contención de amenazas, etc.',
        ],
        'module_info_Rating' => [
            'A partir de la lista de los elementos clave identificados en el Contexto de intervención SA 2 y priorizados en el análisis de Gestión C1, C2, C3.2 y C4, evaluar la adecuación de las prácticas y acciones de gestión relacionadas.',
        ],
    ],
    'LawEnforcementImplementation' => [
        'title' => 'Resolución de cuestiones litigiosas',
        'fields' => [
            'Element' => 'Criterios - Concepto medido - Variable',
            'Adequacy' => 'Adecuación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Actividades de control terrestre y marítimo',
            'group1' => 'Acciones en respuesta a actividades ilegales o resolución de cuestiones litigiosas',
        ],
        'predefined_values' => [
            'group0' => [
                'Gestión de la organización de las unidades/grupos de control',
                'Número de unidades/grupos de control por mes',
                'Uso de control colaborativo logrado mediante la colaboración con las partes interesadas',
                'Organización de unidades/grupos de control en colaboración con agentes forestales y marítimos y funcionarios jurados',
                'Unidades/grupos de control equipados con medios diversos (p. ej. tipos de patrulla como puntos de observación, a pie, en bicicleta, en motocicleta, unidades/grupos apoyados por vehículos/embarcaciones, etc.)',
                'Uso de GPS u otras herramientas de apoyo para realizar el briefing y el debriefing de las unidades/grupos de control',
                'Realización de control por unidades/grupos que operan durante la noche o en horarios no programados',
                'Actualización continua y uso de una ficha informativa simple que describe la zonificación, los controles, las restricciones y las actividades ilegales',
            ],
            'group1' => [
                'Unidad específica o administrador/guarda que orienta y apoya a las unidades/grupos de control frente a actividades ilegales o cuestiones litigiosas',
                'Organización de un sistema de informantes que orienta y apoya a las unidades/grupos de control frente a actividades ilegales o cuestiones litigiosas',
                'Sistema de aplicación de acciones legales contra actividades ilegales',
                'Seguimiento a infractores/conclusión del caso',
                'Sistema para resolver cuestiones litigiosas',
                'Resoluciones obtenidas conforme a normas tradicionales',
                'Colaboración con ONG especializadas en legislación terrestre y marina, aplicación de la ley, etc. (derechos, normas, etc.) sobre la sostenibilidad de la gestión de los elementos clave del área conservada',
            ],
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Qué grado de adecuación tienen el control y las acciones contra actividades ilegales destinados a garantizar la sostenibilidad de la gestión de los elementos clave del área conservada?',
            'El control (actividades de observación y recogida de datos) es una actividad esencial para hacer cumplir las normas legales, tradicionales y específicas existentes, de modo que se asegure la gestión a largo plazo de los elementos clave del área conservada.',
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de los elementos de la gestión de los patrullajes de guardaparques orientados a asegurar la protección a largo plazo de la biodiversidad y otros valores',
            'Evaluar la actuación contra actividades ilegales o para resolver cuestiones litigiosas en la sostenibilidad de la gestión de los elementos clave del área conservada',
        ],
    ],
    'StakeholderCooperation' => [
        'title' => 'Colaboración de las partes interesadas',
        'fields' => [
            'Element' => 'Criterios - Concepto medido - Variable',
            'Weight' => 'Implicación de la parte interesada (0-100)',
            'Cooperation' => 'Grado de cooperación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Usuarios directos',
            'group1' => 'Usuarios indirectos',
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Sin cooperación - Sin representación ni consulta de las partes interesadas, sin implicación, sin consideración del conocimiento ni de las perspectivas locales',
                '1' => 'Muy poca cooperación - Representación o consulta de las partes interesadas esporádica, implicación mínima, conocimiento y perspectivas locales poco considerados',
                '2' => 'Cooperación moderada - Representación o consulta moderada de las partes interesadas, implicación ocasional, cierta consideración del conocimiento y de las perspectivas locales',
                '3' => 'Cooperación muy alta - Representación o consulta de las partes interesadas bien establecida, implicación amplia, plena consideración del conocimiento y de las perspectivas locales',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Existen medidas para mejorar la cooperación de las partes interesadas en la gobernanza y gestión del área conservada?',
            'La evaluación pretende determinar en qué medida existen medidas para asegurar la cooperación y la participación efectiva de las partes interesadas, que contribuyen a la legitimidad y la eficacia de la gobernanza del área conservada.',
        ],
        'module_info_Rating' => [
            'Evaluar el grado de implicación y participación de las partes interesadas, su compromiso y la integración del conocimiento y de las perspectivas locales en la gobernanza y gestión del área conservada',
        ],
    ],
    'AssistanceActivities' => [
        'title' => 'Beneficios para las comunidades locales',
        'fields' => [
            'Activity' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación de las actividades para proporcionar beneficios/asistencia',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Elementos del nivel de vida material',
            'group1' => 'Elementos del nivel de vida inmaterial',
        ],
        'predefined_values' => [
            'group0' => [
                'Apoyo a la seguridad alimentaria (pequeña agricultura, pesca de pequeña escala, recolección, caza, etc.)',
                'Apoyo a las empresas locales (transformación de la producción agroalimentaria, pesca, construcción de cobertizos para barcas, estacionamiento de barcas, productos forestales, etc.)',
                'Apoyo a las empresas de turismo (distribución de los ingresos del turismo, productos tradicionales y artesanía para turistas, productos agrícolas o del mar, etc.)',
                'Apoyo a las vías de financiación locales',
                'Apoyo al conflicto entre los seres humanos y la vida silvestre resolución - compensación',
                'Apoyo al empleo de recursos humanos locales en el área conservada, en el turismo, etc.',
                'Apoyo a los proveedores de servicios locales',
                'Suministro de recursos naturales en caso de necesidad (p. ej. agua, fibras, etc. de las áreas conservadas durante crisis, o contribución material para edificios sociales como hospitales y escuelas)',
                'Suministro de energía, conexión eléctrica, abastecimiento y conexión de agua, construcción, mantenimiento y mejora de carreteras, etc.',
            ],
            'group1' => [
                'Minimización de conflictos y refuerzo de la gestión y el uso sostenibles de los elementos clave del área conservada (de aprovisionamiento y culturales)',
                'Provisión de infraestructuras de educación y de salud (es decir, edificios, agua potable)',
                'Prestación de servicios educativos (enseñanza) y de servicios de salud (atención sanitaria)',
                'Prestación de servicios culturales (físicos – intelectuales – emblemáticos – espirituales – interacción a partir de los servicios del área conservada)',
                'Facilitación de la solución de problemas sociales',
                'Refuerzo de la identidad y del sentido de pertenencia de los pueblos indígenas y las comunidades locales (IPLC)',
                'Minimización de conflictos y refuerzo de la gestión y el uso sostenibles de los elementos clave del área conservada (de aprovisionamiento y culturales)',
                'Provisión de infraestructuras de educación y de salud (es decir, edificios, agua potable)',
                'Prestación de servicios educativos (enseñanza) y de servicios de salud (atención sanitaria)',
                'Prestación de servicios culturales (físicos – intelectuales – emblemáticos – espirituales – interacción a partir de los servicios del área conservada)',
                'Facilitación de la solución de problemas sociales',
                'Refuerzo de la identidad y del sentido de pertenencia de los pueblos indígenas y las comunidades locales (IPLC)',
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Realiza el área conservada actividades/programas concebidos para proporcionar beneficios/asistencia adecuados a las comunidades?',
            'Las áreas conservadas deben contribuir al desarrollo sostenible y al bienestar económico de las partes interesadas. Por ello, las normas internacionales de buenas prácticas promueven una evaluación del área conservada que contabilice tanto los resultados ecológicos como los socioeconómicos (Fuentes UNESCO - IUCN).',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de las actividades/programas que el área conservada realiza para proporcionar beneficios/asistencia a las partes interesadas.',
        ],
    ],
    'EnvironmentalEducation' => [
        'title' => 'Educación ambiental',
        'fields' => [
            'Activity' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación de la educación ambiental y la sensibilización pública',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Programas de conservación de las partes interesadas del área conservada',
            'Programas de sensibilización de las partes interesadas del área conservada',
            'Programas de sensibilización de partes interesadas distintas de las del área conservada',
            'Programa de educación ambiental en las escuelas del paisaje del área conservada',
            'Programas de radio y televisión sobre el área conservada (p. ej. en radios comunitarias)',
            'Conferencias y debates sobre el área conservada',
            'Visitas guiadas para las partes interesadas en el área conservada',
            'Campañas de limpieza',
            'Sensibilización del público (p. ej. ecomuseos)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Realiza el área conservada actividades/programas de educación ambiental y de sensibilización del público específicamente vinculados a las necesidades y los objetivos de conservación/gestión de los elementos clave?',
            'La educación ambiental puede ayudar a las personas a equilibrar sus propias necesidades vitales con las necesidades del entorno natural que presta servicios (de aprovisionamiento, de regulación, culturales y de apoyo) a las partes interesadas dentro y fuera, cerca y lejos del área conservada (teniendo en cuenta la designación específica del área conservada). Esto puede lograrse aumentando la sensibilización y cambiando efectivamente la perspectiva de las partes interesadas sobre el área conservada',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de las actividades/programas de educación ambiental y de sensibilización del público apoyados por el área conservada',
        ],
    ],
    'VisitorsManagement' => [
        'title' => 'Gestión del turismo',
        'fields' => [
            'Aspect' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación de las instalaciones y servicios para visitantes',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Existencia de objetivos específicos para la gestión del turismo y los visitantes',
            'Existencia de procedimientos de gestión del turismo',
            'Sensibilización sobre las consecuencias derivadas de las actividades recreativas y turísticas',
            'Acciones para minimizar los cambios inducidos por el hombre (transporte, alojamiento y actividades de ocio)',
            'Diversificación del turismo mediante la promoción de valores biofísicos, culturales y socioculturales',
            'Beneficios económicos asegurados para la gestión y gobernanza de las áreas conservadas',
            'Gestión del alojamiento, la restauración y las actividades de ocio (también para personas con discapacidad)',
            'Guías turísticos en el área conservada',
            'Datos de seguimiento del turismo',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Gestiona el área conservada (diseña, establece, mantiene y mejora) las instalaciones y los servicios necesarios para los visitantes y el impacto del turismo ambiental?',
            'El turismo se produce en contextos históricos, culturales y geográficos únicos, que implican múltiples valores y partes interesadas del área conservada. Una gestión eficaz del turismo en el área conservada exige la apreciación y la comprensión de los contextos de sostenibilidad ambiental, social y económica y una gestión compatible de las instalaciones y servicios para visitantes.',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de la gestión de las instalaciones y servicios para visitantes y del impacto en el turismo ambiental y cultural del área conservada',
        ],
    ],
    'NaturalResourcesMonitoring' => [
        'title' => 'Seguimiento e investigación',
        'fields' => [
            'Aspect' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación del Monitoreo',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'predefined_values' => [
            'Uso de los datos del seguimiento para inducir cambios en la gestión y gobernanza del área conservada',
            'Seguimiento de los elementos clave',
            'Seguimiento de las amenazas al área conservada',
            'Seguimiento del nivel de vida material e inmaterial de las partes interesadas',
            'Investigación sobre los elementos clave',
            'Investigación sobre el nivel de vida material e inmaterial de las partes interesadas',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuados los sistemas de seguimiento e investigación para hacer un seguimiento eficaz de los elementos clave del área conservada?',
            'Para anticipar problemas potenciales y planificar las mejores intervenciones, es indispensable una comprensión sólida de las tendencias de los elementos clave ambientales y de los servicios del área conservada, como la biodiversidad, el aprovisionamiento (agua, alimentos, etc.), la calidad del bosque, las amenazas, etc.',
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de los sistemas de seguimiento e investigación existentes para los elementos clave del área conservada',
        ],
    ],
    'WorkProgramImplementation' => [
        'title' => 'Implementación de las actividades del plan de trabajo/acción',
        'fields' => [
            'Category' => 'Categoría de actividades',
            'Activity' => 'Actividad',
            'TargetedActivity' => 'Actividades planificadas',
            'EvaluationScore' => 'Nivel de aplicación',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'Nivel de implementación nulo o muy bajo de las actividades previstas para el último año (entre 0 y 25%)',
                'Nivel de implementación bajo de las actividades previstas para el último año (entre 26 y 50%)',
                'Nivel de implementación moderado de las actividades previstas para el último año (entre 51 y 75%)',
                'Nivel de implementación alto de las actividades previstas para el último año (entre 76 y 100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿En qué medida ha implementado el área conservada las principales actividades del plan de trabajo/acción?',
            'La implementación es la realización, o ejecución, del plan de trabajo/acción anual o plurianual relativo a las actividades del área conservada',
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de implementación de las prioridades definidas en el plan de trabajo/acción del año anterior (en el cuadro de comentarios indique el año de referencia si utiliza un plan de trabajo/acción plurianual)',
            '<b>Categoría de actividades</b>: gestión de los elementos clave, control, educación ambiental, gestión del turismo, etc.',
            '<b>Actividad</b>: acción perteneciente a una de las principales categorías de actividades, ejecutada para alcanzar un fin específico',
            'Sin un plan de trabajo/acción, puede referirse a las categorías y actividades del elemento Proceso: gestión y protección de los elementos clave; relaciones con las partes interesadas; turismo; seguimiento e investigación; etc.',
        ],
    ],
    'ManagementGovernance' => [
        'title' => 'Control del área',
        'fields' => [
            'Patrol' => 'A) Área cubierta por el control',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'Patrol' => [
                'El área cubierta por el control es mínima (del 0 al 25% de la superficie)',
                'El área cubierta por el control es limitada (del 26 al 50% de la superficie)',
                'El área cubierta por el control es aceptable (del 51 al 75% de la superficie)',
                'El área cubierta por el control es muy buena (más del 76% de la superficie)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Cuál es la extensión actual del control de la gestión y la gobernanza de los elementos clave del área conservada?',
            'La capacidad de asegurar el control y la recogida de información sobre los elementos clave priorizados en la gestión y gobernanza del área conservada previene o minimiza actividades ilegales o cuestiones litigiosas.',
        ],
        'module_info_Rating' => [
            'Evaluar el control de los elementos clave priorizados en la gestión y gobernanza del área conservada.',
        ],
    ],
    'AchievedObjectives' => [
        'title' => 'Consecución de los objetivos a largo plazo de la gestión y gobernanza del área conservada',
        'fields' => [
            'Objective' => 'Principales metas/objetivos a largo plazo',
            'EvaluationScore' => 'Nivel de logro de los objetivos',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'Ningún o muy bajo nivel de logro (entre 0 y 25%).',
                'Bajo nivel de logro (entre el 26 y el 50%)',
                'Nivel de logro moderado (entre el 51 y el 75%)',
                'Alto nivel de logro (entre 76 y 100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿En qué medida ha alcanzado el área conservada los principales objetivos de su plan de gestión y gobernanza? (A partir del análisis del contexto de intervención, punto CTX1.5 Visión – Objetivos, o de los elementos de Planificación, punto P6 – Objetivos existentes del plan de gestión).',
            'Las metas y los objetivos de un área conservada deben comprenderse claramente para que la gestión tenga éxito sobre la base de logros medibles.',
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de consecución de las principales metas/objetivos a largo plazo relacionados con los elementos clave del área conservada.',
        ],
    ],
    'KeyElementsImpact' => [
        'title' => 'Efectos sobre los elementos clave de conservación',
        'fields' => [
            'KeyElement' => 'Elemento clave de conservación',
            'StatusSH' => 'estado',
            'TrendSH' => 'Tendencia',
            'EffectSH' => 'Efecto',
            'ReliabilitySH' => 'Fiabilidad de la información',
            'CommentsSH' => 'Comentarios/explicaciones',
            'StatusER' => 'estado',
            'TrendER' => 'Tendencia',
            'EffectER' => 'Efecto',
            'ReliabilityER' => 'Fiabilidad de la información',
            'CommentsER' => 'Comentarios/explicaciones',
        ],
        'from_sa' => 'De las partes interesadas',
        'from_external_source' => 'De fuente externa',
        'groups' => [
            'group0' => 'Especies animales clave',
            'group1' => 'Especies vegetales clave',
            'group2' => 'Hábitats clave',
        ],
        'module_info_EvaluationQuestion' => [
            '¿Ejercen la gestión y la gobernanza efectos positivos o negativos sobre los elementos clave de conservación del área conservada?',
            'Uno de los principales objetivos del área conservada es lograr resultados positivos y sostenidos para la conservación in situ de la biodiversidad. La comparación de las evaluaciones de los usuarios directos con las de los usuarios indirectos y con datos técnicos sobre el mismo elemento clave permite un análisis e interpretación detallados de los resultados, destacando observaciones específicas, discrepancias, áreas de convergencia y posibles recomendaciones de modificación o de adopción de buenas prácticas. Los resultados de la comparación entre la evaluación interna y los datos externos sobre los mismos elementos clave de conservación pueden indicarse en la sección de comentarios.',
        ],
        'module_info_Rating' => [
            'Asegurar un doble análisis de A) estado y B) tendencias de los elementos clave de conservación del área conservada, a partir de datos de las partes interesadas y de fuentes externas',
        ],
        'ratingLegend' => [
            'StatusSH' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'Sin cambios',
                '+1' => 'Ligeramente creciente',
                '+2' => 'Incrementa',
            ],
            'TrendSH' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'Sin cambios',
                '+1' => 'Ligeramente creciente',
                '+2' => 'Incrementa',
            ],
        ],
    ],
    'LifeQualityImpact' => [
        'title' => 'Impactos sobre las comunidades locales',
        'fields' => [
            'Element' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Efectos',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Elementos del nivel de vida material',
            'group1' => 'Elementos del nivel de vida inmaterial',
        ],
        'predefined_values' => [
            'group0' => [
                'Seguridad alimentaria (pequeña agricultura, pesca de pequeña escala, recolección, caza, etc.)',
                'Empresas locales (transformación de la producción agroalimentaria, pesca, construcción de cobertizos para barcas, estacionamiento de barcas, productos forestales, etc.)',
                'Resolución de conflictos entre el ser humano y la fauna silvestre - compensación',
                'Empleo de recursos humanos locales en el área conservada, en el turismo, etc.',
                'Recursos naturales en caso de necesidad (p. ej. agua, fibras, etc. de las áreas conservadas durante crisis, o contribución material para edificios sociales como hospitales y escuelas)',
                'Suministro de energía, conexión eléctrica, abastecimiento y conexión de agua, construcción, mantenimiento y mejora de carreteras, etc.',
            ],
            'group1' => [
                'Conflictos y refuerzo de la gestión y el uso sostenibles de los elementos clave del área conservada (de aprovisionamiento y culturales)',
                'Infraestructuras de educación y de salud (es decir, edificios, agua potable)',
                'Servicios educativos (enseñanza), servicios de salud (atención sanitaria)',
                'Servicios culturales (físicos – intelectuales – emblemáticos – espirituales – interacción a partir de los servicios del área conservada)',
                'Resolución de problemas sociales',
                'Identidad y sentido de pertenencia de los pueblos indígenas y las comunidades locales (IPLC)',
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '-3' => 'Efectos altamente perjudiciales',
                '-2' => 'Efectos perjudiciales',
                '-1' => 'Efectos ligeramente perjudiciales',
                '0' => 'Neutro',
                '+1' => 'Efectos ligeramente favorables',
                '+2' => 'Efectos favorables',
                '+3' => 'Efectos altamente favorables',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Ejercen la gestión y la gobernanza del área conservada efectos positivos o negativos sobre la calidad de vida de las partes interesadas?',
            'La gestión y la gobernanza del área conservada deben prestar gran atención a los efectos sobre la calidad de vida de las partes interesadas locales. La disponibilidad de recursos esenciales puede afectar a la calidad de vida a través de impactos en el consumo, los ingresos y la riqueza (nivel de vida material) y en la buena vida, la salud y las relaciones sociales y culturales (nivel de vida inmaterial).',
        ],
        'module_info_Rating' => [
            'Evaluar los efectos de la gestión y la gobernanza del área conservada sobre las partes interesadas.',
        ],
    ],
    'EmpowermentGovernance' => [
        'title' => 'Partes interesadas, empoderamiento',
        'fields' => [
            'Conditions' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Adecuación del empoderamiento de las partes interesadas',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'groups' => [
            'group0' => 'Implicación',
            'group1' => 'RESPONSABILIDAD',
            'group2' => 'ORIENTACIÓN',
        ],
        'predefined_values' => [
            'group0' => [
                'Representación: mecanismos existentes que aseguren la representación legítima de las partes interesadas en la toma de decisiones del área conservada',
                'Aceptación: comprensión y reconocimiento de los derechos consuetudinarios sobre los servicios ecosistémicos',
                'Aceptación: aceptación social de la legitimidad de los derechos legales sobre los servicios ecosistémicos',
                'Orientación al consenso: toma de decisiones que mantiene un diálogo activo y busca el consenso sobre soluciones que respondan, al menos en parte, a las preocupaciones e intereses de todos',
            ],
            'group1' => [
                'Respeto de los acuerdos: seguimiento del cumplimiento de los acuerdos establecidos entre las distintas partes interesadas',
                'Equidad en la relación coste-beneficio asociada a la conservación: maximizar los beneficios ecológicos, sociales, económicos y culturales de las áreas conservadas sin incurrir en costes innecesarios ni causar daños a las comunidades locales',
                'Eficiencia de la gestión: aplicación de la gobernanza existente de los servicios ecosistémicos de forma eficaz y eficiente en la obtención de los beneficios ecológicos, sociales, económicos y culturales del área conservada',
            ],
            'group2' => [
                'Orientación (Visión): desarrollo y aplicación de una visión estratégica coherente (perspectiva a largo plazo) basada en valores acordados y en la comprensión de las complejidades ecológicas, históricas, sociales y culturales',
                'Legalización: promover la legalización de los derechos de las partes interesadas en la gestión y gobernanza de los servicios ecosistémicos, maximizando los beneficios ecológicos, sociales, económicos y culturales de las áreas protegidas y conservadas',
                'Respeto de los valores: apoyar la mejora de todos los valores ecológicos, de aprovisionamiento, de control y culturales del área conservada en beneficio de las comunidades',
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área conservada',
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Promueve activamente la gestión del área conservada iniciativas de empoderamiento de las partes interesadas para asegurar una mayor implicación de estas, con vistas a una implementación más eficaz y de mayor impacto de las medidas de conservación basadas en áreas?',
            'El empoderamiento de las partes interesadas constituye una piedra angular en la gestión y gobernanza de un área conservada, y desempeña un papel decisivo en la promoción de una implicación significativa, de la responsabilidad compartida y de la toma de decisiones colaborativa entre partes interesadas diversas. Al empoderar a las partes interesadas, el área conservada busca movilizar su conocimiento, perspectivas y contribuciones colectivas, lo que conduce, en última instancia, a una implementación más completa, sostenible y eficaz de las medidas de conservación basadas en áreas',
        ],
        'module_info_Rating' => [
            'Evaluar la promoción de iniciativas de empoderamiento de las partes interesadas para una implementación más completa, sostenible y eficaz de las medidas de conservación basadas en áreas',
        ],
    ],
];
