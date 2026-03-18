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

    'definitions' => 'Definition of the terms',

    // General elements
    'general_elements' => 'General elements',
    'country' => 'Country',
    'name' => 'Name',
    'category' => 'Category(ies)',
    'gazetting' => 'Data of gazetting',
    'surface' => 'Surface',
    'agency' => 'Agency',
    'biome' => 'Biome',
    'main_values_protected' => 'Main values for which the protected areas have been gazetted',
    'vision' => 'Vision',
    'mission' => 'Mission',
    'objectives' => 'Objectives',

    // Evaluation elements
    'evaluation_elements' => 'Evaluation of the protected area management cycle elements',

    // Operation recommendations
    'operation_recommendations' => 'Operating recommendations',

    // Planning options
    'planning_options' => 'From IMET diagnosis to planning options',
    'planning_options_info' => [
        'general_info' =>
            '<h6 class="font-bold">From IMET diagnosis to initial planning options</h6>
            <p>IMET provides a structured diagnosis of ecological values, threats and management processes. These results
            form the basis of a simple initial planning exercise using Conservation Action Planning (CAP, see:
            <a target="_blank" href="https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf">https://www.conservationstandards.org/wp-content/uploads/2020/10/Cap20Handbook_June2007-3.pdf)</a>
            logic of The Nature Conservancy (TNC). While IMET does not replace CAP, the following tables can be used to
            identify priority elements, threats, and actions for management plans, annual work plans, and other planning tools',
    ],


    'annexes' => 'Annexes',
    'forest_cover' => 'Forest Cover',
    'total_carbon' => 'Total Carbon',
    'agricultural_pressure' => 'Agricultural pressure',
    'forest_cover_percent' => 'Forest loss and gain',
    'forest_loss' => 'Forest loss',
    'forest_gain' => 'Forest gain',
    'min' => 'Min.',
    'max' => 'Max.',
    'mean' => 'Mean',
    'std_dev' => 'Std. Dev.',
    'sum' => 'Sum',
    'protected_area' => 'Protected Area.',
    'unprotected_buffer' => '10 km Unprotected buffer',

    'ManagementContext' => [
        'title' => 'Management context (key elements of management)',
        'fields' => [
            'key_species' => 'Key species',
            'habitats' => 'Terrestrial and marine habitats - land-cover, land-change and land-take',
            'climate_change' => 'Key values sensitive to climate Change',
            'ecosystem_services' => 'Ecosystem services',
            'threats' => 'Threats',
        ],
    ],

    'ManagementEffectivenessAnalysis' => [
        'title' => 'Management effectiveness analysis (analysis + swot analysis)',
        'fields' => [
            'strengths' => 'Strengths',
            'weaknesses' => 'Weaknesses',
            'opportunities' => 'Opportunities',
            'threats' => 'Threats',
        ],
        'characteristics_elements' => 'Characteristic elements of the protected area in the form of a SWOT exercise',
    ],

    'OperatingRecommendations' => [
        'title' => 'Operating recommendations',
    ],

    'KeyQuestions' => [
        'title' => 'Key questions',
        'fields' => [
            'priorities' => 'What are your management/governance priorities?',
            'minimum_budget' => 'What is your minimum operating budget to ensure the preservation of the values and importance of your protected area?',
            'additional_funding' => 'In the case of additional funding for the management of the protected area what actions would you like to take and for how much time?',
        ]
    ],

    // Planning Options: Table A
    'KeyConservationElements' => [
        'title' => 'Table A. Key Conservation Elements (KCEs), attributes and services',
        'fields' => [
            'num_kce' => 'No.',
            'kces' => 'Key Conservation Elements (KCEs)',
            'targets_and_es' => 'Secondary Targets & Primary Ecosystem Services',
            'kea' => 'Key Ecological Attributes (KEA)',
            'threats' => 'Threats',
            'note' => 'Notes / Justification'
        ],
        'module_info' =>
            'This table A helps IMET users move from diagnosis to planning by identifying the most important ecological
            elements of the Protected Area, the services they provide, their essential characteristics, and the threats to
            act upon them. Each column plays a specific role in structuring early planning decisions.',
        'definitions' => [
            'kces' => '<span class="font-bold italic">Key Conservation Elements (KCEs)</span>: Priority ecological elements (ecosystems, habitats, umbrella species) that must be conserved. They determine the main direction of conservation actions in the protected area',
            'targets_es' => '<span class="font-bold italic">Secondary Targets & Primary Ecosystem Services</span>: The values and services linked to the KCE through the umbrella-species approach mean that protecting the KCE also protects the associated species, habitats and ecosystem services',
            'kea' => '<span class="font-bold italic">Key Ecological Attributes (KEA)</span>: Essential characteristics (area, composition, structure, population size) that define the integrity of the KCE. KEAs guide what must be maintained, monitored, and improved.',
            'threats' => '<span class="font-bold italic">Threats</span>: Pressures that directly affect the KCE and its KEA (e.g. poaching, deforestation, mining). Only include threats that have a real, measurable impact.',
        ]
    ],

    // Planning Options: Table B
    'ThreatsAffectingKCEs' => [
        'title' => 'Table B. Threats affecting key conservation elements',
        'fields' => [
            'threat' => 'Threats',
            'kce1' => 'KCE 1',
            'kce2' => 'KCE 2',
            'kce3' => 'KCE 3',
            'kce4' => 'KCE 4',
            'kce5' => 'KCE 5',
            'kce6' => 'KCE 6',
            'kce7' => 'KCE 7',
            'kce8' => 'KCE 8',
            'kce9' => 'KCE 9',
            'kce10' => 'KCE 10',
            'impact' => 'Threat impact rating'
        ],
        'module_info' =>
            'Table B shows how each threat affects each KCE and highlights where management should focus efforts first.
             By placing threats in the first column and marking their impact across the KCEs, the matrix provides a quick
             visual overview of the most exposed conservation elements and the most critical pressures. This step identifies
             the threats that require management attention first and serves as a direct bridge towards defining the necessary
             improvements and priority activities in Table C',
        'definitions' => [
            'threats' => '<span class="font-bold italic">Threats</span>: Pressures or human activities that negatively affect the Key Conservation Elements (KCEs).',
            'kce' => '<span class="font-bold italic">KCE 1–10</span>: Columns used to indicate whether each threat affects the corresponding KCE and at what intensity. ',
        ],
        'ratingLegend' => [
            'impact' => [
                '0' => 'No threat or threat too low to be considered',
                '1' => 'Low threat',
                '2' => 'Medium threat',
                '3' => 'High threat',
                '4' => 'Very high threat',
            ]
        ]
    ],

    // Planning Options: Table C
    'InitialPlanningOptions' => [
        'title' => 'Initial planning options (IMET → CAP transition table)',
        'fields' => [

        ],
        'module_info' =>
            'Table C translates the IMET diagnosis into practical conservation actions. Starting from the long-term conservation
            goal for each Key Conservation Element (KCE), the user identifies the ecological attributes that must be maintained
            and the main threats to hinder this goal. They then determine the necessary improvements to address these threats.
            This analysis then informs the selection of priority activities, those most likely to reduce threats and strengthen
            the integrity of the KCE. Finally, simple monitoring indicators are defined to track progress and evaluate the effectiveness
            of these activities. Table C therefore provides a direct operational link between IMET results and actionable management
            planning',
        'definitions' => [
            'conservation_goal' => '<span class="font-bold italic">Conservation Goal (long-term)</span>: The desired future condition of the Key Conservation Element (KCE) that management aims to achieve or maintain.',
            'kea' => '<span class="font-bold italic">KEA (attributes to maintain)</span>: The essential ecological characteristics of the KCE that must be preserved (e.g. area, structure, population size).',
            'threats' => '<span class="font-bold italic">Main Threats to address</span>: The specific pressures that prevent the conservation goal from being achieved.',
            'improvements' => '<span class="font-bold italic">Required improvements</span>: The changes needed in management, condition, or governance to reduce threats and maintain the KEAs',
            'activities' => '<span class="font-bold italic">Priority activities (1–2 years)</span>: The key short-term actions that directly contribute to reducing the threats and achieving the improvements.',
            'monitoring' => '<span class="font-bold italic">Monitoring indicators</span>: Simple and measurable variables used to track progress toward the conservation goal and the effectiveness of the activities.',
        ]
    ],



];
