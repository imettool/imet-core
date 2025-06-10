<!--
  - Copyright (C) 2025 European Union
  - This program is free software: you can redistribute it and/or modify it under the terms of the
  - EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
  - This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
  - warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
  - further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
  - If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
  -->

<template>
    <div id="general-elements">
        <table class="max-w-12xl m-auto">
            <tbody>
                <tr>
                    <td>
                        <div class="strong text-left">{{
                            stores.BaseStore.localization('imet-core::analysis_report.general_info.country')
                            }}:
                        </div>
                    </td>
                    <td>
                        <div class="text-left">
                            {{ info.countries }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="strong text-left">{{
                            stores.BaseStore.localization('imet-core::analysis_report.general_info.network')
                            }}:
                        </div>
                    </td>
                    <td>
                        <div class="text-left">
                            {{ info.network }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="strong text-left">{{
                            stores.BaseStore.localization('imet-core::analysis_report.general_info.total_surface_protected')
                            }}:
                        </div>
                    </td>
                    <td>
                        <div class="text-left">
                            {{ info.total_surface_protected_areas }} [km2]
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="strong text-left">{{
                            stores.BaseStore.localization('imet-core::analysis_report.general_info.ecoregions')
                            }}:
                        </div>
                    </td>
                    <td>
                        <div class="text-left">
                            {{ info.eco_regions }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="strong text-left">{{
                            stores.BaseStore.localization('imet-core::analysis_report.general_info.vision')
                            }}:
                        </div>
                    </td>
                    <td>
                        <div class="text-left">
                            {{ info.local_vision }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="strong text-left">{{
                            stores.BaseStore.localization('imet-core::analysis_report.general_info.mission')
                            }}:
                        </div>
                    </td>
                    <td>
                        <div class="text-left">
                            {{ info.local_mission }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="strong text-left">{{
                            stores.BaseStore.localization('imet-core::analysis_report.general_info.objectives')
                            }}:
                        </div>
                    </td>
                    <td>
                        <div class="text-left">
                            {{ info.local_objective }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, inject } from 'vue';

const stores = inject('stores');

const props = defineProps({
    values: {
        type: [Array, Object],
        default: () => { }
    }
});

const info = reactive({
    countries: null,
    network: null,
    categories: null,
    total_surface_protected_areas: null,
    total_surface_area_of_landscape_protected_areas: null,
    agencies: null,
    eco_regions: null,
    local_vision: null,
    local_mission: null,
    local_objective: null,
    landscapes: null,
    values_network: null
});

function init(response) {
    Object.entries(info).forEach(object => {
        if (Array.isArray(response.general_info?.[object[0]])) {
            info[object[0]] = response.general_info?.[object[0]]?.filter(i => i).join(', ');
        } else {
            info[object[0]] = response.general_info?.[object[0]];
        }
    });
}

onMounted(() => {
    init(props.values);
});
</script>
