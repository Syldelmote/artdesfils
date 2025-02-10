<script setup>
const props = defineProps({
  id:String
})
const id = props.id.split("/").pop();

</script>

<template>
  <div class="fit flex flex-center">
  <q-btn :to="`/contact/${id}`"  class="q-pa-md q-my-sm" color="accent" label="Je veux cet article ! "  no-caps   style="border-radius: 10px; width: 80%; font-size: 1.2rem;"  >
    <q-tooltip class="q-pa-md bg-grey-8" :delay="1000"> Vers Formulaire Contact </q-tooltip>
  </q-btn>
  </div>

</template>


