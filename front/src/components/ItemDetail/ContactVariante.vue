<script setup>
const props = defineProps({
  id:String
})
const id = props.id.charAt(props.id.length-1)
</script>

<template>
  <div class="text-italic	 text-center">
    Intéressé par ce produit dans une autre couleur, avec un autre tissu  ? N'hésitez pas à me  <a href="/#/contact">contacter</a> pour que nous puissions étudier
    votre demande ensemble
  </div>

</template>
