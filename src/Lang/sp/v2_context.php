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

    'spillover_waring_message' => 'Sólo si se ha analizado la sección CTX 2.5',
    'connectivity_waring_message' => 'Sólo si se ha analizado la sección CTX 2.4',

    'Objectives' => [
        'title' => 'Estableciendo objetivos',
        'fields' => [
            'Element' => 'Elemento / indicador',
            'Status' => 'Linea base',
            'Objective' => 'Objetivo – Estado óptimo o favorable',
            'Comments' => 'Comentarios',
        ],
    ],

    'Objectives1' => [
        'module_info' => 'Establecer y describir los objetivos para la gobernanza, las asociaciones y la designación del área protegida.<br /> Los objetivos ingresados a continuación se utilizarán para mejorar la gestión, y más específicamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el seguimiento de las actividades de gestión del área protegida.',
    ],
    'Objectives2' => [
        'module_info' => 'Establecer y describir los objetivos relacionados con <b>los límites, el índice de configuración, la extensión de las patrullas y la aplicación de la ley y el contexto territorial del área protegida</b><br /> Los objetivos ingresados a continuación se utilizarán para mejorar la gestión, y más específicamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el seguimiento de las actividades de gestión del área protegida.',
    ],
    'Objectives3' => [
        'module_info' => 'Establecer y describir los objetivos para <b>recursos humanos y financieros/apoyo de las asociaciones en la gestión</b> del área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento de las actividades de gestión del área protegida',
    ],
    'Objectives4' => [
        'module_info' => 'Establecer y describir los objetivos de los factores clave: <b> i) especies de animales; ii) especies de plantas; iii) hábitats y; iv) cambio de cobertura de uso del suelo </b> del área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el monitoreo de las actividades de gestión del área protegida',
    ],
    'Objectives5' => [
        'module_info' => 'Establecer y describir los objetivos para <b>amenazas</b> frente al área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión, y más concretamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el monitoreo de las actividades de gestión del área protegida',
    ],
    'Objectives6' => [
        'module_info' => 'Establecer y describir los objetivos para <b>los efectos del cambio climático</b> frente al área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y la supervisión de las actividades de gestión del área protegida',
    ],
    'Objectives7' => [
        'module_info' => 'Establecer y describir los objetivos para <b> los servicios y funciones ecosistémicas y la dependencia de estos servicios de las comunidades/sociedades</b> en el área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar el manejo, y más específicamente para la planificación, la movilización de recursos (insumos), las fases del proceso y para el monitoreo de las actividades de manejo del área protegida',
    ],

    'GeneralInfo' => [
        'title' => 'Datos básicos',
        'fields' => [
            'CompleteName' => 'Nombre completo del área protegida',
            'CompleteNameWDPA' => 'Nombre con el cual se hace referencia al área protegida',
            'WDPA' => 'WDPA ID (www.protectedplanet.net)',
            'UsedName' => 'Nombre por el que se hace referencia al área protegida',
            'Type' => 'Tipología',
            'NationalCategory' => 'Categoría nacional',
            'IUCNCategory1' => '1a categoría de la UICN',
            'IUCNCategory2' => '2ª categoría de la UICN',
            'IUCNCategory3' => '3ª categoría de la UICN',
            'MarineDesignation' => 'Designación marina',
            'Country' => 'País',
            'CreationYear' => 'Año de creación',
            'Institution' => 'Institución(es) supervisora(s)',
            'Biome' => 'Bioma',
            'Ecoregions' => 'Ecorregión(es) de referencia [Ecorregiones G200, Olson, WWF; Spalding M. et alt. 2007]',
            'Ecotype' => 'Ecotipos (hasta tres elementos predominantes)',
            'ReferenceText' => 'Referencia del texto de designación oficial',
            'ReferenceTextDocument' => '',
            'ReferenceTextValues' => '¿Cuál es la importancia del área protegida y sus principales valores para los que fue designada? (Proporcione una lista y luego una breve descripción.)',
        ],
        'module_info' => '<b>Introducción a la tipología</b>: El IMET identifica tres categorías de áreas protegidas: (1)
            Terrestres (2) Marinas y Costeras (3) área conservada.
            En la sección Gobernanza (CTX 1.2) puede precisar la tipología de gestión y gobernanza de estas tres tipologías
            de áreas protegidas. Si está analizando un Área Protegida y Conservada (ACP), puede especificar el contexto
            territorial en CTX 2.4. Área protegida (definición general): Un área protegida es un espacio geográfico claramente
            definido, reconocido, dedicado y gestionado, a través de medios legales u otros medios efectivos, para lograr
            la conservación a largo plazo de la naturaleza con los servicios ecosistémicos y los valores culturales asociados.
            (Definición de la UICN 2008)',
        'type_info' => [
            'terrestrial' => 'Una zona terrestre protegida (TPA) es una porción de tierra protegida por restricciones y
                leyes especiales para la conservación del entorno natural. Incluyen grandes extensiones de terreno reservadas
                para la protección de la vida silvestre y su hábitat; áreas de gran belleza natural o interés único; áreas que
                contienen formas raras de vida vegetal y animal; áreas que representan una formación geológica inusual; lugares
                de interés histórico y prehistórico; áreas que contienen ecosistemas de especial importancia para la investigación
                y el estudio científico; y áreas que salvaguardan las necesidades de la biosfera. (GEMET- DODERO / WPR) (comprobamos
                si hay una descripción del CDB)',
            'marine_and_coastal' => 'Una zona marina y costera protegida (AMP o AMPC) es "una zona dentro del medio marino
                o adyacente a él, junto con sus aguas suprayacentes y la flora, la fauna y los rasgos históricos y culturales
                asociados, que ha sido reservada por la legislación u otros medios eficaces, incluida la costumbre, con el
                efecto de que su biodiversidad marina y/o costera goce de un nivel de protección mayor que el de su entorno"
                (Convenio sobre la Diversidad Biológica - CDB)',
            'oecm' => 'Un área geográficamente definida
                que no es un Área Protegida, que se gobierna y gestiona de manera que logra resultados positivos y sostenidos
                a largo plazo para la conservación insitu de la biodiversidad, con funciones y servicios ecosistémicos asociados
                y, cuando corresponda, valores culturales, espirituales, socioeconómicos y otros valores relevantes a nivel
                local" (CDB, 2018)',
            'icca' => '(ICCAs Territorios y áreas conservadas por pueblos indígenas y comunidades locales) Un ecosistema
                natural y/o modificado, que contiene valores significativos de biodiversidad, beneficios ecológicos y valores
                culturales, conservado voluntariamente por los pueblos indígenas y las comunidades locales, a través de leyes
                consuetudinarias u otros medios efectivos (CDB -Reconocimiento y apoyo a las ICCAs)',
        ],
    ],

    'Governance' => [
        'title' => 'Gobernanza y asociación',
        'fields' => [
            'Partner' => 'Enumere las asociaciones / socios (si las hay)',
            'InstitutionType' => 'Tipo de institución',
            'PartnershipsType1' => 'La asociación más importante: Primero',
            'PartnershipsType2' => 'Segunda',
            'PartnershipsType3' => 'Tercera',
            'GovernanceModel' => 'Modelo de gestión',
            'SubGovernanceModel' => 'Modelo de subgestión',
            'AdditionalInfo' => 'Información adicional sobre el modelo de gobernanza (si es necesario)',
        ],
        'governance' => 'Gobernanza',
        'partnership' => 'Asociación',
        'module_info' => 'Esta sección describe la estructura de gobernanza existente y las alianzas con las partes interesadas dentro
            del área protegida. Describe las instituciones clave involucradas, los tipos de procesos de toma de decisiones,
            los roles de las partes interesadas y el nivel de coordinación entre los actores. También destaca las alianzas
            actuales que apoyan los esfuerzos de conservación y su papel en la implementación de la gestión.',
    ],

    'SpecialStatus' => [
        'title' => 'Designaciones especiales (Patrimonio Mundial, MAB, sitio Ramsar, IBAs, SPAMI, LMMA, etc.)',
        'fields' => [
            'Designation' => 'Designación',
            'RegistrationDate' => 'Fecha de inscripción',
            'Code' => 'Código',
            'Area' => 'Área (ha)',
            'DesignationCriteria' => 'Criterio de designación',
            'upload' => 'Subir',
        ],
        'groups' => [
            'conventions' => 'Designaciones (inclusiones) en la lista de convenciones internacionales (Patrimonio Mundial, RAMSAR, etc.)',
            'networks' => 'Pertenencia a una red internacional reconocida oficialmente (MAB, RAPAC, Red Parques, Lista Verde, etc.)',
            'conservation' => 'Designación del estado de importancia de la conservación por los organismos internacionales (IBA, AZE, etc.)',
            'marine_pa' => 'Designación de áreas marinas protegidas',
        ],
        'module_info' => 'Esta sección describe las designaciones oficiales otorgadas al área protegida, como Sitios de Patrimonio
            Mundial, Reservas del Hombre y de la Biosfera (MAB), Sitios Ramsar, Áreas Importantes para la Conservación
            de las Aves (IBA), Zonas Especialmente Protegidas de Importancia para el Mediterráneo (ZEPIM) y Áreas Marinas
            de Gestión Local (AMG). Estas designaciones reflejan la importancia ecológica del área e influyen en su marco
            de gestión, sus prioridades de conservación y sus obligaciones internacionales.',
    ],

    'Networks' => [
        'title' => 'Pertenencia a redes de gestión local',
        'fields' => [
            'NetworkName' => 'Nombre',
            'ProtectedAreas' => 'Nombres de otras áreas protegidas dentro de la red',
        ],
        'groups' => [
            'group0' => 'Red transfronteriza',
            'group1' => 'Red de paisaje (áreas protegidas terrestres y marinas) - Red (red marina)',
            'group2' => 'Otras redes',
        ],
        'module_info' => 'Esta sección describe la pertenencia del área protegida a diversas redes de gestión a nivel local,
            transfronterizo y paisajístico. Identifica vínculos con otras áreas protegidas dentro de estas redes y
            destaca los marcos de colaboración para la conservación y la gestión relevantes para el área protegida.',
    ],

    'Missions' => [
        'title' => 'Visión - Misión - Objetivos',
        'fields' => [
            'LocalVision' => 'A nivel local o nacional Visión',
            'LocalMission' => 'Misión',
            'LocalObjective' => 'Objetivos',
            'LocalSource' => 'Fuente',
            'LocalManagementPlan' => 'Archivo (Plan de manejo o gestión)',
            'InternationalVision' => 'A nivel internacional Visión',
            'InternationalMission' => 'Misión',
            'InternationalObjective' => 'Objetivos',
            'InternationalSource' => 'Fuente',
            'InternationalManagementPlan' => 'Archivo (Plan de manejo o gestión)',
            'Observation' => 'Observaciones',
        ],
        'module_info' => 'Esta sección presenta el marco estratégico del área protegida, incluyendo su visión, misión y objetivos
            de gestión.<ul>
            <li><b>Visión del área protegida</b>: La visión es básicamente un plan sobre cómo debería ser el AP en el futuro,
             abarcando la ecología, la sociedad y la gobernanza. Es el gran objetivo que guía todo lo que hacemos para
             conservar y gestionar el área.</li>
            <li><b>Misión del área protegida</b>: La misión explica lo que el AP intenta hacer y cómo se integra con la visión.
            Indica cuáles son nuestras responsabilidades, cómo gestionaremos las cosas y las normas que rigen el uso del
            área de una manera beneficiosa para el medio ambiente y la población local.</li>
            <li><b>Objetivos a largo plazo del área protegida</b>: Los objetivos a largo plazo son como una hoja de ruta que
            convierte la visión y la misión en metas específicas que guían las iniciativas de gestión durante los próximos
            10 a 20 años. Estos objetivos se basan en las áreas clave de conservación, gobernanza y sostenibilidad,
            garantizando que el AP cumpla su función en términos de ecología y economía.</li>
            </ul>',
    ],

    'Contexts' => [
        'title' => 'Referencias del contexto histórico, político, legal, institucional y socioeconómico del área protegida',
        'fields' => [
            'Context' => 'Contexto o elementos específicos',
            'file' => 'Archivo(s)',
            'Summary' => 'Resumen',
            'Source' => 'Recursos',
            'Observations' => 'Notas',
        ],
        'predefined_values' => [
            'Contexto histórico',
            'Contexto socioeconómico',
            'Contexto político (país)',
            'Contexto jurídico',
            'Contexto institucional',
        ],
        'module_info' => 'Esta sección ofrece una visión general de los factores contextuales clave que afectan al área protegida. Incluye:
            <ul>
            <li><b>Contexto histórico</b>: Eventos e hitos clave que han definido la conservación y la gestión del área.</li>
            <li><b>Contexto socioeconómico</b>: El papel del área protegida en los medios de vida locales, las actividades
            económicas y las interacciones comunitarias.</li>
            <li><b>Contexto político (a nivel de país): Estructuras de gobernanza, marcos de políticas e influencias políticas
             que afectan la toma de decisiones.</li>
            <li><b>Contexto legal e institucional</b>: Leyes, reglamentos e instituciones pertinentes que se aplican al área
            protegida.</li>
            <li><b>Contexto institucional</b>: Las funciones y responsabilidades de las instituciones clave involucradas en
            la gestión y la gobernanza del área.</li>
            </ul>
            Estos elementos definen el marco general en el que opera el área protegida.',
    ],

    'GeographicalLocation' => [
        'title' => 'Ubicación',
        'fields' => [
            'LimitsExist' => 'Existencia de límites oficiales georreferenciados (sí/no)',
            'Shapefile' => 'Archivo SIG',
            'SourceSHP' => 'Fuente del archivo SIG',
            'Coordinates' => 'Coordenadas geográficas (línea base o punto clave del área protegida)',
            'SourceCoords' => 'Fuente',
            'AdministrativeLocation' => 'Ubicación administrativa del área protegida (provincia, región, etc.)',
        ],
        'module_info' => 'Esta sección proporciona información sobre la ubicación geográfica del área protegida. Incluye sus coordenadas
            y su ubicación administrativa. La descripción destaca su ubicación dentro de un contexto territorial más amplio.',
    ],

    'Areas' => [
        'title' => 'Áreas terrestres del área protegida y el contexto de conservación',
        'fields' => [
            'BoundaryLength' => 'Límites',
            'AdministrativeArea' => 'Superficie administrativa',
            'WDPAArea' => 'Superficie según WDPA',
            'GISArea' => 'Superficie real del área (SIG para el área protegida o la autoridad responsable de las áreas protegidas) correspondiente al archivo cargado',
            'TerrestrialArea' => 'Área protegida terrestre',
            'MarineArea' => 'Área protegida marina y costera',
            'PercentageNationalNetwork' => 'Superficie % de la red nacional de áreas protegidas',
            'PercentageEcoregion' => 'Superficie % de la ecorregión',
            'PercentageTransnationalNetwork' => 'Superficie % de la red transfronteriza',
            'PercentageLandscapeNetwork' => 'Superficie % de paisaje/red',
            'Index' => 'Índice de configuración <br />&radic;(3.14)/(6.28)*perímetro/&radic;(área) =<br /> bueno 1 - 1.5; promedio 1.5 - 2; bajo > 2',
            'Observations' => 'Notas',
        ],
        'module_info' => 'Esta secção fornece dados importantes sobre o tamanho, a extensão do limite, a cobertura terrestre e marinha
            e a configuração espacial da propriedade. Situa também a propriedade dentro de redes nacionais, eco-regiões,
            transfronteiriças e de conservação da paisagem, destacando o seu papel em esforços de conservação mais amplos.',
    ],

    'Sectors' => [
        'title' => 'Patrullaje y aplicación de la ley: área o sectores terrestres y/o zona o sectores marinos y costeros',
        'fields' => [
            'Name' => 'Sector',
            'TerrestrialOrMarine' => '¿Terrestres o marinos?',
            'UnderControlArea' => 'Km² de área cubierta por patrullaje',
            'UnderControlPatrolKm' => 'Km de patrullajes',
            'UnderControlPatrolManDay' => 'Día de patrullaje',
            'SectorMap' => 'Mapas de zonificación',
            'Source' => 'Fuente',
            'Observations' => 'Notas',
        ],
        'module_info' =>
            '<div class="font-bold">Días-Patrulla promedio por Km² (caso de los Parques Nacionales Africanos)</div>
            Para una gestión eficaz, la intensidad de patrullaje se expresa como el <b>número de días-patrulla por kilómetro cuadrado por año</b>,
            calculado dividiendo el total de días-patrulla por el área del sector o del área protegida. Un <b>día-patrulla</b> corresponde a un
            equipo de patrullaje operando durante un día, independientemente del tamaño del equipo.
            En la práctica, la evidencia de las áreas protegidas africanas indica que la intensidad de patrullaje generalmente oscila entre <b>0,1 y 0,6
            días-patrulla por km² por año</b>, donde <b>0,3 a 0,4</b> representa una cobertura moderada y operativamente realista. Los valores
            que se aproximan o superan 0,6 días-patrulla/km²/año se consideran altos y suelen ser difíciles de mantener en áreas extensas.
            <div class="font-bold">Mayor intensidad en áreas pequeñas o zonas de alta amenaza</div>
            En áreas protegidas pequeñas o en sectores con alta presión de caza furtiva o biodiversidad crítica, la intensidad de patrullaje puede
            aumentar a 1–3 días-patrulla/km²/año o más. Estos valores reflejan esfuerzos localizados y prioritarios, no estándares
            aplicables a toda el área.
            <div class="font-bold">Menor intensidad en áreas de bajo riesgo</div>
            Las áreas de bajo riesgo o inaccesibles pueden tener <0,1 días-patrulla/km²/año, lo que indica una presencia limitada de patrullas y una capacidad de vigilancia reducida.',
        'area_percentage' => '% de área',
        'average_time' => 'Días de patrulla / km² cubiertos',
    ],

    'TerritorialReferenceContext' => [
        'title' => 'Contexto territorial de referencia (Paisaje) del Área Protegida',
        'fields' => [
            'FunctionalHasNoTakeArea' => '¿La zona del ecosistema funcional corresponde al área protegida?',
            'FunctionalArea' => 'Estimación del área funcional del ecosistema que es importante para el mantenimiento de la biodiversidad del área protegida: a) en Km² y b) como ancho de la franja exterior.',
            'FunctionalPopulation' => 'Estimación del tamaño de la población local que vive dentro del área funcional del ecosistema',
            'EcologicalAspects' => 'Estimación de la presencia de los factores ambientales, por ejemplo, las áreas de distribución de las especies emblemáticas (en Km2) (Km2)',
            'BenefitArea' => 'Estimación de la superficie habitada alrededor del área protegida que se beneficia de los servicios del ecosistema o funciones ambientales que genera el área protegida: a) en km² y b) como ancho de la franja exterior',
            'BenefitPopulation' => 'Estimación del tamaño de la población local que vive dentro del área de influencia socioeconómica',
            'BenefitSocioEconomicAspects' => 'Liste y describa los factores socioeconómicos y administrativos (por ejemplo, las funciones tradicionales o modernas sobre los recursos naturales establecidas por las autoridades tradicionales y modernas) que influyen en el ordenamiento de las áreas protegidas.',
        ],
        'categories' => [
            'FunctionalEcosystemArea' => 'Área funcional del ecosistema',
            'BenefitsOfEcosystemServicesArea' => 'Área que se beneficia de los servicios y/o funciones del ecosistema del área protegida',
        ],
        'module_info' => '<b>Paisaje</b>: La gobernanza y la gestión vinculadas de un área protegida y sus territorios circundantes
            pueden contribuir a la conservación de la biodiversidad y la resiliencia climática, el mantenimiento de los
            recursos naturales y los servicios ecosistémicos que garantizan el desarrollo sostenible de las comunidades
            locales.<br />
            <b>Áreas Protegidas y Conservadas (APC)</b>: Son una de las herramientas más eficaces para prevenir la pérdida
            de ecosistemas y especies naturales, así como para lograr el desarrollo sostenible a largo plazo, incluidas
            las metas 11 y 12 de Aichi y varios Objetivos de Desarrollo Sostenible (ODS). En algunas regiones, las ACP son
            el centro del desarrollo económico, a través del turismo, el uso sostenible de los recursos y como fuentes de
            agua dulce. Las ACP también contribuyen a la seguridad alimentaria mediante el mantenimiento de los servicios
            ecosistémicos que apoyan la agricultura, protegiendo los recursos esenciales para los programas de cultivo y
            proporcionando espacio para los sistemas agrícolas y de pastoreo tradicionales respetuosos con la biodiversidad.
            Las ACP también desempeñan un papel importante en la resiliencia climática, tanto al almacenar y secuestrar
            carbono como al garantizar que los ecosistemas sigan proporcionando bienes y servicios a las sociedades humanas (WWF).',
    ],

    'Connectivity' => [
        'title'  => 'Conectividad',
        'fields' => [
            'DocumentedConnectivity' => '1.	Primero, documente las evidencias',
            'EvidenceOfConnectivity' => '2.	Base su clasificación en las evidencias, no en sus suposiciones',
            'ConnectivityIntegrationInManagementPlan' => '3. Analice el grado de integración de la conectividad en la planificación de la gestión',
        ],
        'sub_titles' => [
            'DocumentedConnectivity' => '¿Existe conectividad estructural documentada entre el área protegida y los hábitats circundantes (corredores, continuidad de hábitats, corrientes marinas, piedras de paso)?',
            'EvidenceOfConnectivity' => '¿Existe evidencia de conectividad funcional (movimiento de especies, migración, intercambio genético, dispersión larval)?',
            'EvidencesListConnectivity' => 'Las indicaciones y evidencias pueden incluir:',
            'ConnectivityIntegrationInManagementPlan' => '¿La conectividad está integrada en la planificación de la gestión?',
        ],
        'connectivity_title' => 'Cómo evaluar la conectividad en IMET',
        'link_to_me' => '4.	Vincule la conectividad con la efectividad de la gestión',
        'link_to_me_details' => '
            <p>La clasificación seleccionada informa el análisis IMET en:</p>
            <ul>
                <li>C1.5 – Servicios ecosistémicos (importancia y priorización)</li>
                <li>I1 - Información básica</li>
                <li>PR7 - Gestión de los valores y amenazas principales (acciones de gestión)</li>
                <li>O/C2 - Resultados ecológicos y/o O/C3: Efectos en la calidad de vida local</li>
            </ul>',

        'module_info' => '<p>La conectividad se refiere a los vínculos ecológicos estructurales y funcionales entre el área protegida y
            los hábitats o ecosistemas circundantes que permiten procesos ecológicos clave, como el movimiento de especies,
            el flujo génico, la migración, la dispersión larval y la adaptación climática.</p>
             <b class="blue">Descripción</b>
             <p>La conectividad sostiene la viabilidad a largo plazo de los principales valores naturales del sitio y sustenta procesos como
             la recuperación de biomasa y el spillover.</p>
            <p>La conectividad puede ser:</p>
            <ul>
                <li>Estructural: la continuidad física de los hábitats, corredores, piedras de paso y corrientes.</li>
                <li>Funcional (el movimiento real de especies, el flujo génico y los patrones de dispersión);</li>
                <li>Ecológica (mantenimiento de los vínculos tróficos y los procesos ecosistémicos más allá de las fronteras).</li>
            </ul>
            <p>En sistemas marinos, la conectividad puede incluir:</p>
            <ul>
                <li>Rutas de migración de adultos</li>
                <li>Sistemas de corrientes y redes de dispersión larval</li>
                <li>Continuidad de hábitats (arrecifes, praderas marinas y manglares).</li>
            </ul>
            <p>En sistemas terrestres:</p>
            <ul>
                <li>Corredores</li>
                <li>Zonas de amortiguamiento</li>
                <li>Redes ecológicas</li>
                <li>Vínculos transfronterizos</li>
            </ul>
            <p>La conectividad apoya:</p>
            <ul>
                <li>Resiliencia ecológica</li>
                <li>Dinámicas de spillover</li>
                <li>La viabilidad a largo plazo de los elementos clave de conservación</li>
                <li>Adaptación climática</li>
            </ul>',
    ],

    'Spillover' => [
        'title' => 'Spillover',
        'fields' => [
            'SupportingEvidence' => 'P1. Evaluación de las evidencias de Spillover Ecológico',
            'SupportingKeyObservations' => 'P2. Evidencias y Observaciones Principales',
            'SupportingOtherObservation' => 'Especifique',
            'SupportingPerceivedSpeciesChange' => 'P3. Cambio percibido en el monitoreo/captura de especies',
            'SupportingPerceivedSizeChange' => 'P4. Cambio percibido en el tamaño de las principales especies objetivo',
            'SupportingComments' => 'Observaciones',
            'ProvisioningEvidence' => 'P1. Evaluación de las evidencias de Spillover de Aprovisionamiento',
            'ProvisioningKeyObservations' => 'P2. Evidencias y observaciones principales',
            'ProvisioningOtherObservation' => 'Especifique',
            'ProvisioningPerceivedCatchChange' => 'P3. Cambio percibido en la captura cerca del AMP',
            'ProvisioningPerceivedSpillover' => 'P4. ¿Los pescadores perciben un efecto de spillover del AMP?',
            'ProvisioningComments' => 'Observaciones',

        ],
        'sub_titles' => [
            'SupportingEvidence' => '¿Existe evidencia científica o de monitoreo de spillover ecológico del AMP (por ejemplo, gradientes de biomasa, marcado, exportación larval, mejora del hábitat cerca de los límites)?',
            'SupportingKeyObservations' => 'Describa las principales observaciones o información que respaldan su evaluación en P1',
            'SupportingPerceivedSpeciesChange' => 'En esas mismas zonas de pesca fuera del AMP, ¿cómo perciben el personal/pescadores del AMP la variedad y composición de especies en su monitoreo/captura en comparación con antes del AMP?',
            'SupportingPerceivedSizeChange' => '¿Cómo perciben el personal/pescadores del AMP el tamaño promedio de las principales especies que capturan en áreas fuera pero cercanas al AMP, en comparación con antes del AMP?',
            'ProvisioningEvidence' => '¿Existe evidencia científica, de monitoreo o documentada de que el AP genera beneficios de spillover de aprovisionamiento en las zonas de pesca vecinas (por ejemplo, mejores capturas, peces más grandes, cambios en la composición de especies, aumento del Rendimiento por Unidad de Esfuerzo -CPUE)?',
            'ProvisioningKeyObservations' => 'Describa brevemente las observaciones clave que respaldan su elección (por ejemplo, resultados de monitoreo, retroalimentación de la comunidad, resultados de investigación, observaciones de guardabosques o funcionarios de pesca)',
            'ProvisioningPerceivedCatchChange' => 'En comparación con el período anterior al establecimiento del AMP, ¿cómo perciben el personal/pescadores del AMP que operan fuera pero cerca del AMP el cambio en su captura total por viaje?',
            'ProvisioningPerceivedSpillover' => '¿Los pescadores creen que la presencia del AMP ha contribuido a mejores capturas en las zonas donde pescan (por ejemplo, porque los peces salen desde dentro del AMP o se concentran cerca de su límite)?',
        ],
        'other_labels' => [
            'SupportingTitle' => 'Soporte (SE – Soporte)',
            'SupportingSubTitle' => 'Se utiliza cuando los procesos ecológicos (por ejemplo, reproducción, recuperación de biomasa, exportación larval) son conocidos o sospechados, pero los efectos socioeconómicos no están demostrados. El spillover se analizará entonces principalmente en el contexto y los resultados ecológicos',
            'ProvisioningTitle' => 'Servicio ecosistémico de aprovisionamiento (SE – Aprovisionamiento)',
            'ProvisioningSubTitle' => 'Se utiliza cuando los pescadores o comunidades reportan mejores capturas, peces más grandes o cambios en la composición de especies sin mecanismos ecológicos documentados. El análisis se centrará en los medios de vida y los resultados socioeconómicos.',
        ],
        'module_info' => '<p>El spillover se refiere a los beneficios ecológicos y socioeconómicos generados por un área protegida, en particular
            un área marina protegida (AMP), que se extienden más allá de sus límites o son recibidos de áreas protegidas vecinas
            dentro de un paisaje terrestre o marino interconectado.</p>
            <b class="blue">Descripción</b>
            <p><b>El spillover ecológico</b> (ver SE – Soporte) ocurre cuando las especies dentro de un AMP aumentan en abundancia, tamaño o producción
            reproductiva, y luego se dispersan fuera del AMP a través del movimiento de adultos, migración de juveniles o exportación
            larval. Estos procesos pueden operar en dos direcciones: un AMP puede proporcionar activamente beneficios de spillover a
            las áreas circundantes, o puede recibir aportes ecológicos de AMPs vecinas, particularmente donde existe conectividad
            ecológica, para generar beneficios de spillover.</p>
            <p><b>El spillover socioeconómico</b> (ver SE – Aprovisionamiento) surge cuando estos procesos ecológicos conducen a mejores capturas, mayor diversidad
            de especies o peces más grandes en las zonas de pesca vecinas. Esto apoya los medios de vida locales.</p>
            <p>En el contexto del análisis IMET, el spillover puede entenderse como un servicio ecosistémico prestado por el área
            marina protegida. Funciona como un servicio de soporte porque las medidas de protección dentro del AMP potencian los
            procesos ecológicos clave, como la reproducción, la recuperación de biomasa y la conectividad ecológica con las áreas
            circundantes. Al mismo tiempo, el spillover constituye un servicio de aprovisionamiento ya que estos procesos ecológicos
            generados localmente o reforzados externamente producen beneficios tangibles para los pescadores y las comunidades
            costeras, como el aumento de las capturas, la mejora de la composición de especies y el mayor tamaño promedio de los peces</p>
            <b class="blue">Cómo evaluar el spillover en IMET</b>
            <ol style="list-style-type:decimal">
                <li>
                    <b>Primero, documente las evidencias</b>
                    <p>Antes de clasificar el spillover, los usuarios de IMET deben completar ambas secciones analíticas.</p>
                    <ul>
                        <li>Servicios ecosistémicos de soporte (spillover ecológico): evalúe las evidencias relacionadas con los procesos
                        ecológicos, como la reproducción, la recuperación de biomasa, el movimiento de adultos, la migración de juveniles
                        o la exportación larval.</li>
                        <li>Servicios ecosistémicos de aprovisionamiento (spillover socioeconómico): evalúe las evidencias relacionadas
                        con los beneficios para los pescadores y las comunidades, como los cambios en las capturas, la composición de
                        especies, el tamaño de los peces o el CPUE.</li>
                    </ul>
                </li>
                <li>
                    <b>Base su clasificación en las evidencias, no en sus suposiciones</b>
                    <p>Tras completar ambas secciones, seleccione la clasificación más adecuada:</p>
                    <ul>
                        <li>Solo soporte: los procesos ecológicos son evidentes, pero los beneficios socioeconómicos no están demostrados.</li>
                        <li>Solo aprovisionamiento: se reportan beneficios para los medios de vida, pero los mecanismos ecológicos no están documentados.</li>
                        <li>Soporte y aprovisionamiento: tanto los procesos ecológicos como los beneficios socioeconómicos están respaldados por evidencias.</li>
                    </ul>
                </li>
                <li>
                    <b>Vincule el spillover con la efectividad de la gestión</b>
                    <p>La clasificación seleccionada informa el análisis IMET en:</p>
                    <ul>
                        <li>C1.5 – Servicios ecosistémicos (importancia y priorización);</li>
                        <li>I1 - Información básica</li>
                        <li>PR7 - Gestión de los valores y amenazas principales (acciones de gestión).</li>
                        <li>O/C2 - resultados ecológicos y/o O/C3: Efectos en la calidad de vida local.</li>
                    </ul>
                </li>
            </ol>',

    ],

    'ManagementStaff' => [
        'title' => 'Tamaño y composición del personal: Personal del área protegida',
        'fields' => [
            'Function' => 'Funciones',
            'ExpectedPermanent' => 'Personal planificado o adecuado *',
            'ActualPermanent' => 'Dotación de personal actual (Autoridad Nacional)',
            'ActualPermanentPartnersOrCommunities' => 'Dotación de personal actual (Socios/Comunidades)',
            'Observations' => 'Notas',
            'difference' => 'Diferencia',
            'Source' => 'Fuente',
        ],
        'module_info' => 'El sistema estadístico permite sólo catorce (14) líneas para identificar las funciones del personal del área protegida',
    ],

    'ManagementStaffPartners' => [
        'title' => 'Tamaño y composición del personal: Personal de las organizaciones asociadas',
        'fields' => [
            'Partner' => 'Socios',
            'Coordinators' => 'Coordinadores (número)',
            'Technicians' => 'Personal técnico y administrativo (número)',
            'Auxiliaries' => 'Personal de apoyo (número)',
        ],
    ],

    'ManagementStaffCommunities' => [
        'title' => 'Tamaño y composición del personal: Personal de las Comunidades',
        'fields' => [
            'Community' => 'Nombre de la Comunidad',
            'Role1' => 'Rol',
            'StaffNUmberRole1' => 'Número',
            'Role2' => 'Rol',
            'StaffNUmberRole2' => 'Número',
            'Role3' => 'Rol',
            'StaffNUmberRole3' => 'Número',
        ],
    ],

    'FinancialResources' => [
        'title' => 'Recursos financieros: Presupuesto y gastos de gestión',
        'fields' => [
            'Currency' => 'Tipo de moneda',
            'ReferenceYear' => 'Año de referencia',
            'ManagementFinancialPlanCosts' => 'Presupuesto total estimados en el Plan de gestión/plan financiero ($ o €/año)',
            'OperationalWorkPlanCosts' => 'Presupuesto total estimados a partir del plan operativo / plan de trabajo (presupuestados anualmente)',
            'TotalBudget' => 'Presupuesto anual total disponible',
        ],
        'amount' => 'Total',
        'functioning_costs' => 'Presupuesto total ($ o euros/km2/año)',
        'estimation_financial_plan' => 'Porcentaje de recursos requeridos por el plan financiero/plan de trabajo (presupuestado anualmente)',
        'estimation_operational_plan' => 'Porcentaje de los recursos requeridos por el plan de trabajo (presupuestado anualmente)',
        'module_info' => 'Costos totales estimados sobre la base del Plan de gestión/plan financiero',
    ],

    'FinancialAvailableResources' => [
        'title' => 'Recursos financieros: Presupuesto disponible',
        'fields' => [
            'BudgetType' => '',
            'NationalBudget' => 'Presupuesto nacional',
            'OwnRevenues' => 'Ingresos de las operaciones del área protegida',
            'Disputes' => 'Ingresos por litigios (tesoro nacional)',
            'Partners' => 'Contribuciones de los socios',
            'total' => 'Total',
            'percentage' => '% del presupuesto previsto',
        ],
        'predefined_values' => [
            '% anual total disponible',
            '% anual total disponible para el funcionamiento',
            '% anual total disponible para inversiones',
        ],
        'module_info' => 'Las cantidades en la misma moneda especificadas en <b>CTX 3.2.1</b>',
        'sum_error' => 'El total debe corresponder al presupuesto total declarado en el módulo <b>CTX 3.2.1</b>',
    ],

    'FinancialResourcesBudgetLines' => [
        'title' => 'Recursos financieros: Partidas presupuestarias del plan operativo/plan de trabajo (presupuestadas anualmente)',
        'fields' => [
            'Line' => 'Partidas del presupuesto',
            'Amount' => 'Cantidad ($ o euros/año)',
            'BudgetSource' => 'Fuente del financiamiento',
            'function_costs' => 'Costos de operación ($ o EUR/Km²/año)',
            'percentage' => '% del presupuesto disponible',
        ],
        'module_info' => 'Las cantidades en la misma moneda especificadas en <b>CTX 3.2.1</b>',
        'sum_error' => 'El total debe corresponder al presupuesto total declarado en el módulo <b>CTX 3.2.1</b>',
    ],

    'FinancialResourcesPartners' => [
        'title' => 'Rol de los socios en el apoyo al área protegida',
        'fields' => [
            'Partner' => 'Socios',
            'Funding' => 'Apoyos (financiación/proyecto/actividades)',
            'Contribution' => 'Monto ($ o euros/año)',
            'StartDate' => 'Proyectos por comenzar',
            'EndDate' => 'Fin esperado',
            'Observations' => 'Notas',
            'Currency' => 'Tipo de moneda',
        ],
        'module_info' => 'Las cantidades en la misma moneda especificadas en <b>CTX 3.2.1</b>',
    ],

    'Equipments' => [
        'title' => 'Disponibilidad de infraestructura, equipo e instalaciones',
        'fields' => [
            'Resource' => 'Categoría',
            'AdequacyLevel' => 'Adecuación',
            'Comments' => 'Fuente/Nota',
        ],
        'groups' => [
            'group0' => 'Infraestructura y bienes administrativos',
            'group1' => 'Alojamiento',
            'group2' => 'Instalaciones turísticas',
            'group3' => 'Medios de transporte',
            'group4' => 'Equipo contra la caza furtiva y/o control y vigilancia',
            'group5' => 'Medios de comunicación',
            'group6' => 'Tecnología de Información',
            'group7' => 'Equipo de generación de agua/energía para servicios',
            'group8' => 'Equipo de mantenimiento para (ver categorías)',
            'group9' => 'Caminos y pistas',
            'group10' => 'Hidrovías',
            'group11' => 'Pistas de aterrizaje',
            'group12' => 'Enlaces y conexiones de la zona protegida con el mundo exterior',
        ],
        'predefined_values' => [
            'group0' => ['Oficinas', 'Puestos de control o campamentos de guardaparques', 'Puntos de barrera o casetas de control', 'Infraestructura científicas', 'Garaje y taller de mantenimiento', 'Espacio para las botellas y otros equipos de buceo', 'Cobertizos para barcos', 'Aparcamiento de coches-barcos', 'Miscelánea (revista, radio, etc.)', 'Centro de atención médica'],
            'group1' => ['Para oficiales y suboficiales', 'Para el personal de los guardaparques', 'Para el personal de apoyo', 'Para el personal científico'],
            'group2' => ['Hoteles (capacidad de hospedaje)', 'Eco-albergues (capacidad de hospedaje)', 'Campamentos (capacidad de hospedaje)', 'Instalaciones de recepción para los turistas', 'Punto observación de fauna y paisaje', 'Rutas turísticas disponibles (km)'],
            'group3' => ['Vehículos/autos y caminonetas', 'Motos/cuadratracks', 'Bicicletas', 'Barcos y/o lanchas', 'Motores fuera de borda', 'Piragua y/o bote a remo', 'Avión, ultraligero', 'Transporte pesado'],
            'group4' => ['Radares de control', 'Armas', 'Cartuchos', 'Uniformes', 'Raciones (viáticos)', 'GPS, brújulas', 'Equipo de campamento y de monte'],
            'group5' => ['Radios VHF/HF', 'V-SAT', 'Teléfonos fijos', 'Teléfonos celular (GSM)', 'Teléfonos satelitales', 'Conexión a Internet'],
            'group6' => ['Computadoras de escritorio', 'Impresoras', 'Fotocopiadoras', 'Computadoras portátiles', 'Inversor'],
            'group7' => ['Generadores de energía', 'Instalación eléctrica solar', 'Instalación hidroeléctrica', 'Instalación eléctrica eólica', 'Suministro de agua'],
            'group8' => ['Vehículos/barcos', 'Radios', 'Edificios', 'Red eléctrica', 'Red hidráulica', 'Transporte pesado'],
            'group9' => ['Caminos/senderos dentro del área protegida', 'Los caminos dentro del área protegida', 'El camino a lo largo del límite del área protegida'],
            'group10' => ['Las vías fluviales dentro del área protegida'],
            'group11' => ['Pistas de aterrizaje dentro y/o fuera del área protegida'],
            'group12' => ['Principales rutas de comunicación terrestre', 'Vías navegables interiores y marítimas', 'Conexiones aéreas nacionales e internacionales'],
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ],
        ],
    ],

    'AnimalSpecies' => [
        'title' => 'Especies animales (emblemáticas, en peligro, endémicas, explotadas, invasoras, etc.) utilizadas como indicadores del estado de conservación del área protegida y que requieren ser monitoreadas a lo largo del tiempo',
        'fields' => [
            'SpeciesID' => 'Especies',
            'CommonName' => 'Nombre común',
            'FlagshipSpecies' => 'BAN',
            'EndangeredSpecies' => 'EN',
            'EndemicSpecies' => 'EDM',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'EBNC',
            'PopulationEstimation' => 'Estado actual estimado',
            'DesiredPopulation' => 'Estado de conservación favorable',
            'TrendRating' => 'Tendencia',
            'Reliability' => 'Fiabilidad',
            'Comments' => 'Fuente/Nota',
        ],
        'module_info' => 'Estado de conservación favorable: Según Natura 2000, el estado de conservación de las especies se considerará "favorable" cuando:<ul>los datos sobre la dinámica de la población de la especie en cuestión indican que se mantiene a largo plazo como un componente viable de sus hábitats naturales, y</li><li>el área de distribución natural de la especie no se está reduciendo ni es probable que se reduzca en un futuro previsible, y existe, y probablemente seguirá existiendo, un hábitat suficientemente grande para mantener sus poblaciones a largo plazo</li></ul>Clasificación: Evaluar a partir de la lista de especies que se supone que existen (véanse las listas de la UICN de A - mamíferos, B - aves y C - anfibios), un número limitado de especies clave de la zona protegida.<br /> <b>Indicadores de especies</b> <ul> <li><b>BAN</b>: Especies emblemáticas o bandera</li> <li><b>EN</b>: Especies en peligro (amenazadas)</li> <li><b>EDM</b>: Especies endémicas</li> <li><b>EXP</b>: Especies explotadas</li> <li><b>INV</b>: Especies invasoras</li> <li><b>EBNC</b>: Especie con bajo nivel de conocimiento</li> </ul> <b>Población estimada:</b> Programa de monitoreo y vigilancia ecológica y generación de un gráfico de tendencias multianual.',
        'validation_min3' => 'Por favor, codifique al menos 3 especies clave',
        'warning_on_save' => 'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'VegetalSpecies' => [
        'title' => 'Especies vegetales (emblemáticas, en peligro, endémicas, explotadas, invasoras, etc.) utilizadas como indicadores del estado del área protegida y que requieren vigilancia a lo largo del tiempo.',
        'fields' => [
            'Species' => 'Especies',
            'FlagshipSpecies' => 'BAN',
            'EndangeredSpecies' => 'EN',
            'EndemicSpecies' => 'EDM',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'EBNC',
            'PopulationEstimation' => 'Estado actual estimado',
            'DesiredPopulation' => 'Estado de conservación favorable',
            'TrendRating' => 'Tendencia',
            'Reliability' => 'Fiabilidad',
            'Comments' => 'Fuente/Nota',
        ],
        'module_info' => 'Estado de conservación favorable:<br />Según Natura 2000, el estado de conservación de las especies se considerará "favorable" cuando:<ul><li>los datos sobre la dinámica de la población de la especie en cuestión, indican que se mantiene a largo plazo como un componente viable de sus hábitats naturales, y</li><li>el área de distribución natural de la especie no se está reduciendo ni es probable que se reduzca en un futuro previsible, y existe, y probablemente seguirá existiendo, un hábitat suficientemente grande para mantener sus poblaciones a largo plazo</li></ul>Clasificación: Evaluar a partir de la lista de plantas que se supone que existen (ver las listas disponibles y la información del parque), un número limitado de plantas clave del área protegida<br /> <b>Indicadores de especies</b> <ul> <li><b>BAN</b>: Especies emblemáticas o bandera</li> <li><b>EN</b>: Especies en peligro de extinción (amenazadas)</li> <li><b>EDM</b>: Especies endémicas</li> <li><b>EXP</b>: Especies explotadas</li> <li><b>INV</b>: Especies invasoras</li> <li><b>EBNC</b>: Especies con bajo nivel de conocimiento</li> </ul> <b>Población estimada:</b> Programa de monitoreo y vigilancia ecológica y generación de un gráfico de tendencias multianual.<br /> <b>Fiabilidad de la información</b> <ul> <li>1: Bajo<li>2: Medio<li>3: Alto</li> </ul>',
        'warning_on_save' => 'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'Habitats' => [
        'title' => 'Hábitats seleccionados como indicadores del área protegida y que deberán ser monitoreados a lo largo del tiempo.',
        'fields' => [
            'EcosystemType' => 'Tipo de hábitat',
            'EcosystemDescription' => 'Descripción detallada del hábitat',
            'EstimatedStatus' => 'Estado estimado',
            'DesiredConservationStatus' => 'Descripción del estado óptimo',
            'Trend' => 'Tendencia',
            'Reliability' => 'Fiabilidad de la información',
            'Sectors' => 'Sectores',
            'Comments' => 'Comentarios/Fuente',
        ],
        'module_info' => 'Nota: Estado de conservación favorable:<br /> Según Natura 2000, el estado de conservación de un hábitat natural se considerará "favorable" cuando:<ul><li><li>su rango natural y las áreas que cubre dentro de ese rango son estables o están en aumento, y</li><li>la estructura y las funciones específicas necesarias para su mantenimiento a largo plazo existen y es probable que sigan existiendo en el futuro previsible</li></ul>Clasificación: Seleccionar y evaluar los parámetros más importantes relacionados con el ecosistema y el hábitat de los ecosistemas y hábitats terrestres y marinos del área protegida.<br /> <b>Nota</b>: La evaluación de hábitats sigue emergiendo como una disciplina, ya que es altamente compleja. La clasificación prevé la siguiente división del territorio: Bioma, Ecorregión, Ecosistema, Hábitat. Las características/valores de los hábitats pueden evaluarse como: <ul> <li>i) bajo amenaza de extinción (dentro de su área de distribución natural),</li> <li>ii) tener un alcance natural reducido,</li> <li>iii) en declive,</li> <li>iv) un ejemplo destacado de características específicas, etc.</li> </ul> La evaluación de los hábitats también puede realizarse desde la perspectiva de: <ul> <li>i) reproducción,</li> <li>ii) nutrición,</li> <li>iii) protección de las especies, etc.</li> </ul> <br /> <b>Fiabilidad de la información</b> <ul> <li>1: Bajo<li>2: Medio<li>3: Alto</li> </ul>',
        'warning_on_save' => 'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'MenacesPressions' => [
        'title' => 'Presiones y amenazas',
        'fields' => [
            'Value' => 'Valores',
            'Impact' => 'Impacto/Severidad',
            'Extension' => 'Escala/Extensión',
            'Duration' => 'Cuánto tiempo',
            'Trend' => 'Tendencia',
            'Probability' => 'Probabilidad de una amenaza en el futuro',
        ],
        'groups' => [
            'group0' => 'Comercial y residencial',
            'group1' => 'Cultivos anuales o multianuales (no leñosos)',
            'group2' => 'Plantaciones de madera y de pasta de papel',
            'group3' => 'Ganadería de pequeña y gran escala',
            'group4' => 'Acuicultura marina y de agua dulce',
            'group5' => 'Otra tipología de producción',
            'group6' => 'Energía y minería',
            'group7' => 'Transporte e infraestructura',
            'group8' => 'Caza y recolección de animales terrestres',
            'group9' => 'Recolección y cosecha de plantas terrestres',
            'group10' => 'La silvicultura y la explotación de la madera',
            'group11' => 'La pesca y la recolección de recursos acuáticos',
            'group12' => 'Perturbación/intrusión humana',
            'group13' => 'Quemas/incendios',
            'group14' => 'Represas y gestión o uso del agua',
            'group15' => 'Otros cambios en el ecosistema',
            'group16' => 'Especies invasoras/problemáticas',
            'group17' => 'Aguas residuales domésticas y urbanas',
            'group18' => 'Efluentes industriales y militares',
            'group19' => 'Efluentes agrícolas y forestales',
            'group20' => 'Basura y residuos sólidos',
            'group21' => 'Contaminación atmosférica',
            'group22' => 'Uso excesivo de energía',
            'group23' => 'Fenómenos geológicos',
            'group24' => 'El cambio climático y los fenómenos',
            'group25' => 'Otras presiones y amenazas',
        ],
        'predefined_values' => [
            'group0' => [
                'Zonas urbanas y residenciales',
                'Zonas comerciales',
                'Áreas turísticas y recreativas',
                'Áreas de enclave',
                'Vías marítimas, puertos, construcciones marítimas',
                'Actividades interiores',
            ],
            'group1' => [
                'Cultivo itinerante',
                'La agricultura en pequeña escala',
                'Grandes empresas agroindustriales',
                'Producción de frutas/huerto vegetal',
            ],
            'group2' => [
                'Pequeñas plantaciones',
                'Plantaciones agroindustriales',
            ],
            'group3' => [
                'El pastoreo nómada',
                'La ganadería y el pastoreo en pequeñas granjas',
                'La ganadería y el pastoreo agroindustrial',
            ],
            'group4' => [
                'Acuicultura de subsistencia o artesanal',
                'Sobre nutriente',
                'Acuicultura industrial',
            ],
            'group6' => [
                'Perforación (gas y petróleo)',
                'Operaciones de minería o canteras',
                'Energías renovables',
            ],
            'group7' => [
                'Carreteras',
                'Redes y líneas de servicios públicos y de comunicación (electricidad, teléfono, acueducto, etc.)',
                'Vías navegables y rutas marítimas',
                'Navegación comercial',
                'Navegación privada',
                'Corredores aéreos',
                'Ferrocarriles',
            ],
            'group8' => [
                'Caza de animales terrestres',
                'Recolección de animales vivos',
            ],
            'group9' => [
                'Recolección de plantas',
                'Cosecha de plantas',
            ],
            'group10' => [
                'Operaciones madereras en pequeña escala',
                'Operaciones de leña a gran escala',
                'Operaciones de leña en pequeña escala',
                'Operaciones madereras a gran escala',
                'Estacas/postes para la construcción',
            ],
            'group11' => [
                'Pesca de subsistencia o en pequeña escala',
                'La pesca a gran escala',
                'La recolección de recursos acuáticos de subsistencia o en pequeña escala',
                'Recolección en gran escala de recursos acuáticos',
                'La recolección de mariscos',
                'Captura/extracción ilegal de fauna marina',
                'Sobrepesca y pesca destructiva',
                'Explotación de especies en peligro',
                'Arrastreros/marinos',
            ],
            'group12' => [
                'Actividades recreativas',
                'Obras y otras actividades',
                'Ruido y otras formas de contaminaciónn',
                'Deportes al aire libre, actividades de ocio y recreativas',
                'Múltiples intrusiones y perturbaciones humanas',
                'Pesca recreativa con anzuelo y sedal',
                'Pesca recreativa con arpón',
                'Baño y pisoteo',
                'Buceo',
                'Guerras, disturbios civiles y ejercicios militares',
            ],
            'group13' => [
                'Frecuencia e intensidad de los incendios',
                'Cambios inducidos por el hombre en las condiciones hidráulicas',
                'Cambios en las condiciones abióticas',
                'Cambios en las condiciones bióticas',
            ],
            'group14' => [
                'Extracción de aguas superficiales (uso doméstico)',
                'Extracción de aguas superficiales (uso comercial)',
                'Extracción de aguas superficiales (uso agrícola)',
                'Extracción de aguas superficiales (uso desconocido)',
                'Extracción de agua subterránea (uso doméstico)',
                'Extracción de agua subterránea (uso comercial)',
                'Extracción de agua subterránea (uso agrícola)',
                'Extracción de agua subterránea (uso desconocido)',
                'Pequeñas presas',
                'Grandes presas',
                'Presas (tamaño desconocido)',
            ],
            'group16' => [
                'Especies o enfermedades introducidas invasivas',
                'Especies o enfermedades endémicas problemáticas',
                'Especies problemáticas o enfermedades de origen desconocido',
                'El material genético introducido',
                'Enfermedades virales o priónicas',
                'Enfermedad de causa desconocida',
                'Evolución bioceánica',
                'Relaciones faunísticas interespecíficas',
                'Modificaciones múltiples del ecosistema',
            ],
            'group17' => [
                'Aguas residuales y alcantarillas',
                'Fugas de líquido y gas',
                'Plásticos',
            ],
            'group18' => [
                'La marea negra',
                'Descargas de buques',
                'Fuga de la minería',
            ],
            'group19' => [
                'Carga de nutrientes',
                'Erosión del suelo y sedimentación',
                'Herbicidas y pesticidas',
                'Contaminación de las cuencas hidrográficas',
            ],
            'group20' => [
                'Desechos municipales',
                'Chatarra/desechos flotantes de barcos de recreo',
                'Los escombros de la construcción',
                'Los residuos que enredan la vida silvestre',
            ],
            'group21' => [
                'Lluvia ácida',
                'Nube de contaminación',
                'Ozono',
            ],
            'group22' => [
                'Contaminación lumínica',
                'Contaminación por calor',
                'Contaminación acústica',
            ],
            'group23' => [
                'Volcanes',
                'Terremotos y tsunamis',
                'Avalanchas y deslizamientos de tierra',
                'Procesos naturales abióticos',
            ],
            'group24' => [
                'Daños y cambios en el hábitat',
                'Sequías',
                'Las temperaturas extremas',
                'Tormentas e inundaciones',
                'Aumento de las precipitaciones y cambios estacionales',
                'Calentamiento, acidificación, blanqueo, desoxigenación',
            ],
            'group25' => [
                'Conflicto entre los seres humanos y la fauna y flora silvestres',
            ],
        ],
        'categories' => [
            'title1' => 'Comercial y residencial',
            'title2' => 'Agricultura y acuicultura',
            'title3' => 'Energía y minería',
            'title4' => 'Transporte e infraestructura',
            'title5' => 'Utilización de los recursos biológicos',
            'title6' => 'Intrusiones/perturbaciones humanas',
            'title7' => 'Cambios en el sistema natural',
            'title8' => 'Especies invasoras/problemáticas',
            'title9' => 'Contaminación',
            'title10' => 'Fenómenos geológicos',
            'title11' => 'Cambio climático y fenómenos',
            'title12' => 'Otras presiones y amenazas',
        ],
        'ratingLegend' => [
            'Impacto' => [
                '0' => 'Suave',
                '1' => 'Moderado',
                '2' => 'Alto',
                '3' => 'Severo',
            ],
            'Extensión' => [
                '0' => 'Localizado <5%',
                '1' => 'Escaso 5-15%',
                '2' => 'Ampliamente disperso 15-50%',
                '3' => 'En todas partes>50%',
            ],
            'Duración' => [
                '0' => 'A corto plazo <5 años',
                '1' => 'Medio plazo 5-20 años',
                '2' => 'Muy largo plazo 20-100 años',
                '3' => 'Permanente>100 años',
            ],
            'Tendencia' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'No hay cambios',
                '1' => 'Ligeramente creciente',
                '2' => 'Incrementa',
            ],
            'Probabilidad de la amenaza en el futuro' => [
                '0' => 'Muy bajo',
                '1' => 'Bajo',
                '2' => 'Medio',
                '3' => 'Alto',
            ],
        ],
        'module_info' => 'La calculadora de amenazas sirve para calcular el impacto de las puntuaciones de las amenazas en un área protegida específica. Usando su mejor juicio profesional, evalúe el impacto de la amenaza explotando cinco categorías de puntuación: (1) Impacto/Severidad; (2) Escala/Extensión; (3) Duración/Irreversibilidad; (4) Tendencia; (5) Probabilidad de la amenaza en el futuro',
        'warning_on_save' => 'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'ClimateChange' => [
        'title' => 'Cambio climático y conservación/ Elementos clave afectados por el cambio climático',
        'fields' => [
            'Value' => 'Elemento clave',
            'Description' => 'Descripción de los efectos del cambio climático',
            'Trend' => 'Efectos del cambio climático',
            'Notes' => 'Notas',
        ],
        'groups' => [
            'group0' => 'Especies animales afectadas por el cambio climático',
            'group1' => 'Especies vegetales afectadas por el cambio climático',
            'group2' => 'Hábitats afectados por el cambio climático',
            'group3' => 'Servicios/funciones de los ecosistemas afectados por el cambio climático',
            'group4' => 'Valores e importancia afectados por el cambio climático',
            'group5' => 'Otros',
        ],
        'module_info' => 'Los productos de la siguiente sección apoyarán las decisiones de gestión para asegurar que el área protegida adopte medidas para minimizar los efectos del cambio climático. El análisis asegurará la incorporación de los valores pertinentes en el sistema de gestión del área protegida',
        'ratingLegend' => [
            'Trend' => [
                '0' => 'Muy afectado por el cambio climático',
                '1' => 'Moderadamente afectado por el cambio climático',
                '2' => 'Poco afectado por el cambio climático',
                '3' => 'No afectado por el cambio climático',
            ],
        ],
        'warning_on_save' => 'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.4</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'EcosystemServices' => [
        'title' => 'Servicios/funciones Ecosistémicas - importancia, dependencia de las comunidades y tendencia de los servicios/funciones del ecosistema que proporciona el área protegida',
        'fields' => [
            'Element' => 'Servicios/funciones Ecosistémicas',
            'Importance' => 'Importancia',
            'ImportanceRegional' => 'Dependencia de los servicios/funciones ecosistémicas',
            'ImportanceGlobal' => 'Tendencia',
            'Observations' => 'Descripción / Condición',
        ],
        'groups' => [
            'group0' => 'Nutrición',
            'group1' => 'Materiales',
            'group2' => 'Energía',
            'group3' => 'Remediación de materiales de desecho, sustancias tóxicas y otra contaminación',
            'group4' => 'Remediación de los flujos',
            'group5' => 'Interacciones físicas y experiencia',
            'group6' => 'Interacciones y actuaciones intelectuales',
            'group7' => 'Espiritual y/o emblemático',
            'group8' => 'Otros servicios/funciones ecosistémicas cultural',
            'group9' => 'Servicios de apoyo',
        ],
        'predefined_values' => [
            'group0' => ['Suministro de agua ', 'Alimentación humana (tubérculos, frutas, miel, setas, algas, etc.) ', 'Alimentación humana  - animal (carne silvestre/de granja, insectos) ', 'Medicamentos y biotecnología azul (aceite de pescado) ', 'Alimentación con peces y ganado (silvestre, de granja, cebo) ', 'Beneficios indirectos en los caladeros vecinos'],
            'group1' => ['Madera de alto valor ', 'Madera para la construcción local ', 'Fibras del tallo (palmas, tasta, chillca, wamanpito, etc.) ', 'Otras fibras (hojas, kapok, coco, etc.) ', 'Recursos ornamentales y de acuario (colección de semillas, conchas y peces) ', 'Arena (para la construcción) ', 'Algas/conchas ', 'Tierras de cultivo (agricultura, ganadería, bosques) '],
            'group2' => ['Leña y biocombustibles ', 'Generación de energía con agua ', 'Fertilizante '],
            'group3' => ['Regulación de gases (secuestro C)', 'Disposición /Enterramiento/eliminación/neutralización de residuos', 'Regulación de los desechos (absorción de nutrientes)', 'Prevención de la erosión costera'],
            'group4' => ['Control de inundaciones', 'Control de sequías', 'Protección contra tormentas', 'Control de la erosión hídrica', 'Control de la erosión eólica', 'Prevención de la erosión costera'],
            'group5' => ['Beneficios estéticos y paisajíticos (integridad del ecosistema)', 'Ecoturismo y observación de la naturaleza', 'Caminatas, excursiones y recreación en general', 'Navegación, natación y buceo', 'Snorkel, navegación y buceo', 'Caza o pesca si está permitido', 'Pesca tradicional especificada'],
            'group6' => ['Investigación y ciencia', 'Educacional', 'La herencia cultural'],
            'group7' => ['Simbólico o histórico', 'Sagrado y/o religioso'],
            'group8' => ['Conservación ex situ'],
            'group9' => ['Producción primaria neta (vegetación)', 'Ciclo de nutrientes (descomposición y mineralización de la basura)', 'Hábitats importantes (hábitats de anidación de aves - playas de desove - guardería)', 'Formación del paisaje marino', 'Especies formadoras de hábitat (por ejemplo, corales)', 'Polinización (plantas)', 'Ciclo del agua', 'Paisaje marino: heterogeneidad/complejidad del hábitat (apoyando la diversidad)', 'Beneficios indirectos en recuperación, reproducción y conectividad de biomasa', 'Conectividad (vínculos ecológicos y continuidad funcional)'],
        ],
        'categories' => [
            'title1' => 'Provisión',
            'title2' => 'Regulación',
            'title3' => 'Cultural',
            'title4' => 'Apoyo',
        ],
        'module_info' => '<b>Servicios/funciones ecosistémicas - importancia, dependencia de las comunidades/sociedades y tendencia de los servicios/funciones ecosistémicas proporcionados por el área protegida</b> <ul> <li>Los productos de la siguiente sección apoyarán las decisiones de gestión para asegurar que se preserven los servicios/funciones  ecosistémicas prestados por el área protegida para el bienestar humano. El análisis asegurará la incorporación de los valores pertinentes en el sistema de gestión del área protegida</li> <li>Clasificación: Evaluación sobre la base de: A) la importancia de determinados servicios/funciones ecosistémicas, B) la dependencia de la población local del servicio/funciones ecosistémicas y C) la tendencia de la cantidad o calidad de los servicios/funciones ecosistémicas prestados por el área protegida, utilizando las escalas siguientes</li> <li>•	No se necesita una medición precisa del valor para asignar una calificación.</li> <li>Se ha eliminado la distinción entre servicios ecosistémicos legales e ilegales. Los usos ilegales de los recursos ecosistémicos ahora se registran sistemáticamente en el módulo de amenazas.</li> </ul>',
        'ratingLegend' => [
            'Importance' => [
                'Local' => 'Importancia limitada a las comunidades locales o regionales (por ejemplo, tubérculos, frutas, leña, etc.)',
                'Larger' => 'La importancia se extiende a las sociedades nacionales y globales (cuenca, turismo, etc.)',
            ],
            'ImportanceRegional' => [
                '0' => 'muy bajo',
                '1' => 'bajo',
                '2' => 'medio',
                '3' => 'alto',
            ],
            'ImportanceGlobal' => [
                '-2' => 'Disminuye',
                '-1' => 'Ligeramente decreciente',
                '0' => 'Sin cambios',
                '1' => 'Ligeramente creciente',
                '2' => 'Incrementa',
            ],
        ],
        'warning_on_save' => 'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado): <br /> <i>C1.5</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

];
