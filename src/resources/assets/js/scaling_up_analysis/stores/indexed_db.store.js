/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import LocalStorage from "./local.storage.store";

class BasketStore {
    constructor() {
        this.db = null;
        this.init();
    }

    init() {
        this.db = window.indexedDB.open("basket");
    }

    save(url) {
        LocalStorage.save(this.get_local_storage_images_key(), url);
    }

    delete_item(id){
        return LocalStorage.delete_item_child(this.get_local_storage_images_key(), id);
    }

    retrieve() {
        return LocalStorage.retrieve(this.get_local_storage_images_key());
    }

    clear() {
        LocalStorage.delete(this.get_local_storage_images_key());
    }

    get_unique_id() {
        return this.unique_id;
    }

    get_local_storage_images_key() {
        return `basket`;
    }

    success() {
        this.db.success
    }
};

export default new BasketStore();