/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

export default {
    indicators: [
        window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context'),
        window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
        window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs'),
        window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
        window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs'),
        window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning')
    ],
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
                    header: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.header'),
                    title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.title'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `C1: ${window.ScalingUp?.labels('C1') ?? ''}`,
                        "field": "C1"
                    },
                    {
                        "label": `C2: ${window?.ScalingUp?.labels('C2') ?? ''}`,
                        "field": "C2",
                        "extra_label": ` ${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.scale.negative_positive')}`
                    },
                    {
                        "label": `C3: ${window?.ScalingUp?.labels('C3')}`,
                        "field": "C3",
                        "extra_label": ` ${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.scale.zero_negative')}`
                    },
                    {
                        "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context')}`,
                        "field": "context",
                        "extra_label": ``
                    }
                ]
            },
            {
                key: 'context_value_and_importance',
                name: 'context_value_and_importance',
                menu: {
                    title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.title'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `C1.1: ${window.ScalingUp?.labels('C11') ?? ''}`,
                        "field": "C11"
                    },
                    {
                        "label": `C1.2: ${window.ScalingUp?.labels('C12')}`,
                        "field": "C12",
                    },
                    {
                        "label": `C1.3: ${window.ScalingUp?.labels('C13')}`,
                        "field": "C13"
                    },
                    {
                        "label": `C1.4: ${window.ScalingUp?.labels('C14')}`,
                        "field": "C14"
                    },
                    {
                        "label": `C1.5: ${window.ScalingUp?.labels('C15')}`,
                        "field": "C15"
                    },
                    {
                        "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.datatable_average')}`,
                        "field": "avg"
                    }
                ]
            },
        ],
        threats:
            {
                name: 'threats',
                ranking_labels: false,
                menu: {
                    title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.title'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.datatable'),
                }
            },
        planning: [
            {
                name: 'main',
                menu: {
                    header: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.header'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `P1: ${window.ScalingUp?.labels('P1')}`,
                        "field": "P1"
                    },
                    {
                        "label": `P2: ${window.ScalingUp?.labels('P2')}`,
                        "field": "P2",
                    },
                    {
                        "label": `P3: ${window.ScalingUp?.labels('P3')}`,
                        "field": "P3"
                    },
                    {
                        "label": `P4: ${window.ScalingUp?.labels('P4')}`,
                        "field": "P4"
                    },
                    {
                        "label": `P.5: ${window.ScalingUp?.labels('P5')}`,
                        "field": "P5"
                    },
                    {
                        "label": `P6: ${window.ScalingUp?.labels('P6')}`,
                        "field": "P6"
                    },
                    {
                        "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning')}`,
                        "field": "planning",
                        "extra_label": ``
                    }
                ]

            }
        ],
        inputs: [
            {
                name: 'main',
                menu: {
                    header: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.header'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `I1: ${window.ScalingUp?.labels('I1')}`,
                        "field": "I1"
                    },
                    {
                        "label": `I2: ${window.ScalingUp?.labels('I2')}`,
                        "field": "I2",
                    },
                    {
                        "label": `I3: ${window.ScalingUp?.labels('I3')}`,
                        "field": "I3"
                    },
                    {
                        "label": `I4: ${window.ScalingUp?.labels('I4')}`,
                        "field": "I4"
                    },
                    {
                        "label": `I5: ${window.ScalingUp?.labels('I5')}`,
                        "field": "I5"
                    },
                    {
                        "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs')}`,
                        "field": "inputs",
                        "extra_label": ``
                    }
                ]

            }
        ],
        process: [
            {
                name: 'process_sub_indicators',
                menu: {
                    header: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.header'),
                    title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.title'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `PR A: ${window.ScalingUp?.labels('PRA')}`,
                        "field": "PRA"
                    },
                    {
                        "label": `PR B: ${window.ScalingUp?.labels('PRB')}`,
                        "field": "PRB",
                    },
                    {
                        "label": `PR C: ${window.ScalingUp?.labels('RC')}`,
                        "field": "PRC"
                    },
                    {
                        "label": `PR D: ${window.ScalingUp?.labels('PRD')}`,
                        "field": "PRD"
                    },
                    {
                        "label": `PR E: ${window.ScalingUp?.labels('PRE')}`,
                        "field": "PRE"
                    },
                    {
                        "label": `PR F: ${window.ScalingUp?.labels('PRF')}`,
                        "field": "PRF"
                    },
                    {
                        "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process')}`,
                        "field": "process"
                    }
                ]
            }],
        process_PRA: [{
            name: 'process_internal_management',
            menu: {
                title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.title'),
                radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.radar'),
                ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.ranking'),
                average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.average_contribution'),
                datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.datatable'),
            },
            columns: [
                {
                    "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR1: ${window.ScalingUp?.labels('PR1')}`,
                    "field": "PR1"
                },
                {
                    "label": `PR2: ${window.ScalingUp?.labels('PR2')}`,
                    "field": "PR2",
                },
                {
                    "label": `PR3: ${window.ScalingUp?.labels('PR3')}`,
                    "field": "PR3"
                },
                {
                    "label": `PR4: ${window.ScalingUp?.labels('PR4')}`,
                    "field": "PR4"
                },
                {
                    "label": `PR5: ${window.ScalingUp?.labels('PR5')}`,
                    "field": "PR5",
                },
                {
                    "label": `PR6: ${window.ScalingUp?.labels('PR6')}`,
                    "field": "PR6"
                },
                {
                    "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.datatable_average')}`,
                    "field": "avg"
                }
            ]

        }],
        process_PRB: [{
            name: 'process_management_protection_values',
            menu: {
                title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.title'),
                radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.radar'),
                ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.ranking'),
                average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.average_contribution'),
                datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.datatable'),
            },
            columns: [
                {
                    "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR7: ${window.ScalingUp?.labels('PR7')}`,
                    "field": "PR7"
                },
                {
                    "label": `PR8: ${window.ScalingUp?.labels('PR8')}`,
                    "field": "PR8",
                },
                {
                    "label": `PR9: ${window.ScalingUp?.labels('PR9')}`,
                    "field": "PR9"
                },
                {
                    "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.datatable_average')}`,
                    "field": "avg"
                }
            ]

        }],
        process_PRC: [{
            name: 'process_stakeholders_relationships',
            menu: {
                title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.title'),
                radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.radar'),
                ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.ranking'),
                average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.average_contribution'),
                datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.datatable'),
            },
            columns: [
                {
                    "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR10: ${window.ScalingUp?.labels('PR10')}`,
                    "field": "PR10"
                },
                {
                    "label": `PR11: ${window.ScalingUp?.labels('PR11')}`,
                    "field": "PR11",
                },
                {
                    "label": `PR12: ${window.ScalingUp?.labels('PR12')}`,
                    "field": "PR12"
                },
                {
                    "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }],
        process_PRD: [{
            name: 'process_tourism_management',
            menu: {
                title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.title'),
                radar: ``,
                ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.ranking'),
                average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.average_contribution'),
                datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.datatable'),
            },
            columns: [
                {
                    "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR13: ${window.ScalingUp?.labels('PR13')}`,
                    "field": "PR13"
                },
                {
                    "label": `PR14: ${window.ScalingUp?.labels('PR14')}`,
                    "field": "PR14"
                },
                {
                    "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }],
        process_PRE: [{
            name: 'process_monitoring_and_research',
            menu: {
                title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.title'),
                radar: '',
                ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.ranking'),
                average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.average_contribution'),
                datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.datatable'),
            },
            columns: [
                {
                    "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR15: ${window.ScalingUp?.labels('PR15')}`,
                    "field": "PR15"
                },
                {
                    "label": `PR16: ${window.ScalingUp?.labels('PR16')}`,
                    "field": "PR16"
                },
                {
                    "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }],
        process_PRF: [{
            name: 'process_effects_of_climate_change',
            menu: {
                title: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.title'),
                radar: '',
                ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.ranking'),
                average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.average_contribution'),
                datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.datatable'),
            },
            columns: [
                {
                    "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR17: ${window.ScalingUp?.labels('PR17')}`,
                    "field": "PR17"
                },
                {
                    "label": `PR18: ${window.ScalingUp?.labels('PR18')}`,
                    "field": "PR18"
                },
                {
                    "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }
        ],
        outputs: [
            {
                name: 'main',
                menu: {
                    header: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.header'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `O/P1: ${window.ScalingUp?.labels('OP1')}`,
                        "field": "OP1"
                    },
                    {
                        "label": `O/P2: ${window.ScalingUp?.labels('OP2')}`,
                        "field": "OP2",
                    },
                    {
                        "label": `O/P3: ${window.ScalingUp?.labels('OP3')}`,
                        "field": "OP3"
                    },
                    {
                        "label": `O/P4: ${window.ScalingUp?.labels('OP4')}`,
                        "field": "OP4"
                    },
                    {
                        "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs')}`,
                        "field": "outputs",
                        "extra_label": ``
                    }
                ]

            }
        ],
        outcomes: [
            {
                name: 'main',
                menu: {
                    header: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.header'),
                    radar: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.radar'),
                    ranking: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.ranking'),
                    average_contribution: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.average_contribution'),
                    datatable: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.datatable'),

                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `O/C1: ${window.ScalingUp?.labels('OC1')}`,
                        "field": "OC1"
                    },
                    {
                        "label": `O/C2: ${window.ScalingUp?.labels('OC2')}`,
                        "field": "OC2",
                        "extra_label": ` ${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.scale.negative_positive')}`
                    },
                    {
                        "label": `O/C3: ${window.ScalingUp?.labels('OC3')}`,
                        "field": "OC3",
                        "extra_label": ` ${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.scale.negative_positive')}`
                    },
                    {
                        "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes')}`,
                        "field": "outcomes",
                        "extra_label": ``
                    }
                ]

            }
        ],
    },
    performance_diagram: {
        indicators: [
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning')

        ],
        color: [
            '#ffff00',
            '#bfbfbf',
            '#ffc000',
            '#0099CC',
            '#92D050',
            '#00B050'
        ],

        columns: [
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
                "field": "outcomes"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.indexes.imet'),
                "field": "imet_index"
            }
        ]
    },
    evaluation_of_protected_area_management_cycle: {
        columns: [
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
                "field": "outcomes"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.indexes.imet'),
                "field": "imet_index"
            }
        ]
    },
    relative_performance_effectiveness_bar_average: {
        indicators: [
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning'),
            window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context'),
        ],
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
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "context"
            },
            {
                "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context')}, ${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning')}, ${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs')}`,
                "field": "planning",

            },
            {
                "label": `${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs')}, ${window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes')}`,
                "field": "inputs"
            },
        ],
        columns: [
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
                "field": "outcomes"
            }
        ]
    },
    protected_area: {
        columns: [
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.protected_area.name'),
                "field": "name"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.protected_area.gis_area'),
                "field": "gis_area"
            },
            {
                "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.protected_area.nature'),
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
                        label: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.map.fields.area_prot_terr_perc'),
                        field: 'area_prot_terr_perc',
                        color: '#91cc75'
                    },
                    {
                        label: window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.map.fields.protconn'),
                        field: 'protconn',
                        color: '#3ba272'
                    }
                ]
            }
        ],
    }
};
