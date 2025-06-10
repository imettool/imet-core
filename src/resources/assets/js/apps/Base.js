/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import Base from "@modular-forms/js/apps/Base.js";

import imetScoreBar from "../templates/imet_score_bar.vue";
import imetRadar from "../templates/imet_radar.vue";
import multipleFilesUpload from "../inputs/multiple-files-upload.vue";
import scopeIcon from "../templates/scope_icon.vue";

export default class BaseImet extends Base {

    constructor(options, input_data) {

        return super(options, input_data)

            // Register components
            .component('imet_score_bar', imetScoreBar)
            .component('imet_radar', imetRadar)
            .component('multiple-files-upload', multipleFilesUpload)
            .component('scope-icon', scopeIcon);

    }

}
