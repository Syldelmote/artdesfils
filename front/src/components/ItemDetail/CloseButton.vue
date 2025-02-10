<script setup>
const model = defineModel()
</script>

<template>
      <q-bar class="full-width bg-transparent ">
        <q-space />
        <q-btn dense flat icon="close" @click="model = false" class="close-btn" />
      </q-bar>

</template>

<style>
.close-btn{
  opacity: 0.2;
}
.close-btn:hover{
  opacity: 1;
}

</style>
