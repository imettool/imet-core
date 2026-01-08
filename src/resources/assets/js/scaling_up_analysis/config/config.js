/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

const getLabel = (key) => window.ModularForms.Helpers.Locale.getLabel(key);
const getScalingLabel = (key) => window.ScalingUp?.labels(key) ?? '';

const createColumn = (label, field, extraLabel = '') => ({label, field, extra_label: extraLabel});

const indicators = [
    'context', 'outcomes', 'outputs', 'process', 'inputs', 'planning'
].map((key) => {
    if (key === 'context') {
        return 'context'
    }

    return getLabel(`imet-core::common.steps_eval.${key}`)
});

export default {
    indicators,
    color: [
        '#00B050',
        '#92D050',
        '#0099CC',
        '#ffc000',
        '#bfbfbf',
        '#ffff00'
    ],
    color_correct_order: [
        '#ffff00',
        '#bfbfbf',
        '#ffc000',
        '#0099CC',
        '#92D050',
        '#00B050'
    ],
    element_diagrams: {
        color: [{'context': '#ffff00'},
            {'planning': '#bfbfbf'},
            {'inputs': '#ffc000'},
            {'process': '#0099CC'},
            {'outputs': '#92D050'},
            {'outcomes': '#00B050'}],
        context: [
            {
                key: 'overall_scores',
                name: 'main',
                menu: {
                    header: getLabel('imet-core::analysis_report.element_diagrams.context.main.header'),
                    title: getLabel('imet-core::analysis_report.element_diagrams.context.main.title'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.context.main.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.context.main.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.context.main.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.context.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                    createColumn(`C1: ${getScalingLabel('C1') ?? ''}`, "C1"),
                    createColumn(`C2: ${getScalingLabel('C2') ?? ''}`, "C2", ` ${getLabel('imet-core::analysis_report.scale.negative_positive')}`),
                    createColumn(`C3: ${getScalingLabel('C3')}`, "C3", ` ${getLabel('imet-core::analysis_report.scale.zero_negative')}`),
                    createColumn(`${getLabel('imet-core::common.steps_eval.context')}`, "context", ` `),
                ]
            },
            {
                key: 'context_value_and_importance',
                name: 'context_value_and_importance',
                menu: {
                    title: getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.title'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.datatable'),
                },
                ranking_labels: false,
                columns: [
                    createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                    createColumn(`C1.1: ${getScalingLabel('C11') ?? ''}`, "C11"),
                    createColumn(`C1.2: ${getScalingLabel('C12')}`, "C12"),
                    createColumn(`C1.3: ${getScalingLabel('C13')}`, "C13"),
                    createColumn(`C1.4: ${getScalingLabel('C14')}`, "C14"),
                    createColumn(`C1.5: ${getScalingLabel('C15')}`, "C15"),
                    createColumn(`${getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.datatable_average')}`, "avg")
                ]
            },
        ],
        threats:
            {
                name: 'threats',
                ranking_labels: false,
                menu: {
                    title: getLabel('imet-core::analysis_report.element_diagrams.threats.threats.title'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.threats.threats.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.threats.threats.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.threats.threats.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.threats.threats.datatable'),
                }
            },
        planning: [
            {
                name: 'main',
                menu: {
                    header: getLabel('imet-core::analysis_report.element_diagrams.planning.main.header'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.planning.main.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.planning.main.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.planning.main.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.planning.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                    createColumn(`P1: ${getScalingLabel('P1')}`, "P1"),
                    createColumn(`P2: ${getScalingLabel('P2')}`, "P2"),
                    createColumn(`P3: ${getScalingLabel('P3')}`, "P3"),
                    createColumn(`P4: ${getScalingLabel('P4')}`, "P4"),
                    createColumn(`P.5: ${getScalingLabel('P5')}`, "P5"),
                    createColumn(`P6: ${getScalingLabel('P6')}`, "P6"),
                    createColumn(getLabel('imet-core::common.steps_eval.planning'), "planning", "")
                ]

            }
        ],
        inputs: [
            {
                name: 'main',
                menu: {
                    header: getLabel('imet-core::analysis_report.element_diagrams.inputs.main.header'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.inputs.main.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.inputs.main.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.inputs.main.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.inputs.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                    createColumn(`I1: ${getScalingLabel('I1')}`, "I1"),
                    createColumn(`I2: ${getScalingLabel('I2')}`, "I2"),
                    createColumn(`I3: ${getScalingLabel('I3')}`, "I3"),
                    createColumn(`I4: ${getScalingLabel('I4')}`, "I4"),
                    createColumn(`I5: ${getScalingLabel('I5')}`, "I5"),
                    createColumn(`${getLabel('imet-core::common.steps_eval.inputs')}`, "inputs", ``)
                ]

            }
        ],
        process: [
            {
                name: 'process_sub_indicators',
                menu: {
                    header: getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.header'),
                    title: getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.title'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.datatable'),
                },
                ranking_labels: false,
                columns: [
                    createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                    createColumn(`PR A: ${getScalingLabel('PRA')}`, "PRA"),
                    createColumn(`PR B: ${getScalingLabel('PRB')}`, "PRB"),
                    createColumn(`PR C: ${getScalingLabel('PRC')}`, "PRC"),
                    createColumn(`PR D: ${getScalingLabel('PRD')}`, "PRD"),
                    createColumn(`PR E: ${getScalingLabel('PRE')}`, "PRE"),
                    createColumn(`PR F: ${getScalingLabel('PRF')}`, "PRF"),
                    createColumn(`${getLabel('imet-core::common.steps_eval.process')}`, "process")
                ]
            }],
        process_PRA: [{
            name: 'process_internal_management',
            menu: {
                title: getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.title'),
                radar: getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.radar'),
                ranking: getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.ranking'),
                average_contribution: getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.average_contribution'),
                datatable: getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.datatable'),
            },
            columns: [
                createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                createColumn(`PR1: ${getScalingLabel('PR1')}`, "PR1"),
                createColumn(`PR2: ${getScalingLabel('PR2')}`, "PR2"),
                createColumn(`PR3: ${getScalingLabel('PR3')}`, "PR3"),
                createColumn(`PR4: ${getScalingLabel('PR4')}`, "PR4"),
                createColumn(`PR5: ${getScalingLabel('PR5')}`, "PR5"),
                createColumn(`PR6: ${getScalingLabel('PR6')}`, "PR6"),
                createColumn(`${getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.datatable_average')}`, "avg")
            ]

        }],
        process_PRB: [{
            name: 'process_management_protection_values',
            menu: {
                title: getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.title'),
                radar: getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.radar'),
                ranking: getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.ranking'),
                average_contribution: getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.average_contribution'),
                datatable: getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.datatable'),
            },
            columns: [
                createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                createColumn(`PR7: ${getScalingLabel('PR7')}`, "PR7"),
                createColumn(`PR8: ${getScalingLabel('PR8')}`, "PR8"),
                createColumn(`PR9: ${getScalingLabel('PR9')}`, "PR9"),
                createColumn(`${getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.datatable_average')}`, "avg")
            ]

        }],
        process_PRC: [{
            name: 'process_stakeholders_relationships',
            menu: {
                title: getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.title'),
                radar: getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.radar'),
                ranking: getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.ranking'),
                average_contribution: getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.average_contribution'),
                datatable: getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.datatable'),
            },
            columns: [
                createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                createColumn(`PR10: ${getScalingLabel('PR10')}`, "PR10"),
                createColumn(`PR11: ${getScalingLabel('PR11')}`, "PR11"),
                createColumn(`PR12: ${getScalingLabel('PR12')}`, "PR12"),
                createColumn(`${getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.datatable_average')}`, "avg")
            ]
        }],
        process_PRD: [{
            name: 'process_tourism_management',
            menu: {
                title: getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.title'),
                radar: ``,
                ranking: getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.ranking'),
                average_contribution: getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.average_contribution'),
                datatable: getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.datatable'),
            },
            columns: [
                createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                createColumn(`PR13: ${getScalingLabel('PR13')}`, "PR13"),
                createColumn(`PR14: ${getScalingLabel('PR14')}`, "PR14"),
                createColumn(`${getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.datatable_average')}`, "avg")
            ]
        }],
        process_PRE: [{
            name: 'process_monitoring_and_research',
            menu: {
                title: getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.title'),
                radar: '',
                ranking: getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.ranking'),
                average_contribution: getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.average_contribution'),
                datatable: getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.datatable'),
            },
            columns: [
                createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                createColumn(`PR15: ${getScalingLabel('PR15')}`, "PR15"),
                createColumn(`PR16: ${getScalingLabel('PR16')}`, "PR16"),
                createColumn(`${getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.datatable_average')}`, "avg")
            ]
        }],
        process_PRF: [{
            name: 'process_effects_of_climate_change',
            menu: {
                title: getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.title'),
                radar: '',
                ranking: getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.ranking'),
                average_contribution: getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.average_contribution'),
                datatable: getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.datatable'),
            },
            columns: [
                createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                createColumn(`PR17: ${getScalingLabel('PR17')}`, "PR17"),
                createColumn(`PR18: ${getScalingLabel('PR18')}`, "PR18"),
                createColumn(getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.datatable_average'), "avg")
            ]
        }
        ],
        outputs: [
            {
                name: 'main',
                menu: {
                    header: getLabel('imet-core::analysis_report.element_diagrams.outputs.main.header'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.outputs.main.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.outputs.main.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.outputs.main.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.outputs.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                    createColumn(`O/P1: ${getScalingLabel('OP1')}`, "OP1"),
                    createColumn(`O/P2: ${getScalingLabel('OP2')}`, "OP2"),
                    createColumn(`O/P3: ${getScalingLabel('OP3')}`, "OP3"),
                    createColumn(`O/P4: ${getScalingLabel('OP4')}`, "OP4"),
                    createColumn(`${getLabel('imet-core::common.steps_eval.outputs')}`, "outputs", ``)
                ]

            }
        ],
        outcomes: [
            {
                name: 'main',
                menu: {
                    header: getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.header'),
                    radar: getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.radar'),
                    ranking: getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.ranking'),
                    average_contribution: getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.average_contribution'),
                    datatable: getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.datatable'),

                },
                ranking_labels: false,
                columns: [
                    createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
                    createColumn(`O/C1: ${getScalingLabel('OC1')}`, "OC1"),
                    createColumn(`O/C2: ${getScalingLabel('OC2')}`, "OC2", ` ${getLabel('imet-core::analysis_report.scale.negative_positive')}`),
                    createColumn(`O/C3: ${getScalingLabel('OC3')}`, "OC3", ` ${getLabel('imet-core::analysis_report.scale.negative_positive')}`),
                    createColumn(`${getLabel('imet-core::common.steps_eval.outcomes')}`, "outcomes", ``)
                ]

            }
        ],
    },
    performance_diagram: {
        indicators,
        color: ['#ffff00', '#bfbfbf', '#ffc000', '#0099CC', '#92D050', '#00B050'],
        columns: [
            createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), 'name'),
            ...indicators.map(label => createColumn(label, label.toLowerCase())),
            createColumn(getLabel('imet-core::common.indexes.imet'), 'imet_index')
        ]
    },
    evaluation_of_protected_area_management_cycle: {
        columns: [
            createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), 'name'),
            ...indicators.map(label => createColumn(label, label.toLowerCase())),
            createColumn(getLabel('imet-core::common.indexes.imet'), 'imet_index')
        ]
    },
    relative_performance_effectiveness_bar_average: {
        indicators,
        color: [
            '#00B050',
            '#92D050',
            '#0099CC',
            '#ffc000',
            '#bfbfbf',
            '#ffff00',
            '#ffff00'
        ]
    },
    group_analysis_on_demand: {
        scatter_columns: [
            createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
            createColumn(getLabel('imet-core::common.steps_eval.process'), "context"),
            createColumn(`${getLabel('imet-core::common.steps_eval.context')}, ${getLabel('imet-core::common.steps_eval.planning')}, ${getLabel('imet-core::common.steps_eval.inputs')}`, "planning"),
            createColumn(`${getLabel('imet-core::common.steps_eval.outputs')}, ${getLabel('imet-core::common.steps_eval.outcomes')}`, "inputs"),
        ],
        columns: [
            createColumn(getLabel('imet-core::common.Create.fields.wdpa_id'), "name"),
            ...indicators.map(label => createColumn(label, label.toLowerCase())),
        ]
    },
    protected_area: {
        columns: [
            {
                "label": getLabel('imet-core::analysis_report.protected_area.name'),
                "field": "name"
            },
            {
                "label": getLabel('imet-core::analysis_report.protected_area.gis_area'),
                "field": "gis_area"
            },
            {
                "label": getLabel('imet-core::analysis_report.protected_area.nature'),
                "field": "nature",
                type: 'bg-color'
            }
        ]
    },
    map: {
        fields: [
            {
                label: '%',
                children: [
                    {
                        label: getLabel('imet-core::analysis_report.map.fields.area_prot_terr_perc'),
                        field: 'area_prot_terr_perc',
                        color: '#91cc75'
                    },
                    {
                        label: getLabel('imet-core::analysis_report.map.fields.protconn'),
                        field: 'protconn',
                        color: '#3ba272'
                    }
                ]
            }
        ],
    }
};
