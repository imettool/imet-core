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
    <div class="img-container">

      <img :src="'/'+url" :width="width"/>
      <div class="img-text"> <slot></slot></div>

    </div>
</template>

<script>
export default {
  props:{
    url:{
      type:String,
      default: ''
    },
    width:{
      type:String,
      default: '100px'
    }
  },
  name: "preview-item",
}
</script>

<style lang="postcss" scoped>
.img-container{
  position: relative;
  display: inline-block;
  margin: 10px 5px 5px;
  max-width: 450px;
  max-height: 350px;
  overflow: auto;
}
.img-text{
  top:28px;
  margin-top: -25px;
  position: absolute;
  display:block;
  right:5px;
}
</style>
