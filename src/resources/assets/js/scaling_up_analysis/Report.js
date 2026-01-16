/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import {createApp, ref, provide} from "vue";
import generalInfo from './components/sections/general-info.vue';
import managementContext from './components/management-context/management-context.vue';
import imetBarChart from '../templates/imet_bar_chart.vue';
import grouping from './components/forms/grouping.vue';
import textEditor from './components/editors/text-editor.vue';
import mapView from './components/maps/map-view.vue';
import previewTemplate from './components/layouts/preview-template.vue';
import previewItem from './components/basket/preview-item.vue';
import container from './components/containers/container.vue';
import containerView from './components/containers/container-view.vue';
import containerAnalysisManagementCycle from './components/containers/container-analysis-management-cycle.vue';
import containerSection from './components/containers/container-section.vue';
import containerUpperLowerRadars from './components/containers/container-upper-lower-radars.vue';
import containerActions from './components/containers/container-actions.vue';
import datatableInteractWithRadar from './components/datatables/datatable-interact-with-radar.vue';
import datatableInteractWithScatter from './components/datatables/datatable-interact-with-scatter.vue';
import datatableScaling from './components/datatables/datatable-scaling.vue';
import barReverse from './components/bar-charts/bar-reverse.vue';
import barCategoryStack from './components/bar-charts/bar-category-stack.vue';
import imetBarError from './components/bar-charts/imet-bar-error.vue';
import scalingRadar from './components/various-charts/scaling-radar.vue';

import scatter from './components/various-charts/scatter.vue';
import radarThreats from './components/various-charts/radar-threats.vue';
import colorPicker from './tools/color-picker.vue';
import basket from './components/basket/basket.vue';
import guidance from './components/sections/guidance.vue';
import smallMenu from './components/menus/small-menu.vue';
import tooltip from '@modular-forms/js/templates/tooltip.vue';
import checkboxesList from './components/forms/checkboxes-list.vue';
import HtmlToImage from './tools/html-to-image.vue'
import DropDragArea from './components/drag-and-drop/drop-drag-area.vue'
import DraggableItem from './components/drag-and-drop/draggable-item.vue'
import application from './components/app.vue';


import mitt from "~/mitt";

export default class Report {

    constructor(input_data = {}) {

        const options = {
            name: 'Report',
            setup() {
                const emitter = mitt();
                provide('emitter', emitter);

                function goTo(event) {
                    let element = event.target.value;
                    if(element === '#'){
                        return;
                    }
                    if (['process', 'process_PRA', 'process_PRB', 'process_PRC', 'process_PRD', 'process_PRE', 'process_PRF'].includes(element)) {
                        let event_element = 'analysis_per_element_of_them_management_cycle';
                        emitter.emit(event_element);
                        setTimeout(() => {
                            emitter.emit('sub_elem_4');
                        }, 500);
                        setTimeout(() => {
                            window.ModularForms.Helpers.Animation.scrollPageToAnchor(element);
                        }, 800);
                    } else {
                        emitter.emit(element);
                        setTimeout(() => {
                            window.ModularForms.Helpers.Animation.scrollPageToAnchor(element);
                        }, 500);
                    }

                }
                return {
                    goTo,
                    url:input_data.url
                }
            }

        }

        const app = createApp(
            options || {},
            input_data || {}
        );

        app.component('app',    application);
        // Register components
        app.component('general-info', generalInfo);
        app.component('management-context', managementContext);
        app.component('grouping', grouping);
        app.component('map-view',    mapView);
        app.component('preview-template',    previewTemplate);
        app.component('container', container);

        app.component('container-view', containerView);
        app.component('container-analysis-management-cycle', containerAnalysisManagementCycle);
        app.component('container-section',    containerSection);
        app.component('container-upper-lower-radars', containerUpperLowerRadars);
        app.component('container-actions', containerActions);
        app.component('datatable-interact-with-radar', datatableInteractWithRadar);
        app.component('datatable-interact-with-scatter', datatableInteractWithScatter);
        app.component('datatable-scaling', datatableScaling);
        app.component('bar-reverse', barReverse);
        app.component('bar-category-stack', barCategoryStack);
        app.component('imet-bar-error',    imetBarError);
        app.component('scaling-radar', scalingRadar);
        app.component('scatter',    scatter);
        app.component('radar-threats', radarThreats);
        app.component('color-picker', colorPicker);
        app.component('basket', basket);
        app.component('guidance',    guidance);
        app.component('small-menu',    smallMenu);
        app.component('checkboxes-list', checkboxesList);
        app.component('tooltip', tooltip);
        app.component('imet_bar_chart', imetBarChart);
        app.component('text-editor', textEditor);
        app.component('preview-item', previewItem);
        app.component('html-to-image', HtmlToImage);
        app.component('drop-drag-area', DropDragArea);
        app.component('draggable-item', DraggableItem);

        return app;
    }
}
