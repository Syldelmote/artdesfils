<script setup>
import ContactButton  from  '../ItemDetail/ContactButton.vue'
import ContactVariante from '../ItemDetail/ContactVariante.vue'

const props = defineProps({
  id:String
})

</script>

<template>
  <div class=" q-pa-md  flex column justify-center fit ">
    <ContactButton :id=props.id />
    <ContactVariante :id=props.id />
  </div>
</template> 
x