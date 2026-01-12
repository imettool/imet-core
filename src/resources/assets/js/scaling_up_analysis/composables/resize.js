/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import { onBeforeUnmount } from 'vue';

export function useResize(component_data) {
    const emitter = component_data.emitter;

    function handleResize(echartObject) {
        echartObject.resize();
    }

    function initResize(echartObject) {
        save_data(echartObject);
        const resize_event = () => handleResize(echartObject);
        window.addEventListener('resize', resize_event)
    }

    function save_data(charContainer) {
        if (charContainer) {
            emitter.on('save_data',(value) => {
                const {comments, image_src, attr, func} = value;
                if (charContainer) {
                    const value = charContainer.getDataURL({
                        pixelRatio: 2,
                        backgroundColor: '#fff'
                    });

                    func(value, attr)
                }
            });
        }
    }

    onBeforeUnmount(() => {
        window.removeEventListener('resize', handleResize);
    });

    return { initResize, save_data, handleResize };
}
