/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import { defineStore } from "~/pinia";

export const useScoreStore = defineStore('score', {

    state: () => ({
        api: {}
    }),

    getters: {
        api_data: (state) => state.api,
    },

    actions: {

        init(api){
            this.api = api;
        },

        refresh(){
            let _this = this;

            // prepare the url
            let url = this.api.version === 'oecm'
                ? window.Routes.scores_oecm
                : window.Routes.scores;
            url = url.replace('__id__', this.api.form_id)

            // fetch the data
            fetch(url, {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": window.Laravel.csrfToken,
                }
            })
                .then((response) => response.json())
                .then(function(data){
                    _this.api = data;
                });

        }
    },
})