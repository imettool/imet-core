
/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

class LocaleStorage {
    constructor() {

    }

    save(key, value) {
        const values = window.localStorage.getItem(key);
        if (values) {
            const json_recorded = JSON.parse(values);
            json_recorded.push(value)
            window.localStorage.setItem(key, JSON.stringify(json_recorded));
        } else {
            window.localStorage.setItem(key, JSON.stringify([value]));
        }
    }

    retrieve(key){
        return JSON.parse(window.localStorage.getItem(key));
    }

    delete_item_child(key, id){
        const children = JSON.parse(window.localStorage.getItem(key));
        const not_deleted_items = children.filter((child, key) => key !== id);
        window.localStorage.setItem(key, JSON.stringify(not_deleted_items));
        return this.retrieve(key);
    }

    delete(key){
        window.localStorage.removeItem(key);
    }

    clear(){
        window.localStorage.clear();
    }

}

export default  new LocaleStorage();