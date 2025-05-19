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
  <div class="mb-5 mt-5">
    <div class="mt-3 text-black-50 font-weight-bold generic-comments"  >{{stores.BaseStore.localization('imet-core::analysis_report.comments')}} :</div>
    <p>
      <editor></editor>
    </p>
    <html_to_image :element="name"
                   :exclude_elements="exclude_elements"
                   :type_image="type_image" :event_id="event_id"></html_to_image>
  </div>
</template>

<script>
export default {
  name: "action_buttons",
  inject:['stores'],
  props: {
    name: {
      type: String,
      default: null
    },
    exclude_elements: {
      type: String,
      default: ''
    },
    event_id:{
      type:String,
      default:'save_image'
    },
    type_image:{
      type:String,
      default:'entire'
    }
  }
}
</script>
