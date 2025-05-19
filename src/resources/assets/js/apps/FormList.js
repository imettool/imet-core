/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import FormList from "@modular-forms/js/apps/FormList.js";

import imet_encoders_responsibles from "../templates/imet_encoders_responsibles.vue";
import imet_radar from "../templates/imet_radar.vue";

export default class FormListImet extends FormList {

    constructor(options, input_data) {

        return super(options, input_data)

            // Register components
            .component('imet_encoders_responsibles', imet_encoders_responsibles)
            .component('imet_radar', imet_radar)

        ;
    }

}
