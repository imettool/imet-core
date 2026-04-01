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

    'spillover_waring_message' => 'Only if the CTX 2.5 section has been analyzed',
    'connectivity_waring_message' => 'Only if the CTX 2.4 section has been analyzed',

    'Objectives' => [
        'title' => 'Setting objectives',
        'fields' => [
            'Element' => 'Element/Indicator',
            'Status' => 'Baseline',
            'Objective' => 'Objective - Optimal or favourable status',
            'Comments' => 'Comments',
        ],
    ],

    'Objectives1' => [
        'module_info' => 'Establish and describe objectives for the governance, partnerships and the designation of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area',
    ],
    'Objectives2' => [
        'module_info' => 'Establish and describe objectives for <b>boundaries, configuration index, extension of patrols and law enforcement and territorial context</b> of the protected area</b><br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area',
    ],
    'Objectives3' => [
        'module_info' => 'Establish and describe objectives for <b>human and financial resources/support from partnerships in managing</b> of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area',
    ],
    'Objectives4' => [
        'module_info' => ' Establish and describe objectives or GL performance thresholds for key factors: <b> i) animal species ii) plant species; iii) habitats and iv) land-cover change </b> of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.<br />The GL performance thresholds for these conservation elements correspond to Component 4 - Criterion 4.1 - Generic indicator 4.1.1 or 4.1.2',
    ],
    'Objectives5' => [
        'module_info' => 'Establish and describe objectives for <b>threats</b> facing the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.<br />The GL performance thresholds for these conservation elements correspond to Component 4 - Criterion 4.1 - Generic indicator 4.1.1 or 4.1.2 considering the threats as condition to improve to prevent loss of the value',
    ],
    'Objectives6' => [
        'module_info' => 'Establish and describe objectives for <b>climate change effects</b> facing the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.<br />The GL performance thresholds for these conservation elements correspond to Component 4 - Criterion 4.1 - Generic indicator 4.1.1 or 4.1.2 considering the effects of climate change as a condition to improve to prevent loss of the value',
    ],
    'Objectives7' => [
        'module_info' => 'Establish and describe objectives for <b> the ecosystem services and the dependence on these services of communities/societies</b> in the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.<br />The GL performance thresholds for these conservation elements correspond to Component 4 - Criterion 4.2 - Generic indicator 4.2.1 for the ecosystem services for provisioning, regulation and supporting values and Criterion 4.3 - Generic indicator 4.3.1 for the ecosystem services related to cultural values',
    ],

    'GeneralInfo' => [
        'title' => 'Basic data',
        'fields' => [
            'CompleteName' => 'Full name of the protected area',
            'CompleteNameWDPA' => 'Name of the protected area in the WDPA site',
            'WDPA' => 'WDPA ID (www.protectedplanet.net)',
            'UsedName' => 'Name by which protected area is referred to',
            'Type' => 'typology',
            'NationalCategory' => 'National category',
            'IUCNCategory1' => '1st IUCN category',
            'IUCNCategory2' => '2nd IUCN category',
            'IUCNCategory3' => '3rd IUCN category',
            'MarineDesignation' => 'Marine designation',
            'Country' => 'Country',
            'CreationYear' => 'Year created',
            'Institution' => 'Supervisory institution(s)',
            'Biome' => 'Biome',
            'Ecoregions' => 'Reference ecoregion(s) [Ecoregions G200, Olson, WWF; Spalding M. and colleaues 2007]',
            'Ecotype' => 'Ecotypes (up to three elements descending by the predominance)',
            'ReferenceText' => 'Reference to the designation of the gazetting text',
            'ReferenceTextDocument' => '',
            'ReferenceTextValues' => 'What is the importance of the protected area and its main values for which it has been designated? (Provide a list and then a brief description)',
        ],
        'module_info' => '<b>Introduction to typology</b>: IMET identifies three categories of protected areas: (1) Terrestrial (2)
            Marine and Coastal (3) conserved area.<br />In the Governance section (CTX 1.2)
            you can refine the management and governance typology of these three protected area typologies. If you are analysing a
            Protected and Conserved Areas (PCAs), you can specify the territorial context in CTX 2.4.Protected area (general definition):
            A protected area is a clearly defined geographical space, recognised, dedicated and managed, through legal or other effective means,
            to achieve the long term conservation of nature with associated ecosystem services and cultural values. (IUCN Definition 2008)',
        'type_info' => [
            'terrestrial' => 'A terrestrial protected area (TPA) is a portion of land protected by special restrictions
            and laws for the conservation of the natural environment. They include large tracts of land
            set aside for the protection of wildlife and its habitat; areas of great natural beauty or unique interest;
            areas containing rare forms of plant and animal life; areas representing unusual geologic formation; places
            of historic and prehistoric interest; areas containing ecosystems of special importance for scientific
            investigation and study; and areas which safeguard the needs of the biosphere. (GEMET- DODERO / WPR)
            (we check for a CBD description)',
            'marine_and_coastal' => 'A marine and coastal protected area (MPA or MCPA) is "an area within or adjacent
            to the marine environment, together with its overlying waters and associated flora, fauna, and historical and
            cultural features, which has been reserved by legislation or other effective means, including custom, with the
            effect that its marine and/or coastal biodiversity enjoys a higher level of protection than its surroundings"
            (Convention on Biological Diversity – CBD)',
            'oecm' => 'A geographically defined area other than a Protected Area, which is governed and managed in ways
            that achieve positive and sustained long-term outcomes for the insitu conservation of biodiversity, with
            associated ecosystem functions and services and where applicable, cultural, spiritual, socio–economic, and
            other locally relevant values” (CBD, 2018)',
            'icca' => 'A natural and/or modified ecosystems, containing significant biodiversity values, ecological benefits
            and cultural values, voluntarily conserved by indigenous peoples and local communities, through customary laws
            or other effective means (CBD -Recognising and Supporting ICCAs)',
        ],
    ],

    'Governance' => [
        'title' => 'Governance and partnership',
        'fields' => [
            'Partner' => 'NList your partnerships (if any)',
            'InstitutionType' => 'Kind of institution',
            'PartnershipsType1' => 'The most important partnership: first',
            'PartnershipsType2' => 'second',
            'PartnershipsType3' => 'third',
            'GovernanceModel' => 'Governance model',
            'SubGovernanceModel' => 'Sub-governance model',
            'AdditionalInfo' => 'Additional information on governance model (if needed)',
        ],
        'governance' => 'Governance',
        'partnership' => 'Partnerships',
        'module_info' => 'This section describes the existing governance structure and stakeholder partnerships within the protected
             area. It outlines the key institutions involved, kind of decision-making processes, stakeholder roles and
             the level of coordination between actors. It also highlights the current partnerships supporting conservation
             efforts and their role in management implementation.',
    ],

    'SpecialStatus' => [
        'title' => 'Special designations (World Heritage, MAB, Ramsar site, IBAs, SPAMI, LMMA, etc. )',
        'fields' => [
            'Designation' => 'Designation',
            'RegistrationDate' => 'Date of inscription',
            'Code' => 'Code',
            'Area' => 'Area (ha)',
            'DesignationCriteria' => 'Criteria for designation',
            'upload' => 'upload',
        ],
        'groups' => [
            'conventions' => 'Designations (inclusions) in the international conventions list (World Heritage, RAMSAR, etc.)',
            'networks' => 'Membership of an officially recognized international network (MAB, RAPAC etc.)',
            'conservation' => 'Designation for the status of conservation importance by international bodies (IBA, AZE, etc.)',
            'marine_pa' => 'Designation of marine protected areas',
        ],
        'module_info' => 'This section outlines the official designations given to the protected area, such as World Heritage Sites,
            Man and Biosphere Reserves (MAB), Ramsar Sites, Important Bird Areas (IBA), Specially Protected Areas of
            Mediterranean Importance (SPAMI) and Locally Managed Marine Areas (LMMA). These designations reflect the
            ecological importance of the area and influence its management framework, conservation priorities and
            international obligations.',
    ],

    'Networks' => [
        'title' => 'Membership of a local management network',
        'fields' => [
            'NetworkName' => 'Name',
            'ProtectedAreas' => 'Names of other protected areas within the network',
        ],
        'groups' => [
            'group0' => 'Transboundary network',
            'group1' => 'Landscape network (terrestrial and marine protected areas) - Network (marine network)',
            'group2' => 'Other networks',
        ],
        'module_info' => 'This section describes the protected area\'s membership of various management networks at local, transboundary
            and landscape levels. It identifies links with other protected areas within these networks and highlights
            collaborative frameworks for conservation and management relevant to the protected area',
    ],

    'Missions' => [
        'title' => 'Vision - Mission - Objectives',
        'fields' => [
            'LocalVision' => 'At local or national level Vision',
            'LocalMission' => 'Mission',
            'LocalObjective' => 'Objectives',
            'LocalSource' => 'Source',
            'LocalManagementPlan' => 'File (Management plan)',
            'InternationalVision' => 'At international level Vision',
            'InternationalMission' => 'Mission',
            'InternationalObjective' => 'Objectives',
            'InternationalSource' => 'Source',
            'InternationalManagementPlan' => 'File (Management plan)',
            'Observation' => 'Observation',
        ],
        'module_info' => 'This section presents the strategic framework for the protected area, including its vision, mission and
            management objectives.:
            <ul>
            <li><b>Vision of the protected area</b>: The vision is basically a plan for how the PA should be in the future,
            covering ecology, society and governance. It\'s the big goal that guides everything we do to conserve and
            manage the area.</li>
            <li><b>Mission of the protected area</b>: The mission explains what the PA is trying to do and how it fits in with
            the vision. It says what we\'re responsible for, how we\'ll manage things, and the rules for how we\'ll use
            the area in a way that\'s good for the environment and the local people.</li>
            <li><b>Long-Term objectives of the protected area</b>: The long-term objectives are like a roadmap, turning the
            vision and mission into specific goals that guide management efforts over the next 10 to 20 years. These
            objectives are based on the key areas of conservation, governance, and sustainability, making sure that
            the PA does its job in terms of ecology and the economy.</li>
            </ul>',
    ],

    'Contexts' => [
        'title' => 'References of historical, political, legal and institutional and socio-economic contexts of the protected area ',
        'fields' => [
            'Context' => 'Specific context or elements',
            'file' => 'File(s)',
            'Summary' => 'Summary',
            'Source' => 'Source',
            'Observations' => 'Notes',
        ],
        'predefined_values' => [
            'Historic context',
            'Socio-economic context',
            'Political context (country)',
            'Legal context',
            'Institutional context',
        ],
        'module_info' => 'This section provides an overview of the key contextual factors affecting the protected area. It includes
            <ul>
            <li><b>Historical context</b>: Key events and milestones that have shaped the conservation and management
            of the area.</li>
            <li><b>Socio-economic context</b>: The role of the protected area in local livelihoods, economic activities
            and community interactions.</li>
            <li><b>Political context (country level)</b>: Governance structures, policy frameworks and political influences
            affecting decision making.</li>
            <li><b>Legal and institutional context</b>: Relevant laws, regulations and institutions that apply to the
            protected area.</li>
            <li><b>Institutional context</b>: The roles and responsibilities of key institutions involved in the management
            and governance of the area.</li>
            </ul>
            These elements define the broader framework within which the protected area operates.',
    ],

    'GeographicalLocation' => [
        'title' => 'Localisation',
        'fields' => [
            'LimitsExist' => 'Existence of georeferenced official limits (yes / no)',
            'Shapefile' => 'GIS file',
            'SourceSHP' => 'Source of GIS file',
            'Coordinates' => 'Geographic coordinates (baseline for or key point in the park)',
            'SourceCoords' => 'Source',
            'AdministrativeLocation' => 'Administrative location of the protected area (province, region, etc.)',
        ],
        'module_info' => 'This section provides information on the geographical location of the protected area. It includes its
            coordinates, administrative location of the protected areas. The description highlights the position of the
            protected areas within a wider territorial context.',
    ],

    'Areas' => [
        'title' => 'Surface area of the protected area and conservation context',
        'fields' => [
            'BoundaryLength' => 'Boundary length',
            'AdministrativeArea' => 'Administrative surface',
            'WDPAArea' => 'Surface according to WDPA',
            'GISArea' => 'Actual surface (GIS for the park or the authority responsible for protected areas) corresponding to the uploaded file',
            'TerrestrialArea' => 'Terrestrial protected area',
            'MarineArea' => 'Marine and coastal protected area',
            'PercentageNationalNetwork' => 'Surface % of national network of protected areas',
            'PercentageEcoregion' => 'Surface % of ecoregion',
            'PercentageTransnationalNetwork' => 'Surface % of transboundary network',
            'PercentageLandscapeNetwork' => 'Surface % of landscape/network',
            'Index' => 'Configuration index [Shape index<br />&radic;(3.14)/(6.28)*perimeter/&radic;(area) =<br /> good 1 - 1.5; average 1.5 - 2; low > 2]',
            'Observations' => 'Notes',
        ],
        'module_info' => 'This section provides key data on the size, boundary length, terrestrial and marine coverage and spatial
            configuration of the property. It also situates the property within national, ecoregional, transboundary and
            landscape conservation networks, highlighting its role in wider conservation efforts.',
    ],

    'Sectors' => [
        'title' => 'Patrolling and Enforcement: Terrestrial area or sectors and/or Marine and coastal area or sectors',
        'fields' => [
            'Name' => 'Sector',
            'TerrestrialOrMarine' => 'Terrestrial or marine?',
            'UnderControlArea' => 'Km² of area covered by patrol',
            'UnderControlPatrolKm' => 'Km of patrols',
            'UnderControlPatrolManDay' => 'Days of patrol',
            'SectorMap' => 'Zoning maps',
            'Source' => 'Source',
            'Observations' => 'Notes',
        ],
        'module_info' => '<b>Average Patrol Day-Km² in African National Parks - Standard Practice</b>:
            For effective management, <b>some studies and park management guidelines suggest an average of 1-4 patrol
            days per square kilometre per year</b>. This means that for every square kilometre of protected area, rangers
            should ideally spend between 1 and 4 days patrolling each year.
            <ul>
            <li><b>Higher intensity in high threat areas</b>: In areas with high poaching pressure or significant
            biodiversity, the recommended rate may increase to 5-10 patrol days per square kilometre per year, or even
            higher. This increased patrol effort is critical to deterring poachers and responding quickly to threats.</li>
            <li><b>Lower intensity in low-risk areas</b>: In contrast, lower risk areas or areas where wildlife threats
            are minimal may require fewer patrols, possibly less than 1 patrol day per square kilometre per year.</li>
            </ul>
            <b>Note on Kruger National Park, South Africa</b>: Due to the high threat of rhino poaching, parts of Kruger
            have patrol intensities of 10 patrol days per square kilometre per year or more.',
        'area_percentage' => '% of the area',
        'average_time' => 'Average patrol * d * km² of the sector',
    ],

    'TerritorialReferenceContext' => [
        'title' => 'Baseline territorial context (Landscape) of the Protected Area',
        'fields' => [
            'FunctionalHasNoTakeArea' => 'Does the functional ecosystem zone correspond to the protected area?',
            'FunctionalArea' => 'Estimate the functional ecosystem area that is important for the maintenance of biodiversity of the protected area (e.g. home ranges of flagship species ): a) in Km² and b) in Km as width of the outer strip',
            'FunctionalPopulation' => 'Estimate the size of local population living within the functional ecosystem area',
            'EcologicalAspects' => 'Estimate the presence of the environmental factors, e.g. home ranges of flagship species (in km2) (Km2)',
            'BenefitArea' => 'Estimate the inhabited area around the protected area that benefits from the ecosystem services delivered by the protected area: a) in km² and b) in Km as width of the outer strip',
            'BenefitPopulation' => 'Estimate the size of local population living within the socio-economic area of influence',
            'BenefitSocioEconomicAspects' => 'List and describe the socio-economic and administrative factors (e.g. traditional or modern roles about natural resources establish by traditional and modern authorities) that influence the protected area management',
        ],
        'categories' => [
            'FunctionalEcosystemArea' => 'Functional ecosystem area',
            'BenefitsOfEcosystemServicesArea' => 'Area that benefits of the ecosystem services of the protected area',
        ],
        'module_info' => '<b>Landscape</b>: Linked governance and management of a protected area and its surrounding territories
          can contribute to biodiversity conservation and climate resilience, maintenance of natural resources and ecosystem
          services that ensure sustainable development of local communities. <br />
          <b>Protected and Conserved Areas (PCAs)</b>: They are one of the most effective tools for preventing loss of
          natural ecosystems and species, as well as to achieve long-term sustainable development, including Aichi targets
          11 and 12 and several Sustainable Development Goals (SDGs). In some regions, PCAs are the center of economic
          development, through tourism, sustainable use of resources and as sources of freshwater. PCAs also contribute
          to food security through maintenance of the ecosystem services that support agriculture, by protecting resources
          essential for crop breeding programmes, and by providing space for traditional biodiversity-friendly farming and
          grazing systems. PCAs also have a major role to play in climate resilience, both by storing and sequestering carbon,
          and by ensuring that ecosystems continue to provide goods and services to human societies (WWF).',
    ],

    'Connectivity' => [
        'title'  => 'Connectivity',
        'fields' => [
            'DocumentedConnectivity' => '1.	First, document the evidence',
            'EvidenceOfConnectivity' => '2.	Base your classification on the evidence, not your assumptions',
            'ConnectivityIntegrationInManagementPlan' => '3. Analyse the degree of integration of connectivity in management planning',
        ],
        'sub_titles' => [
            'DocumentedConnectivity' => 'Is there documented structural connectivity between the protected area and surrounding habitats (corridors, habitat continuity, marine currents, stepping stones)?',
            'EvidenceOfConnectivity' => 'Is there evidence of functional connectivity (species movement, migration, genetic exchange, larval dispersal)?',
            'EvidencesListConnectivity' => 'Indications and evidence may include:',
            'ConnectivityIntegrationInManagementPlan' => 'Is connectivity integrated into management planning?',
        ],
        'connectivity_title' => 'How to assess connectivity in IMET',
        'link_to_me' => '4.	Link connectivity to management effectiveness',
        'link_to_me_details' => '
            <p>The selected classification informs IMET analysis across:</p>
            <ul>
                <li>C1.5 – Ecosystem services (importance and prioritisation)</li>
                <li>I1 - Basic information</li>
                <li>PR7 - Management of key values and threats (management actions)</li>
                <li>O/C2 - Ecological outcomes and/or O/C3: Effects on local quality of life</li>
            </ul>',

        'module_info' => '<p>Connectivity refers to the structural and functional ecological linkages between the protected area and
            surrounding habitats or ecosystems that enable key ecological processes such as species movement, gene flow,
            migration, larval dispersal, and climate adaptation.</p>
             <b class="blue">Description</b>
             <p>Connectivity sustains the long-term viability of the site’s major natural values and underpins processes such as
             biomass recovery and spillover.</p>
            <p>Connectivity can be:</p>
            <ul>
                <li>Structural: the physical continuity of habitats, corridors, stepping stones and currents.</li>
                <li>Functional (the actual movement of species, gene flow and dispersal patterns);</li>
                <li>Ecological (maintenance of trophic links and ecosystem processes across boundaries).</li>
            </ul>
            <p>In marine systems, connectivity may include:</p>
            <ul>
                <li>Adult migration routes</li>
                <li>Current systems and larval dispersal networks</li>
                <li>Habitat continuity (reefs, seagrass and mangroves).</li>
            </ul>
            <p>In terrestrial systems:</p>
            <ul>
                <li>Corridors</li>
                <li>Buffer zones</li>
                <li>Ecological networks</li>
                <li>Transboundary linkages</li>
            </ul>
            <p>Connectivity supports:</p>
            <ul>
                <li>Ecological resilience</li>
                <li>Spillover dynamics</li>
                <li>The long-term viability of key conservation elements</li>
                <li>Climate adaptation</li>
            </ul>',
    ],

    'Spillover' => [
        'title' => 'Spillover',
        'fields' => [
            'SupportingEvidence' => 'Q1. Assessment of Ecological Spillover evidence',
            'SupportingKeyObservations' => 'Q2. Evidence and Key Observations',
            'SupportingOtherObservation' => 'Specify',
            'SupportingPerceivedSpeciesChange' => 'Q3. Perceived change in species monitoring/caught',
            'SupportingPerceivedSizeChange' => 'Q4. Perceived change in size of main target species',
            'SupportingComments' => 'Notes',
            'ProvisioningEvidence' => 'Q1. Assessment of Provisioning Spillover evidence',
            'ProvisioningKeyObservations' => 'Q2. Evidence and key observations',
            'ProvisioningOtherObservation' => 'Specify',
            'ProvisioningPerceivedCatchChange' => 'Q3. Perceived change in catch near the MPA',
            'ProvisioningPerceivedSpillover' => 'Q4. Do fishers perceive a spillover effect from the MPA?',
            'ProvisioningComments' => 'Notes',

        ],
        'sub_titles' => [
            'SupportingEvidence' => 'Is there scientific or monitoring evidence of ecological spillover from the MPA (e.g. biomass gradients, tagging, larval export, habitat improvement near boundaries)?',
            'SupportingKeyObservations' => 'Please describe the main observations or information that support your assessment in Q1',
            'SupportingPerceivedSpeciesChange' => 'In those same fishing grounds outside the MPA, how do MPA staff/fishers perceive the variety and composition of species in their monitoring/catch compared to before the MPA?',
            'SupportingPerceivedSizeChange' => 'How do MPAS staff/fishers perceive the average size of the main species they target in areas outside but close to the MPA, compared to before the MPA?',
            'ProvisioningEvidence' => 'Is there scientific, monitoring, or documented evidence that the PA generates provisioning spillover benefits in neighboring fishing grounds (e.g. improved catches, larger fish, changes in species composition, increased Catch Per Unit Effort -CPUE)?',
            'ProvisioningKeyObservations' => 'Briefly describe the key observations supporting your choice (e.g. monitoring results, community feedback, research findings, ranger or fisheries officer observations)',
            'ProvisioningPerceivedCatchChange' => 'Compared with the period before the MPA was established, how do MPA staff/fishers who operate outside but close to the MPA perceive the change in their total catch per trip?',
            'ProvisioningPerceivedSpillover' => 'Do fishers believe that the presence of the MPA has contributed to better catches in the areas where they fish (for example, because fish move out from inside the MPA or aggregate near its boundary)?',
        ],
        'other_labels' => [
            'SupportingTitle' => 'Supporting (ES – Support)',
            'SupportingSubTitle' => 'Used when ecological processes (e.g. reproduction, biomass recovery, larval export) are known or suspected, but socio-economic effects are not demonstrated. Spillover will then be analysed mainly in the ecological context and outcomes',
            'ProvisioningTitle' => 'Provisioning ecosystem service (ES – Provisioning)',
            'ProvisioningSubTitle' => 'Used when fishers or communities report improved catches, larger fish or changes in species composition without documented ecological mechanisms. The analysis will focus on livelihoods and socio-economic outcomes.',
        ],
        'module_info' => '<p>Spillover refers to the ecological and socio-economic benefits generated by a protected area, particularly
            a marine protected area (MPA), that extend beyond its boundaries or are received from neighbouring protected
            areas within a connected landscape or seascape.</p>
            <b class="blue">Description</b>
            <p><b>Ecological spillover</b> (see ES - Support) occurs when species within a MPA increase in abundance, size or reproductive output,
            and then disperse outside the MPA through adult movement, juvenile migration or larval export. These processes can
            operate in two directions: an MPA may actively deliver spillover benefits to surrounding areas, or it may receive
            ecological inputs from neighbouring MPAs, particularly where there is ecological connectivity, to deliver spillover
            benefits.</p>
            <p><b>Socio-economic spillover</b> (see ES – Provisioning) arises when these ecological processes lead to improved catches, greater species
            diversity or larger fish in neighbouring fishing grounds. This supports local livelihoods.</p>
            <p>In the context of IMET analysis, spillover can be understood as an ecosystem service provided by the marine
            protected area. It functions as a supporting service because protection measures within the MPA enhance key
            ecological processes, such as reproduction, biomass recovery and ecological connectivity with surrounding areas.
            At the same time, spillover constitutes a provisioning service as these locally generated or externally reinforced
            ecological processes produce tangible benefits for fishers and coastal communities, such as increased catches,
            improved species composition and larger average fish size</p>
            <b class="blue">How to assess spillover in IMET</b>
            <ol style="list-style-type:decimal">
                <li>
                    <b>First, document the evidence</b>
                    <p>Before classifying spillover, IMET users should complete both analytical sections.</p>
                    <ul>
                        <li>Supporting ecosystem services (ecological spillover): assess evidence related to ecological processes,
                        such as reproduction, biomass recovery, adult movement, juvenile migration or larval export.</li>
                        <li>Provisioning ecosystem services (socio-economic spillover): assess evidence related to the benefits for
                        fishers and communities, such as changes in catches, species composition, fish size or CPUE.</li>
                    </ul>
                </li>
                <li>
                    <b>Base your classification on the evidence, not your assumptions</b>
                    <p>After completing both sections, select the most appropriate classification:</p>
                    <ul>
                        <li>Supporting only: ecological processes are evident, but socio-economic benefits are not demonstrated.</li>
                        <li>Provisioning only: benefits to livelihoods are reported, but the ecological mechanisms are not documented.</li>
                        <li>Supporting and provisioning: both ecological processes and socio-economic benefits are supported by evidence.</li>
                    </ul>
                </li>
                <li>
                    <b>Link spillover to management effectiveness</b>
                    <p>The selected classification informs IMET analysis across:</p>
                    <ul>
                        <li>C1.5 – Ecosystem services (importance and prioritisation);</li>
                        <li>I1 - Basic information</li>
                        <li>PR7 - Management of key values and threats (management actions).</li>
                        <li>O/C2 - ecological outcomes and/or O/C3: Effects on local quality of life.</li>
                    </ul>
                </li>
            </ol>',

    ],

    'ManagementStaff' => [
        'title' => 'Size and composition of staff: Staff of protected area',
        'fields' => [
            'Function' => 'Functions',
            'ExpectedPermanent' => 'Planned or adequate staffing *',
            'ActualPermanent' => 'Current actual staffing (National authority)',
            'ActualPermanentPartnersOrCommunities' => 'Current actual staffing (from partners/communities)',
            'Observations' => 'Notes',
            'difference' => 'Difference',
            'Source' => 'Source',
        ],
        'module_info' => 'The statistical system allows only fourteen lines to identify the functions of the staff of the protected area',
    ],

    'ManagementStaffPartners' => [
        'title' => 'Size and composition of staff: Staff from partner organisations',
        'fields' => [
            'Partner' => 'Partners',
            'Coordinators' => 'Coordinators (number)',
            'Technicians' => 'Technical and administrative staff (number)',
            'Auxiliaries' => 'Auxiliary staff (number)',
        ],
    ],

    'ManagementStaffCommunities' => [
        'title' => 'Size and composition of staff: Staff from Communities',
        'fields' => [
            'Community' => 'Community',
            'Role1' => 'Role',
            'StaffNUmberRole1' => 'Number',
            'Role2' => 'Role',
            'StaffNUmberRole2' => 'Number',
            'Role3' => 'Role',
            'StaffNUmberRole3' => 'Number',
        ],
    ],

    'FinancialResources' => [
        'title' => 'Financial resources: Budget and management costs',
        'fields' => [
            'Currency' => 'Currency',
            'ReferenceYear' => 'Baseline year',
            'ManagementFinancialPlanCosts' => 'Total budget estimated on multiannual Financial plan ($ or €/year)',
            'OperationalWorkPlanCosts' => 'Total budget estimated on Working plan (budgeted annually)',
            'TotalBudget' => 'Total annual budget actually available',
        ],
        'amount' => 'Total',
        'functioning_costs' => 'Total budget ($ or €/km2/year)',
        'estimation_financial_plan' => '% of resources required by Financial plan (annual budget)',
        'estimation_operational_plan' => '% of resources required by the Working plan (annual budget)',
        'module_info' => 'Estimated total costs based on Financial plan',
    ],

    'FinancialAvailableResources' => [
        'title' => 'Financial resources: Available budget',
        'fields' => [
            'BudgetType' => '',
            'NationalBudget' => 'National budget',
            'OwnRevenues' => 'Revenues from the operations of the protected area',
            'Disputes' => 'Income from litigation (national treasury)',
            'Partners' => 'Contributions from the partners',
            'total' => 'total',
            'percentage' => '% of planned budget',
        ],
        'predefined_values' => [
            'Total annual budget available',
            'Total annual budget available for operating',
            'Total annual budget available for investments',
        ],
        'module_info' => 'Amounts in the same currency specified in <b>CTX 3.2.1</b>',
        'sum_error' => 'The total should correspond to the total budget declared in the module <b>CTX 3.2.1</b>',
    ],

    'FinancialResourcesBudgetLines' => [
        'title' => 'Financial resources: Budget items of the operational or working plan (budgeted annually)',
        'fields' => [
            'Line' => 'Budget items',
            'Amount' => 'Amount ($ or €/year)',
            'BudgetSource' => 'Source of funding',
            'function_costs' => 'Operation costs ($ or € /Km²/year)',
            'percentage' => '% of available budget',
        ],
        'module_info' => 'Amounts in the same currency specified in <b>CTX 3.2.1</b>',
        'sum_error' => 'The total should correspond to the total budget declared in the module <b>CTX 3.2.1</b>',
    ],

    'FinancialResourcesPartners' => [
        'title' => 'Role of the partners in supporting the protected area',
        'fields' => [
            'Partner' => 'Partners',
            'Funding' => 'Supports (financing / project / activities)',
            'Contribution' => 'Amount ($ or € / year)',
            'StartDate' => 'Beginning',
            'EndDate' => 'Expected end',
            'Observations' => 'Notes',
            'Currency' => 'Currency',
        ],
        'module_info' => 'Amounts in the same currency specified in <b>CTX 3.2.1</b>',
    ],

    'Equipments' => [
        'title' => 'Availability of infrastructure, equipment and facilities',
        'fields' => [
            'Resource' => 'Category',
            'AdequacyLevel' => 'Adequacy',
            'Comments' => 'Source / Note',
        ],
        'groups' => [
            'group0' => 'Administrative buildings',
            'group1' => 'Accommodation',
            'group2' => 'Tourism facilities',
            'group3' => 'Means of transport',
            'group4' => 'Anti-poaching equipment',
            'group5' => 'Means of communication',
            'group6' => 'IT',
            'group7' => 'Water/Power generation equipment for services',
            'group8' => 'Maintenance equipment for (see categories)',
            'group9' => 'Roads and tracks',
            'group10' => 'Waterways',
            'group11' => 'Airstrips',
            'group12' => 'Links and connections of the protected area with the outer world',
        ],
        'predefined_values' => [
            'group0' => ['Offices', 'Patrol posts', 'Barrier points', 'Scientific buildings', 'Garage and workshop', 'Room for dive bottles and other dive gear', 'Boat sheds', 'Car-Boat parking', 'Miscellaneous services (magazine, radio, etc.)', 'Health care centre'],
            'group1' => ['For officers and deputy officers', 'For ranger staff', 'For support staff', 'For scientific staff'],
            'group2' => ['Hotels (guest capacity)', 'Eco-lodges (guest capacity)', 'Encampments (guest capacity)', 'Reception facilities for tourists', 'Viewpoints or Observation points', 'Available tourist routes (km)'],
            'group3' => ['Cars', 'Motorbike/Quads', 'Bicycles', 'Boats', 'Outboard motors', 'Pirogues', 'Aeroplane, microlight', 'Heavy engines'],
            'group4' => ['Control radar', 'Weapons', 'Cartridges', 'Uniforms', 'Rations (per diem)', 'GPS, compasses', 'Camping and bush equipment'],
            'group5' => ['VHF/HF radios', 'V-SAT', 'Landline telephones', 'GSM telephones', 'Satellite telephones', 'Internet connection'],
            'group6' => ['Desktop computers', 'Printers', 'Photocopiers', 'Laptop computers', 'Inverter'],
            'group7' => ['Power generators', 'Solar electric facility', 'Hydropower electric facility', 'Wind electric facility', 'Water supply'],
            'group8' => ['Vehicles/boats', 'Radios', 'Buildings', 'Electrical network', 'Hydraulic network', 'Heavy engines'],
            'group9' => ['Roads/tracks inside the protected area', 'Paths inside the protected area', 'Road along the border'],
            'group10' => ['Waterways inside the protected area'],
            'group11' => ['Airstrips inside and outside the protected area'],
            'group12' => ['Major land-based communication routes', 'Inland and maritime waterways', 'National and international air connections'],
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ],
        ],
    ],

    'AnimalSpecies' => [
        'title' => 'Animal species (flagship, endangered, endemic, exploited, invasive, etc.) used as indicators for the state of the protected area and requiring monitoring over time',
        'fields' => [
            'SpeciesID' => 'Species',
            'CommonName' => 'Common name',
            'FlagshipSpecies' => 'FLA',
            'EndangeredSpecies' => 'EDG',
            'EndemicSpecies' => 'EDM',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'LLK',
            'PopulationEstimation' => 'Estimated current status',
            'DesiredPopulation' => 'Favourable conservation status',
            'TrendRating' => 'Trend',
            'Reliability' => 'Reliability',
            'Comments' => 'Source / Note',
        ],
        'module_info' => 'Favourable conservation status: From Natura 2000, the conservation status of species is considered ‘favourable’ when:<ul>population dynamics data on the species concerned indicate that it is maintaining itself on a long-term basis as a viable component of its natural habitats, and</li><li>the natural range of the species is neither being reduced nor is likely to be reduced in the foreseeable future, and there is, and will probably continue to be, a sufficiently large habitat to maintain its populations on a long-term basis</li></ul>Rating: Evaluate from the list of species that are assumed to exist (see the IUCN’s lists of A - mammals, B - birds and C - amphibians), a limited number of key species of the protected area.<br /> <b>Species types</b> <ul> <li><b>FLA</b>: Flagship species</li> <li><b>EDG</b>: Endangered (threatened) species</li> <li><b>EDM</b>: Endemic species</li> <li><b>EXP</b>: Exploited species</li> <li><b>INV</b>: Invasive species</li> <li><b>LLK</b>: Species with low level of knowledge</li> </ul> <b>Estimated population:</b> Ecological monitoring programme and generation of trend graph.',
        'validation_min3' => 'Please encode not less than 3 key species',
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following
            evaluation modules (if already encoded): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'VegetalSpecies' => [
        'title' => 'Plant species (flagship, endangered, endemic, exploited, invasive, etc.) used as indicators for the state of the protected area and requiring monitoring over time',
        'fields' => [
            'Species' => 'Species',
            'FlagshipSpecies' => 'PHA',
            'EndangeredSpecies' => 'MEN',
            'EndemicSpecies' => 'END',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'INS',
            'PopulationEstimation' => 'Estimated current status',
            'DesiredPopulation' => 'Favourable conservation status',
            'TrendRating' => 'Trend',
            'Reliability' => 'Reliability',
            'Comments' => 'Source / Note',
        ],
        'module_info' => 'Favourable conservation status:<br />From Natura 2000, the conservation status of species is considered ‘favourable’ when:<ul><li>population dynamics data on the species concerned indicate that it is maintaining itself on a long-term basis as a viable component of its natural habitats, and</li><li>the natural range of the species is neither being reduced nor is likely to be reduced in the foreseeable future, and there is, and will probably continue to be, a sufficiently large habitat to maintain its populations on a long-term basis</li></ul>Rating: Evaluate from the list of the plants that are assumed to exist (see the lists available and park information), a limited number of key plants of the protected area<br /> <b>Species types</b> <ul> <li><b>PHA</b>: Flagship species</li> <li><b>MEN</b>: Endangered (threatened) species</li> <li><b>END</b>: Endemic species</li> <li><b>EXP</b>: Exploited species</li> <li><b>INV</b>: Invasive species</li> <li><b>INS</b>: Species with low level of knowledge</li> </ul> <b>Estimated population:</b> Ecological monitoring programme and generation of multiannual trend graph.<br />',
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following
            evaluation modules (if already encoded): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'Habitats' => [
        'title' => 'Habitats selected as indicators for the protected area and that will need to be monitored over time',
        'fields' => [
            'EcosystemType' => 'Type of habitat',
            'Value' => 'Description of the status or value',
            'Area' => 'Surface area (ha)',
            'DesiredConservationStatus' => 'Favourable conservation status',
            'Trend' => 'Trend',
            'Reliability' => 'Reliability of information',
            'Sectors' => 'Sectors',
            'Comments' => 'Comments / Source',
        ],
        'module_info' => 'Note: Favourable conservation status:<br />From Natura 2000, the conservation status of a natural habitat is considered ‘favourable’ when:<ul><li><li>its natural range and areas it covers within that range are stable or increasing, and</li><li>the specific structure and functions which are necessary for its long-term maintenance exist and are likely to continue to exist for the foreseeable future</li></ul>Rating: Select and evaluate the most important ecosystem and habitat-related parameters of terrestrial and marine habitats of the protected area.<br /> <b>Note</b>: Habitat evaluation is still emerging as a discipline, since it is highly complex. The classification provides for the following division of territory: Biome, Ecoregion, Ecosystem, Habitat. Habitat characteristics/values can be assessed as: <ul> <li>i) under threat of extinction (within their natural range),</li> <li>ii) having a reduced natural range,</li> <li>iii) in decline,</li> <li>iv) an outstanding example of specific characteristics, etc.</li> </ul> Assessment of habitats can also be performed from the perspective of: <ul> <li>i) reproduction,</li> <li>ii) nutrition,</li> <li>iii) species protection, etc.</li> </ul>',
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following
            evaluation modules (if already encoded): <br /> <i>C1.3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'MenacesPressions' => [
        'title' => 'Pressures on and threats',
        'fields' => [
            'Value' => 'Values',
            'Impact' => 'Impact/ Severity',
            'Extension' => 'Scale/ Extent',
            'Duration' => 'Duration',
            'Trend' => 'Trend',
            'Probability' => 'Probability for the threat in future',
            'Comments' => 'Comments',
        ],
        'groups' => [
            'group0' => 'Commercial and residential',
            'group1' => 'Annual or multi-annual crops (non-woody)',
            'group2' => 'Wood and pulpwood plantations',
            'group3' => 'Small- and large-scale livestock farming',
            'group4' => 'Marine and freshwater aquaculture',
            'group5' => 'Other typology of production',
            'group6' => 'Energy and mining',
            'group7' => 'Transport and infrastructure',
            'group8' => 'Hunting and harvesting of land animals',
            'group9' => 'Gathering and harvesting of land plants',
            'group10' => 'Forestry and timber harvesting',
            'group11' => 'Fishing and harvesting aquatic resources',
            'group12' => 'Human disturbance / intrusion',
            'group13' => 'Bush fires (fires)',
            'group14' => 'Dams and water management or use',
            'group15' => 'Other changes in the ecosystem',
            'group16' => 'Invasive / challenging species',
            'group17' => 'Domestic and urban waste water',
            'group18' => 'Industrial and military effluent',
            'group19' => 'Agricultural and forestry effluents',
            'group20' => 'Rubbish and solid waste',
            'group21' => 'Atmospheric pollution',
            'group22' => 'Excessive energy use',
            'group23' => 'Geological phenomena',
            'group24' => 'Climate change effects',
            'group25' => 'Other pressures and threats',
        ],
        'predefined_values' => [
            'group0' => [
                'Urban and residential areas',
                'Commercial areas',
                'Tourist and recreational areas',
                'Enclave areas',
                'Shipping lanes, ports, marine constructions',
                'Inland activities',
            ],
            'group1' => [
                'Shifting cultivation',
                'Smallholder farming',
                'Large agro-industrial enterprises',
                'Production fruits/ vegetable garden',
                'Extraction of fertilizer for agriculture',
            ],
            'group2' => [
                'Small plantations',
                'Agro-industrial plantations',
            ],
            'group3' => [
                'Nomadic grazing',
                'Livestock farming and grazing on small farms',
                'Agro-industrial livestock farming and grazing',
            ],
            'group4' => [
                'Subsistence or artisanal aquaculture',
                'Over nutrient',
                'Industrial aquaculture',
            ],
            'group6' => [
                'Drilling (gas and oil)',
                'Mining or quarrying operations',
                'Renewable abiotic energy use',
            ],
            'group7' => [
                'Roads',
                'Utility and communication networks and lines (power, telephone, aqueduct, etc.)',
                'Maritime waterways and shipping lanes',
                'Commercial boating',
                'Private boating',
                'Air corridors',
                'Railways',
            ],
            'group8' => [
                'Hunting of land animals',
                'Harvesting of live animals',
                'Collecting small animals as insects or their products as honey',
            ],
            'group9' => [
                'Plant gathering',
                'Plant harvesting',
                'Harvesting food vegetal as tubers, fruits, etc.',
                'Harvesting plants for medicines',
                'Harvesting Stems - fibres (palms, kenaf, kapok, coco, etc.)',
            ],
            'group10' => [
                'Small-scale lumber operations',
                'Large-scale fuelwood operations',
                'Small-scale fuelwood operations',
                'Large-scale lumber operations',
                'Battens/poles for construction',
            ],
            'group11' => [
                'Subsistence or small-scale fishing',
                'Large-scale fishing',
                'Subsistence or small-scale harvesting of aquatic resources',
                'Large-scale harvesting of aquatic resources',
                'Shellfish harvesting',
                'Illegal taking/removal of marine fauna',
                'Overfishing and destructive fishing',
                'Endangered species exploitation',
                'Trawlers/purse-seiners',
                'Harvesting ornamental and aquarium resources (seeds, shells and fishes’ collection',
                'Harvesting alga',
            ],
            'group12' => [
                'Recreational activities',
                'Works and other activities',
                'Noise and other forms of pollution',
                'Outdoor sports, leisure and recreational activities',
                'Multiple human intrusions and disturbances',
                'Recreational fishing hook and line',
                'Recreational fishing spearfishing',
                'Bathing and trampling',
                'Scuba-diving',
                'Wars, civil unrest and military exercises',
            ],
            'group13' => [
                'Frequency and intensity of fires',
                'Human induced changes in hydraulic conditions',
                'Changes in abiotic conditions',
                'Changes in biotic conditions',
            ],
            'group14' => [
                'Surface water abstraction (domestic usage))',
                'Surface water abstraction (commercial usage)',
                'Surface water abstraction (agricultural usage)',
                'Surface water abstraction (usage unknown)',
                'Underground water abstraction (domestic usage)',
                'Underground water abstraction (commercial usage)',
                'Underground water abstraction (agricultural usage)',
                'Underground water abstraction (usage unknown)',
                'Small dams',
                'Large dams',
                'Dams (size unknown)',
                'Dams for energy',
            ],
            'group' => [
                'Harvesting sand from the beaches',
            ],
            'group16' => [
                'Invasive introduced species or diseases',
                'Problematic indigenous species or diseases',
                'Problematic species or diseases of unknown origin',
                'Introduced genetic material',
                'Viral or prion diseases',
                'Disease of unknown cause',
                'Biocenotic evolution',
                'Interspecific faunal relations',
                'Multiple ecosystem modifications',
            ],
            'group17' => [
                'Waste water and sewers',
                'Leaks',
                'Plastics',
            ],
            'group18' => [
                'Oil slick',
                'Ship discharges',
                'Mining leak',
            ],
            'group19' => [
                'Nutrient load',
                'Soil erosion and sedimentation',
                'Herbicides and pesticides',
                'Watershed-based pollution',
            ],
            'group20' => [
                'Municipal waste',
                'Litter from cars / Flotsam & jetsam from recreational boats',
                'Construction debris',
                'Waste that entangles wildlife',
            ],
            'group21' => [
                'Acid rain',
                'Pollution cloud',
                'Ozone',
            ],
            'group22' => [
                'Light pollution',
                'Heat pollution',
                'Noise pollution',
            ],
            'group23' => [
                'Volcanoes',
                'Earthquakes and tsunamis',
                'Avalanches and landslides',
                'Abiotic natural processes',
            ],
            'group24' => [
                'Damage and changes to habitat',
                'Droughts',
                'Extreme temperatures',
                'Storms and flooding',
                'Increased rainfall and seasonal changes',
                'Warming, acidification, bleaching, deoxygenation',
            ],
            'group25' => [
                'Human-Wildlife Conflict',
            ],
        ],
        'categories' => [
            'title1' => 'Commercial and residential',
            'title2' => 'Agriculture and aquaculture',
            'title3' => 'Energy and mining',
            'title4' => 'Transport and infrastructure',
            'title5' => 'Use of biological resources',
            'title6' => 'Human disturbance / intrusion',
            'title7' => 'Changes in the natural system',
            'title8' => 'Invasive / challenging species',
            'title9' => 'Pollution',
            'title10' => 'Geological phenomena',
            'title11' => 'Climate change and effects',
            'title12' => 'Other pressures and threats',
        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'Mild',
                '1' => 'Moderate',
                '2' => 'High',
                '3' => 'Severe',
            ],
            'Extension' => [
                '0' => 'Localised <5%',
                '1' => 'Sparse 5-15%',
                '2' => 'Widely dispersed 15-50%',
                '3' => 'Everywhere >50%',
            ],
            'Duration' => [
                '0' => 'Short term < 5 years',
                '1' => 'Medium term 5-20 years',
                '2' => 'Very long term 20-100 years',
                '3' => 'Permanent >100 years',
            ],
            'Trend' => [
                '-2' => 'Decreasing',
                '-1' => 'Slightly decreasing',
                '0' => 'No change',
                '1' => 'Slightly increasing',
                '2' => 'Increasing',
            ],
            'Probability' => [
                '0' => 'Very low',
                '1' => 'Low',
                '2' => 'Average',
                '3' => 'High',
            ],
        ],
        'module_info' => 'The threats calculator measures the impact of threats on a specific protected area. Using your best professional judgement, you evaluate the threat impact exploiting five categories of score: (1) Impact/ Severity; (2) Scale/ Extent; (3) Duration/ Irreversibility; (4) Trend; (5) Probability for the threat in the future',
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following
            evaluation modules (if already encoded): <br /> <i>C3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'ClimateChange' => [
        'title' => 'Climate change and conservation / Key elements affected by climate change',
        'fields' => [
            'Value' => 'Key element',
            'Description' => 'Description of climate change effects ',
            'Trend' => 'Effects of climate change',
            'Notes' => 'Notes',
        ],
        'groups' => [
            'group0' => 'Animal species affected by climate change',
            'group1' => 'Plant species affected by climate change',
            'group2' => 'Habitats affected by climate change',
            'group3' => 'Ecosystem services affected by climate change',
            'group4' => 'Values and importance affected by climate change',
            'group5' => 'Other',
        ],
        'module_info' => 'The outputs from the following section will support management decisions to ensure that the protected area adopts measures to minimise the effects of climate change. The analysis will ensure the incorporation of relevant values into the protected area management system',
        'ratingLegend' => [
            'Trend' => [
                '0' => 'Highly affected by climate change',
                '1' => 'Moderately affected by climate change',
                '2' => 'Little affected by climate change',
                '3' => 'Not affected by climate change',
            ],
        ],
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following
            evaluation modules (if already encoded): <br /> <i>C1.4</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

    'EcosystemServices' => [
        'title' => 'Ecosystem services, importance, community/society dependence and trend',
        'fields' => [
            'Element' => 'Ecosystem services',
            'Importance' => 'Importance',
            'ImportanceRegional' => 'Community/society dependence',
            'ImportanceGlobal' => 'Trend',
            'Observations' => 'Description / Condition',
        ],
        'groups' => [
            'group0' => 'Nutrition',
            'group1' => 'Materials',
            'group2' => 'Energy',
            'group3' => 'Remediation of waste materials, toxic substances and other pollution',
            'group4' => 'Remediation of flows',
            'group5' => 'Physical interactions and experience',
            'group6' => 'Intellectual interactions and performances',
            'group7' => 'Spiritual and/or emblematic',
            'group8' => 'Other cultural ecosystem services',
            'group9' => 'Supporting services',
        ],
        'predefined_values' => [
            'group0' => ['Water supply', 'Human food - vegetal (tubers, fruits, honey, mushrooms, seaweed, etc.)', 'Human food - animal (wild / farmed meat, insects)', 'Medicines and blue biotechnology (fish oil)', 'Fish / livestock feed (wild, farmed, bait)', 'Spillover benefits in neighboring fishing grounds'],
            'group1' => ['High value timber', 'Timber for local construction', 'Stems - fibres (palms, kenaf, etc.)', 'Other fibres (leaves, fruits...) (kapok, coco, etc.)', 'Ornamental and aquaria resources (seeds, shells and fishes collection)', 'Sand (building)', 'Algal/shells', 'Cultivation land (agriculture, livestock, forests)'],
            'group2' => ['Fuelwood and biofuels', 'Water for energy', 'Fertiliser'],
            'group3' => ['Gas regulation (C sequestration)', 'Waste burial / removal / neutralisation', 'Waste regulation (nutrient uptake)', 'Prevention of coastal erosion'],
            'group4' => ['Flood control', 'Drought control', 'Storm protection', 'Water erosion control', 'Wind erosion control', 'Prevention of coastal erosion'],
            'group5' => ['Aesthetic (ecosystem integrity) benefits', 'Ecotourism and nature watching', 'Walking, hiking and general recreation', 'Boating, swimming and diving', 'Snorkeling, boating and diving', 'Hunting or fishing if permitted', 'Specified traditional fishing'],
            'group6' => ['Science - Research', 'Educational', 'Cultural heritage'],
            'group7' => ['Symbolic or historic', 'Sacred or religious'],
            'group8' => ['ex situ conservation'],
            'group9' => ['Net primary production (vegetation)', 'Nutrient cycling (litter decomposition and mineralisation)', 'Important habitats (bird nesting sites - sea spawning grounds - nursery habitats)', 'Formation of seascape', 'Habitat former species (eg. corals)', 'Pollination (plants)', 'Water cycling', 'Seascape: habitat heterogeneity/complexity (supporting diversity)', 'Spillover benefits in biomass recovery, reproduction, connectivity', 'Connectivity (ecological linkages and functional continuity)'],
        ],
        'categories' => [
            'title1' => 'Provisioning',
            'title2' => 'Regulation',
            'title3' => 'Cultural',
            'title4' => 'Supporting',
        ],
        'module_info' => '<b>Ecosystem services – importance, dependence of communities/societies and trend of the ecosystem services provided by the protected area</b> <ul> <li>The outputs from the following section will support management decisions to ensure that ecosystem services delivered by the protected area for the human well-being are preserved. The analysis will ensure incorporation of the relevant values into the management system of the protected area</li> <li>Rating: Evaluate each assessment on the basis of: A) Importance of particular ecosystem services, B) the dependence of local population/society on the ecosystem service and C) trend in the quantity or quality of ecosystem services delivered by the protected area, using the scales below</li> <li>You do not need a precise measurement of the value to assign a rating</li> <li>The distinction between legal and illegal ecosystem services has been removed. Illegal uses of ecosystem resources are now systematically captured in the threats module.</li> </ul>',
        'ratingLegend' => [
            'Importance' => [
                'Local' => 'Importance limited to the local or regional communities (e.g. tuber, fruits, firewood, etc.)',
                'Larger' => 'Importance extended to the national and global societies (watershed, tourism, etc.)',
            ],
            'ImportanceRegional' => [
                '0' => 'very low',
                '1' => 'low',
                '2' => 'medium',
                '3' => 'high',
            ],
            'ImportanceGlobal' => [
                '-2' => 'decreasing',
                '-1' => 'slightly decreasing',
                '0' => 'no change',
                '1' => 'slightly increasing',
                '2' => 'increasing',
            ],
        ],
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following
            evaluation modules (if already encoded): <br /> <i>C1.5</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>',
    ],

];
