/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import { ref } from 'vue';

export function useErrorStates() {
    const show_loader = ref(false);
    const timeout = ref(false);
    const error_returned = ref(false);
    const error_wrong = ref(false);

   function resetErrors() {
        timeout.value = false;
        error_returned.value = false;
        error_wrong.value = false;
    }

    function setLoading(isLoading) {
        show_loader.value = isLoading;
    }

    function handleError(response) {
        show_loader.value = false;

        if (!response.response) {
            error_wrong.value = true;
        } else if (response.status === false) {
            timeout.value = true;
        } else if (response.code === 'ECONNABORTED') {
            timeout.value = true;
        } else {
            error_returned.value = true;
        }
    }

    function hasError() {
        return timeout.value || error_returned.value || error_wrong.value;
    }

    return {
        show_loader,
        timeout,
        error_returned,
        error_wrong,
        resetErrors,
        setLoading,
        handleError,
        hasError
    };
}

