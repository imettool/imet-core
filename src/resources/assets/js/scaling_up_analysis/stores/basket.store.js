/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import storage from "./db.store";

export default class BasketStore {
    constructor(args) {
        this.scaling_up_id = args.scaling_up_id;
        this.init();
    }

    init() {

    }

    async save(values) {
        values.scaling_up_id = this.scaling_up_id;
        return await storage.save(values);
    }

    // delete_item(id){
    //     return storage.delete_item_child(id);
    // }

    delete(id){
        return storage.delete(id);
    }

    retrieve(id) {
        return storage.retrieve(id);
    }

    retrieve_all() {
        return storage.all(this.scaling_up_id);
    }

    clear() {
       return storage.clear(this.scaling_up_id);
    }

    get_scaling_up_id() {
        return this.scaling_up_id;
    }

    get_local_storage_images_key() {
        return `basket`;
    }

};

