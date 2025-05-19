
/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

class DBStorage {
    constructor() {

    }

    async ajax_request(url, params, method = 'POST'){
        return fetch(url, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": window.Laravel.csrfToken,
            },
            body: JSON.stringify(params)
        })
            .then((response) => response.json())
            .then(function(data){
                return data;
            })
            .catch(function (error) {
                console.log(error)
                return null;
            })
    }

    async save( value) {
        return await this.ajax_request(window.Routes.scaling_up_basket_add, {value})
    }

    async retrieve(id){
        return await this.ajax_request(window.Routes.scaling_up_basket_get, {id});
    }

    async all(id) {
        return await this.ajax_request(window.Routes.scaling_up_basket_all, {id})
    }

    delete_item_child(key, id){
        const children = JSON.parse(window.localStorage.getItem(key));
        const not_deleted_items = children.filter((child, key) => key !== id);
        window.localStorage.setItem(key, JSON.stringify(not_deleted_items));
        return this.retrieve(key);
    }

    async delete(id){
        return await this.ajax_request(window.Routes.scaling_up_basket_delete.replace('__id__', id), null,'DELETE');
    }

    async clear(id){
        return await this.ajax_request(window.Routes.scaling_up_basket_clear, {id});
    }

}

export default  new DBStorage();
