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
    'variability' => 'Variability',
    'scaling_up' => 'Scaling up',
    'conclusions' => 'Conclusions',
    'title' => 'Scaling up analysis report for ',
    'average_contribution_management' => 'Average contribution of the management cycle elements',
    'governance_management' => 'Governance and management',
    'key_conservation_elements' => 'Key conservation elements',
    'climate_change_ecosystem' => 'Climate Change and Ecosystem services',
    'comments' => 'Comments',
    'comment_entire_section' => 'Add comments for the entire section',
    'scaling_legend' => 'Visualizations of values by categories',
    'add_analysis' => 'Add to analysis',
    'error_wrong' => 'An error occurred',
    'error_connection' => 'Something went wrong, please check your Internet connection.',
    'average_explained' => '* Average calculated based on the set of protected areas participating in the scaling-up exercise',
    'ranking_rescaled_indicators' => 'Ranking of indicators rescaled to 0-100',
    'ranking_info_indicators' => '* The scores in the pop-up are the contribution to the synthetic indicator',
    'average_protected_areas' => '* Without selected PAs, the scores are the average of all PAs.  With selected PAs, the average scores relate to the selected PAs.',
    'source' => 'Source',
    'download_files' => 'Download',
    'custom_names' => 'Names of protected areas',
    'apply' => 'Apply',
    'no_value' => 'No value',
    'to' => 'to',
    'less_or_equal_to_zero' => 'Less or equal to 0',
    'size_of_square' => 'The size of the square is proportional to the sum of outputs and outcomes',
    'select_all' => 'Select all',
    'reset' => 'Reset',
    'more_than_one_file' => 'You cannot download only one file',
    'navigation_menu' => 'Navigation menu',
    'name' => 'Name',
    'category' => 'Category',
    'short_name' => 'Color code and short name',
    'add_choices' => 'Add choices',
    'add_all' => 'Add all',
    'close' => 'Close',
    'remove_all' => 'Remove all',
    'average' => 'Average',
    'sections' => [
        'first' => 'Location of the selected protected areas',
        'second' => 'General Information of the protected areas',
        'third' => 'Key elements of conservation',
        'fourth' => 'Overall management effectiveness scores',
        'fifth' => 'Grouping',
        'sixth' => 'Analysis by elements of the management cycle',
        'seventh' => 'Comparison of a protected area within a protected area network',
        'eighth' => 'Synthesis of Management Analyses',
        'ninth' => 'Digital Information for protected areas',
        'list_of_names' => 'List of protected areas',
    ],
    'element_diagrams' => [
        'context' => [
            'main' => [
                'header' => '6.1 Management Context',
                'title' => '6.1.1 Management context overall scores',
                'radar' => '6.1.1.3 Radar visualization of the management context indicators',
                'ranking' => '6.1.1.1 Ranking of management context indicators',
                'average_contribution' => '6.1.1.2 Average contribution and variability of management context indicators',
                'datatable' => '6.1.1.4 Data table of management context indicators',
            ],
            'context_value_and_importance' => [
                'title' => '6.1.2 Value and Importance sub-indicators (all indicators rescaled to 0-100)',
                'radar' => '6.1.2.3 Radar visualization of Value and Importance sub-indicators',
                'ranking' => '6.1.2.1 Ranking of Value and Importance sub-indicators',
                'average_contribution' => '6.1.2.2 Average contribution and variability of the Value and Importance sub-indicators',
                'datatable' => '6.1.2.4 Data table for the Value and Importance sub-indicators',
                'datatable_average' => 'Value and Importance sub-indicators',
            ],
        ],
        'threats' => [
            'threats' => [
                'title' => '6.1.3 Threats indicator',
                'radar' => '6.1.3.3 Radar visualization of threats sub-indicators for each protected area',
                'ranking' => '6.1.3.1 Average contribution of each threat category to the overall level of threats',
                'average_contribution' => '6.1.3.2 Average score and variability of threat categories sub-indicators',
                'datatable' => '6.1.3.4 Ranking of threats categories (sub-indicators)',
            ],
        ],
        'planning' => [
            'main' => [
                'header' => '6.2 Planning',
                'radar' => '6.2.3 Radar visualization of Planning indicators',
                'ranking' => '6.2.1 Ranking of Planning indicators',
                'average_contribution' => '6.2.2 Average score and variability of Planning indicators',
                'datatable' => '6.2.4 Data table of Planning indicators',
            ],
        ],
        'inputs' => [
            'main' => [
                'header' => '6.3 Inputs',
                'radar' => '6.3.3 Radar visualization of Inputs indicators',
                'ranking' => '6.3.1 Ranking of Inputs indicators',
                'average_contribution' => '6.3.2 Average contribution and variability of Inputs indicators',
                'datatable' => '6.3.4 Data table of Inputs indicators',
            ],
        ],
        'process' => [
            'process_sub_indicators' => [
                'header' => '6.4 Processes',
                'title' => '6.4.1 Six sub-elements of the Processes',
                'radar' => '6.4.1.3 Radar visualization of the sub-elements of Processes',
                'ranking' => '6.4.1.1 Ranking of the sub-elements of Processes',
                'average_contribution' => '6.4.1.2 Average score and variability of the sub-elements of Processes',
                'datatable' => '6.4.1.4 Data table of the sub-elements of Processes',
            ],
            'process_internal_management_systems_processes' => [
                'title' => 'PR A: Internal management systems and processes',
                'radar' => 'Radar visualization of Internal management systems and processes',
                'ranking' => 'Ranking of Internal management systems and processes',
                'average_contribution' => 'Average score and variability of Internal management systems and processes indicators',
                'datatable' => 'Data table of Internal management systems and processes',
                'datatable_average' => 'Internal management systems and processes',
            ],
            'process_management_protection_values' => [
                'title' => 'PR B: Management / Protection of the values',
                'radar' => 'Radar visualization of Management / Protection of the values',
                'ranking' => 'Ranking of Management / Protection of the values',
                'average_contribution' => 'Average score and variability of Management/Protection of the values indicators',
                'datatable' => 'Data table of Management / Protection of the values',
                'datatable_average' => 'Management / Protection of the values',
            ],
            'process_stakeholders_relationships' => [
                'title' => 'PR C: Stakeholder relations',
                'radar' => 'Radar  visualization of Stakeholder relations',
                'ranking' => 'Ranking of Stakeholder relations',
                'average_contribution' => 'Average score and variability of Stakeholder relations indicators',
                'datatable' => 'Data table of Stakeholder relations',
                'datatable_average' => 'Stakeholder relations',
            ],
            'process_tourism_management' => [
                'title' => 'PR D: Tourism management',
                'ranking' => 'Ranking of Tourism management',
                'average_contribution' => 'Average score and variability of Tourism management indicators',
                'datatable' => 'Data table of Tourism management',
                'datatable_average' => 'Tourism management',
            ],
            'process_monitoring_and_research' => [
                'title' => 'PR E: Monitoring and Research',
                'ranking' => 'Ranking of Monitoring and Research',
                'average_contribution' => 'Average score and variability of Monitoring and Research indicators',
                'datatable' => 'Data table of Monitoring and Research',
                'datatable_average' => 'Monitoring and Research',
            ],
            'process_effects_of_climate_change' => [
                'title' => 'PR F: Management of the effects of climate change and ecosystem services',
                'ranking' => 'Ranking of the indicators of Management of the effects of climate change and ecosystem services',
                'average_contribution' => 'Average score and variability of the indicators of Management of the effects of climate change and ecosystem services',
                'datatable' => 'Data table of Management of the effects of climate change and ecosystem services',
                'datatable_average' => 'Management of the effects of climate change and ecosystem services',
            ],

        ],
        'outputs' => [
            'main' => [
                'header' => '6.5 Outputs',
                'radar' => '6.5.3 Radar visualization of Outputs indicators',
                'ranking' => '6.5.1 Ranking of Outputs indicators',
                'average_contribution' => '6.5.2 Average score and variability of Outputs indicators',
                'datatable' => '6.5.4 Data table of Outputs indicators',
            ],
        ],
        'outcomes' => [
            'main' => [
                'header' => '6.6 Outcomes',
                'radar' => '6.6.3 Radar visualization of Outcomes indicators',
                'ranking' => '6.6.1 Ranking of Outcomes indicators',
                'average_contribution' => '6.6.2 Average score and variability of Outcomes indicators',
                'datatable' => '6.6.4 Data table of Outcomes indicators',
            ],
        ],
    ],
    'general_info' => [
        'country' => 'Countries',
        'network' => 'Network of',
        'transbondary_name' => 'Name of Transbondary area - Landscape',
        'category_protected_area' => 'Category(ies) or protected areas',
        'main_values' => 'Main values of the network – transbondary area - landscape',
        'total_surface_protected' => 'Total surface of the protected areas',
        'total_surface_landscape' => 'Total surface of the landscape',
        'agency' => 'Agency - Agencies',
        'ecoregions' => 'Ecoregions',
        'vision' => 'Protected areas with a vision',
        'mission' => 'Protected areas with a mission',
        'objectives' => 'Protected areas with objectives',
    ],
    'additional_options' => [
        'management_effectiveness_analysis' => '8.1 Management effectiveness analysis',
        'summary_key_elements_affecting_management_elements' => '8.2 Summary of Key Elements Affecting Management',
    ],
    'grouping' => [
        'title' => '5.1 Grouping',
        'add_country' => 'Add by country',
        'reset' => 'Reset',
        'add_group' => 'Add group',
        'render_radar' => 'Render radar',
        'render_scatter' => 'Render scatter',
        'scatter_plot' => '5.3 Visualization of groups with a scatter plot',
        'radar' => '5.2 Visualization of groups with a radar',
        'group' => 'Group',
    ],
    'management_context' => [
        'key_species' => 'Key species',
        'animal_species_chart' => 'Animal species',
        'plant_species_chart' => 'Plant species',
        'habitats_chart' => 'Habitats',
        'threats_charts' => 'Threats',
        'values_sensitive_chart' => 'Values sensitive to climate change',
        'ecosystem_services_chart' => 'Important ecosystem services',
        'animal_species' => 'Animal species (flagship, endangered, endemic, ...)',
        'occurrences_species' => 'Key animal species present in two or more Protected Areas ',
        'occurrences_plants' => 'key plants species present in two or more Protected Areas ',
        'occurrences_habitats' => 'habitats present in two or more Protected Areas ',
        'occurrences_climate' => 'Key values sensitive to climate change present in two or more Protected Areas ',
        'occurrences_ecosystem_services' => 'Ten most important ecosystems present in two more Protected Areas ',
        'occurrences_threats' => 'Five most important threats present in two or more Protected Areas',
        'plants_species' => 'Plants species (flagship, endangered, endemic, ...)',
        'terrestrial_marine_habitats' => 'Terrestrial and marine habitats - land-cover, land-change and land-take',
        'climate_change' => 'Key values sensitive to climate change',
        'ecosystem_services' => 'Ecosystem services',
        'comments_threats' => 'Comments on Threats',
        'comments_ecosystem' => 'Comments on Ecosystem services',
        'comments_climate' => 'Comments on Climate Change',
        'comments_terrestrial' => 'Comments on Terrestrial and marine habitats -land-cover, land-change and land-take',
        'comments_plants_species' => 'Comments on Key plants species',
        'comments_animal_species' => 'Comments on Key species',
        'label_threats' => 'Threats',
        'comment_on_management_context' => 'Comments for Management context (key elements of management)',
    ],
    'protected_area_coverage_and_connectivity' => [
        'title',
        'chart' => 'Country coverage by protected areas and connected protected areas (connectivity)',
        'total_land_area' => 'Total Land Area [km2]',
        'protected_land_area' => 'Protected Land Area [km2]',
        'terrestrial_coverage' => 'Terrestrial Coverage [%]',
        'total_marine_area' => 'Total Marine Area [km2]',
        'protected_marine_area' => 'Protected Marine Area [km2]',
        'marine_coverage' => 'Marine Coverage [%]',
        'protected_connected_land' => 'Protected Connected Land [%]',
    ],
    'land_degradation' => [
        'indicators' => [
            'title' => 'Land degradation',
            'chart' => 'Land degradation',
            'no_biomas' => 'No biomas [km2]',
            'persistent_severe' => 'Persistent severe decline in productivity [km2]',
            'persistent_moderate' => 'Persistent moderate decline in productivity [km2]',
            'stable_stressed' => 'Stable, but stressed; persistent strong inter-annual productivity variations [km2]',
            'stable_productivity' => 'Stable Productivity [km2]',
            'persistent_increase' => 'Persistent increase in productivity [km2]',
        ],
        'bar_indicators' => [
            'no_biomas' => 'No biomas [km2]',
            'persistent_severe' => 'Persistent severe decline in productivity [km2]',
            'persistent_moderate' => 'Persistent moderate decline in productivity [km2]',
            'persistent_strong' => 'Stable, but stressed; persistent strong inter-annual productivity variations [km2]',
            'stable_productivity' => 'Stable Productivity [km2]',
            'persistent_increase' => 'Persistent increase in productivity [km2]',
        ],
    ],
    'relative_performance_effectiveness_bar_average' => [
        'titles' => [
            'context_sub_indicators' => 'Average contribution of the six sub-indicators to Value and Importance',
            'context' => 'Average contribution of the main indicators to the Management context',
            'planning' => 'Average contribution of the Planning indicators',
            'inputs' => 'Average contribution of the Inputs indicators',
            'process' => 'Average contribution of the Process indicators',
            'process_sub_indicators' => 'Average contribution of the six sub-elements of the Process indicators',
            'outputs' => 'Average contribution of the Outputs indicators',
            'outcomes' => 'Average contribution of the Outcomes indicators',
        ],
        'legends' => [
            'context_sub_indicators' => 'Sub-indicators to Value and Importance',
            'context_indicators' => 'indicators to the Management context',
            'planning_indicators' => 'Planning indicators',
            'inputs_indicators' => 'Inputs indicators',
            'process_indicators' => 'Process indicators',
            'process_sub_indicators' => 'Sub-elements of the Process indicators',
            'outputs_indicators' => 'Outputs indicators',
            'outcomes_indicators' => 'Outcomes indicators',
        ],
    ],
    'protected_area' => [
        'name' => 'Name',
        'gis_area' => 'Area [km2]',
        'nature' => 'Type',
    ],
    'map' => [
        'fields' => [
            'area_prot_terr_perc' => 'Protected Land',
            'protconn' => 'Protected Connected Land',
        ],
    ],
    'overall' => [
        'imet_indicator_ranking' => 'Ranking according to IMET Indicator',
        'radar_visualization' => 'Radar visualization of IMET synthetic indicators',
        'scatter_visualization' => 'Scatter plot visualization of IMET synthetic indicator',
        'average_contribution' => 'Average score and variability of IMET synthetic indicators',
        'synthetic_indicators' => 'Data table of IMET synthetic indicators',
    ],
    'scale' => [
        'negative_positive' => ' - scale (min: -100, max: 100)',
        'zero_negative' => ' - scale (min: -100, max: 0)',
    ],
    'legends' => [
        'PRA' => [
            'PR A',
        ],
        'PRB' => [
            'PR B',
        ],
        'PRC' => [
            'PR C',
        ],
        'PRD' => [
            'PR D',
        ],
        'PRE' => [
            'PR E',
        ],
        'PRF' => [
            'PR F',
        ],
    ],
    'guidance' => [
        'info' => [
            'ranking' => 'The following histograms show the values of different dimensions of management effectiveness and indicators or criteria per protected area.',
            'average_contribution' => 'This bar chart displays the average and the variability of indicators for the selected protected areas.',
            'radar' => 'Please select protected areas to be displayed in the radar by clicking on their names. Data table will appear automatically. It provides an overview of IMET scores for each of the protected areas chosen to appear on the radar.',
            'scatter_plot' => 'This scatter plot utilises horizontal and vertical axes as well as the size of the square to display the values of IMET indicators. The visualisation displays only protected areas that were selected at the beginning of this section.',
            'datatable' => 'The table provides an overview of IMET scores for each indicator for the set of selected protected areas. You can sort each column either from lowest to highest values, highest to lowest values, or alphabetically. Sorting option is available for all data tables.',
            'group_radar' => 'The analysis visualises management effectiveness in each of the groups using radar visualisation and a data table.',
            'group_scatter' => 'The visualisation displays a three-dimensional diagram using the horizontal and vertical axes as well as the size to display the values of three variables simultaneously for each group. It also displays the data table.',
        ],
        'threats' => [
            'datatable' => 'Bar charts provide score of protected areas for a given threat category.',
        ],
        'special_information' => ['intro' => '<b>‘Add to analysis’ button</b> <br/><br/>Use ‘Add to analysis’ to save the visualisation and your comments in the clipboard. <br/><br/><b>Additional guidance</b>: You can save a specific table by clicking on the ‘Add to analysis’ button. The table is saved as an image which is accessible through the small window that appears on the right side of the screen for all scaling up analyses. If you place the mouse arrow over the small window, you will be able to access a pre-view of saved image(s). The pop-up window allows you to (1) print the image(s) in PDF format by clicking on the white printer icon, (2) right-click on the image to copy the image into Word, Excel, or PowerPoint documents, (3) delete the image(s) by clicking on the red bin button. Please note that the red bin button deletes all saved images! If you want to delete a single image, use the X icon that is displayed at the top of the image.'],

        'custom_names' => [
            'intro' => 'For readability and better visualisation of the values, you should rename the protected areas used in the analysis. The suggested length should be no more than 12 characters with spaces.',
            'info' => '<b>Additional guidance</b>: This list presents the protected areas you selected for the scaling up analysis. For better readability and visibility, it is possible to shorten the names of protected areas, so that all visualisations will be clearer and easier to read. The shortened name will be used for the rest of the scaling-up analyses. Replacing the names does not modify the original IMET file. On the left, full names of selected protected areas, as in their original IMET files, are displayed, and, on the right, shortened versions can be provided. We suggest not to exceed 12 characters including spaces. For example, “Moyen-Bafing National Park” can be renamed “Moyen-Bafing” (12 characters with spaces) or “M.Bafing” (8 characters). Once new names are assigned, validate them by clicking the ‘apply’ button.'],
        'list_of_pas' => [
            'intro' => 'Section 1 lists the original and shortened names of protected areas. It also displays automatically the assigned colour that is used for further visual representations.',
            'info' => '<b>Additional guidance</b>: Note that the ‘Add to analysis’ function will add to the clipboard the image using its current dimensions.'],
        'map' => [
            'intro' => 'The map shows the location of protected areas chosen for the analysis. It can be enlarged or reduced. Selected protected areas are displayed in red but some may fail to display (if no proper information about them is available in the database).',
            'info' => '<b>Additional guidance</b>:Section 1 provides the locations of protected areas marked in red on the map. It is possible that the current scaling up does not display all selected protected areas because either they do not have a WDPA ID or they are too small to be visible. The map can be enlarged or reduced in size. Note that the ‘Add to analysis’ function will save the image at the size of your choice.'],
        'general_elements' => [
            'intro' => 'Section 2 displays the general information on protected areas selected for the scaling up analysis',
            'info' => '<b>Additional guidance</b>: In section 2, Vision, Mission and Objectives sub-sections display only protected areas for which this information is available. However, to access information relevant for a specific protected area it is necessary to open the IMET file of the protected area.'],
        'key_elements' => [
            'intro' => 'This section reports the key elements of conservation (click on the arrow symbol) reported for the selected protected areas.',
            'info' => '<b>Additional guidance</b>: Section 3 presents 5 sets of key conservation elements of selected protected areas. They are displayed on histograms. Click on the small triangle located on the left of each of the key elements to drop down the histograms.  Each key element can be individually saved with the ‘Add to analysis’ button.'],
        'overall' => [
            'intro' => 'This section enables analysis of the overall scores for all or some of the selected protected areas. ',
            'info' => '<b>Additional guidance</b>: Section 4 enables analysis of all or some of the protected areas selected for the scaling up. Protected areas can be selected individually by clicking on the related box or in a single step by clicking on the “Select All” button. Once you have selected the protected areas, you activate the analysis by clicking on the “Apply” button.<br/><br/> This analysis should not be confused with the Grouping analysis (section 5). In this section, you can select all or some, but at least two protected areas. It displays the synthetic indicators of management cycle elements, which are grouped in 5 different analyses: (1) IMET indicator ranking with a histogram, (2) Average score and variability with a bar-chart with whiskers, (3) Radar visualisation, (4) Scatter plot visualisation, (5) Data table where you can sort each column either from lowest to highest values, highest to lowest, or alphabetically.',
            'table' => '<b>Suggestion: Overall analysis of groups of protected areas</b><br/><br/>If your analysis involves many protected areas with high variability in management effectiveness scores, clustering allows you to narrow down (and group) your findings. In this case you can use the section 5 ’Overall management of effectiveness scores’ to analyse different groups by selecting only the protected areas belonging to a particular group.'],
        'grouping' => [
            'intro' => ' Grouping allows narrowing the analysis of IMET results to “families” of protected areas with the greatest homogeneity of values and at the same time the greatest divergence of values with respect to other families. ',
            'info' => '<b>Additional guidance</b>: Section 5 analyses performance of protected areas in groups. Clustering aims to create groups of protected areas with the greatest possible homogeneity of scores for the six elements of the management cycle within a group and the greatest possible heterogeneity between groups. For this reason, we suggest starting to organise groups of protected areas according to their IMET index. For instance, the group of all protected areas with the IMET score above 60, the others between 40 and 60, and those below 40. The choice of combination depends on the heterogeneity of index values. You can drag each protected area to selected white box. You can create more groups with the “+Add a group” button or delete a group by clicking on the bin icon. Once groups are created, two options for analysis are offered with two different visualisations: a radar and a scatter. You should save the “render radar” and “render scatter” separately when specific analysis has been completed. Scaling up does not allow you to save both analyses at the same time.'],
        'analysis_per_element' => [
            'intro' => 'This section provides a more detailed analysis for all the indicators belonging to the six elements of the management cycle. This analysis is oriented to respond to specific questions or to develop specific action plans in the selected protected areas. For each section, you can select all or only some of the protected areas initially chosen for the scaling up analysis.',
            'info' => '<b>Additional guidance</b>: Section 6 presents all the indicators belonging to the six elements of the management cycle. This analysis can be used to respond to specific questions (such as ‘Which threats are the most common?’ ‘How are climate change effects integrated in protected areas management?), or to develop specific action plans to improve specific aspects (such as law enforcement, tourism management, etc.) in selected protected areas. In total, section 6 contains fourteen analyses, all organised according to the same logical structure as analyses in section 4 ‘Overall management of effectiveness scores’. Such an organisation of the analysis  facilitates the use of scaling up tool.<br/><br/> Section 6, like section 4, allows you to analyse all or only some (but at least two) protected areas selected for the scaling up. For this reason, the analyses begin with an option to select the protected areas that are displayed in the selection table. Protected areas can be selected individually by clicking on the related box to the left of the protected area name or globally by clicking on the ‘Select All’ button.<br/><br/> Once you have selected the protected areas by clicking on the ‘Apply’ button, the analysis is activated.'],
        'context' => [
            'main' => [
                'intro' => 'This sub-section allows you to analyse the Management context and its three indicators: C1 Value and Importance, C2 External supports and Constraints and C3 Threats. Three different types of analysis can be executed (1) overall (see 6.1.1), (2) Management context (see 6.1.2), (3) Threats (see 6.1.3).',
            ],
            'overall_scores' => [
                'intro' => 'This sub-section presents Management context indicators in one of the four available types of visualisations (1) Ranking, (2) Bar-chart of scores and variability of Management Context indicators, (3) Radar, (4) Data table. Select protected areas to be displayed in the radar by clicking on their names. Data table will be rendered automatically. Manual selection allows comparisons to be made between protected areas (see grouping). <br/><br/>You can sort each column of the Data table either from lowest to highest, highest to lowest, or alphabetically.'],
            'context_value_and_importance' => [
                'intro' => 'This sub-section presents Management context indicators in one of the four available types of visualisations (1) Ranking, (2) Bar-chart of average scores and variability within Management context sub-categories, (3) Radar, (4) Data table. Select protected areas to be displayed in the radar by clicking on their names. Data table will be rendered automatically. Manual selection allows comparisons to be made between protected areas (see grouping). <br/><br/>You can sort each column of the Data table either from lowest to highest, highest to lowest, or alphabetically.'],
            'threats' => [
                'intro' => 'This sub-section provides an in-depth analysis of threats present in the analysed protected areas.',
                'info' => '<b>Additional guidance</b>: It presents (1) Radar of threats’ sub-indicators for each protected area (to identify the most relevant threats for each protected area), (2) Average contribution of threat sub-categories to the overall threat score (to identify the most pertinent threats in the group of protected areas), (3) Average score and variability of threat categories sub-indicators (to identify how diverse is the impact of each threat within the group of protected areas), (4) Ranking per threat categories sub-indicators for all of the twelve threat categories (to identify the most affected protected areas). Note that the ‘Radar of threats’ shows a visualisation that is the opposite of all other radars. The most important threats values are those closer to the centre of the radar.'],
        ],
        'planning' => [
            'main' => [
                'intro' => 'The sub-section allows to analyse Planning and its six indicators.',
                'info' => '<b>Additional guidance</b>: This sub-section presents planning indicators in one of the four available types of visualisations (1) Ranking, (2) Bar-chart of average scores and variability of Planning indicators, (3) Radar, (4) Data table. The analysis ‘Radar of indicators’ requires the selection of protected areas for the radar and the corresponding data table. The manual selection allows comparisons to be made between protected areas (see grouping).<br/><br/> You can sort each column of the Data table either from lowest to highest, highest to lowest, or alphabetically.'],
        ],
        'inputs' => [
            'main' => [
                'intro' => 'The sub-section allows analysing the Inputs and its five indicators.',
                'info' => '<b>Additional guidance</b>: This sub-section presents Inputs indicators in one of the four available types of visualisations (1) Ranking, (2) Bar-chart of average scores and variability of Inputs indicators, (3) Radar, (4) Data table. The analysis ‘Radar of indicators’ requires the selection of protected areas for the radar and the corresponding data table. The manual selection allows comparisons to be made between protected areas (see grouping).<br/><br/> You can sort each column of the Data table either from lowest to highest, highest to lowest, or alphabetically.']],
        'process' => [
            'main' => [
                'intro' => 'The sub-section allows analysing the Processes, its six sub-elements and eighteen related indicators.',
                'info' => '<b>Additional guidance</b>: This sub-section presents Processes indicators in one of the four available types of visualisations (1) Ranking, (2) Bar-chart of average scores and variability of Processes six sub-elements, (3) Radar, (4) Data table. The analysis ‘Radar of indicators’ requires the selection of protected areas for the radar and the corresponding data table. The manual selection allows comparisons to be made between protected areas (see grouping).<br/><br/> You can sort each column of the Data table either from lowest to highest, highest to lowest, or alphabetically. Once you have selected the protected areas by clicking on the ‘Apply’ button, you activate the analysis.'],
            'overall' => [
                'intro' => 'Six Sub Elements of the Process',
                'info' => ''],
            'PRA' => ['intro' => 'PR A: Internal management systems and processes', 'info' => ''],
            'PRB' => ['intro' => 'PR B: Management / Protection of the values', 'info' => ''],
            'PRC' => ['intro' => 'PR C: Stakeholder relations', 'info' => ''],
            'PRD' => ['intro' => 'PR D: Tourism management', 'info' => ''],
            'PRE' => ['intro' => 'PR E: Monitoring and Research', 'info' => ''],
            'PRF' => ['intro' => 'PR F: Management of the effects of climate change and ecosystem services', 'info' => ''],
        ],
        'outputs' => [
            'main' => [
                'intro' => 'The sub-section allows analysing the Outputs and its 3 indicators.',
                'info' => '<b>Additional guidance</b>: This sub-section presents Outputs indicators in one of the four available types of visualisations (1) Ranking, (2) Bar-chart of scores contribution and variability of Output indicators, (3) Radar, (4) Data table. The analysis ‘Radar of indicators’ requires the selection of protected areas for the radar and the corresponding data table. The manual selection allows comparisons to be made between protected areas (see grouping).<br/><br/> You can sort each column of the Data table either from lowest to highest, highest to lowest, or alphabetically. <br/><br/><br/>Once you have selected the protected areas by clicking on the ‘Apply’ button, you activate the analysis.']],
        'outcomes' => [
            'main' => [
                'intro' => 'The sub-section allows to analyse the Outcomes and its 3 indicators.',
                'info' => '<b>Additional guidance</b>: This sub-section on presents Outputs indicators in one of the four available types of visualisations (1) Ranking, (2) Bar-chart of average scores and variability of Outcomes indicators, (3) Radar, (4) Data table. The analysis ‘Radar of indicators’ requires the selection of protected areas for the radar and the corresponding data table. The manual selection allows comparisons to be made between protected areas if necessary (see grouping).<br/><br/> You can sort each column of the Data table either from lowest to highest, highest to lowest, or alphabetically.<br/><br/><br/> Once you have selected the protected areas by clicking on the ‘Apply’ button, you activate the analysis.']],
        'relative_performance' => [
            'intro' => 'This section enables comparison of the scores of the 6 management cycle elements of a protected area to the average value of all protected areas.',
            'info' => '<b>Additional guidance</b>: The section presents two different types of analyses comparing the situation of one protected area and the average situation of other protected areas: (1) Radar view of the IMET synthetic indicator averages for all protected areas and the selected area, (2) Data table of the IMET synthetic indicator averages of all protected areas and the selected area. Note that the section does not allow to compare a protected area with other protected areas selected for the scaling up analysis.'],
        'additional_options' => [
            'main' => [
                'intro' => 'Section 8 contains two sub-sections that help to synthesise aspects of management (1) Analysis of Management Effectiveness, (2) Synthesis of Key Elements Affecting Elements of Management.',
                'info' => ''],
            'management_effectiveness' => [
                'intro' => 'Considering all the analyses provided in the previous sections, provide for each of the six distinct dimensions of management effectiveness a summary or a comment of your main findings.',
                'info' => '<b>Additional guidance</b>: The PAME assessment is based on the idea that protected area management follows a process grouped in six distinct stages (representing management effectiveness elements): (1) it begins with reviewing context and establishing a vision for site management (within the context of existing status and pressures), (2) progresses through planning, (3) allocation of resources (inputs), (4) management actions (process), which lead to (5) production of goods and services (outputs), and (6) generate impacts or outcomes. '],
            'specific_actions_mention' => [
                'intro' => 'All the analyses available in earlier sections, can be used to generate a summary or a comment on the following topics: 1) governance and management, 2) key conservation elements, 3) climate change and ecosystem services, 4) threats.',
                'info' => '<b>Additional guidance</b>: With regards to all of the protected area elements identified during the assessment (cf. 8.2 ‘Management effectiveness analysis’), please provide – if relevant – additional considerations (synergies, partnerships, initiatives, etc.)'],
        ],
    ],
];
