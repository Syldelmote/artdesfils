<script setup>
import { ref } from 'vue'
import ItemDetailPage from 'src/pages/ItemDetailPage.vue';

const props = defineProps({
  article: Object
})

const popup = ref(false)

const imageUrl = process.env.API + '/uploads/images/' + props.article.imageUrl
const imageUrl2 = process.env.API + '/uploads/images/' + props.article.imageUrl2
const imageUrl3 = process.env.API + '/uploads/images/' + props.article.imageUrl3

function handleClick() {
  popup.value = true
}

</script>

<template>

  <div @click=handleClick>
    <div class="thumb-wrapper">
      <q-img v-if=props.article.imageUrl2 class='thumb-image ' :src=imageUrl2 />
      <q-img v-if=props.article.imageUrl3 class='thumb-image ' :src=imageUrl3 />
      <q-img class="thumb-image " :src="imageUrl" />
    </div>
    <p class="  text-center text-caption text-dark ellipsis" >{{props.article.nom}}</p>
  </div> 

  <ItemDetailPage  v-model="popup"  :article=props.article />



</template>

<style scoped>

.thumb-wrapper {
  padding: 6rem;
  user-select: none;
  align-items: center;
  border: none;
  border-radius: 1rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  transition: all .3s ease;
  position: relative;
}

.thumb-wrapper:hover {
  background: #0000000d;
  cursor: pointer;
  transition: all .3s ease
}

.thumb-image {
  background-color: #fff;
  border: 5px solid rgba(255, 255, 255, 0.923);
  border-radius: 1rem;

  box-shadow: 0 2px 4px #0000000d;
  height: auto;
  max-height: 150px;
  width: 200px;
  overflow: hidden;
  position: absolute;
}


.thumb-image:nth-of-type(n){
  transform: rotate(5deg);
}
.thumb-image:nth-of-type(2n){
  transform: rotate(-5deg);
}
.thumb-image:nth-of-type(3n){
  transform: rotate(10deg);
}


</style>
