<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  article: Object
})

const slide = ref(1)
const imageUrl = computed(() => process.env.API + '/uploads/images/' + props.article.imageUrl)
const imageUrl2 = computed(() => props.article.imageUrl2 ? process.env.API + '/uploads/images/' + props.article.imageUrl2 : null)
const imageUrl3 = computed(() => props.article.imageUrl3 ? process.env.API + '/uploads/images/' + props.article.imageUrl3 : null)
const imageUrl4 = computed(() => props.article.imageUrl4 ? process.env.API + '/uploads/images/' + props.article.imageUrl4 : null)
const imageUrl5 = computed(() => props.article.imageUrl5 ? process.env.API + '/uploads/images/' + props.article.imageUrl5 : null)


</script>


<template>
  <q-card-section>
    <div class="q-pb-md full-width">
      <q-carousel
        animated
        thumbnails
        swipeable
        v-model="slide"
        infinite
        :autoplay="imageUrl2 ? true:false"
        style="max-height: 40vh;"
      >
        <q-carousel-slide :name="1" :img-src= imageUrl />
        <q-carousel-slide :name="2" :img-src= imageUrl2 />
        <q-carousel-slide :name="3" :img-src= imageUrl3 />
        <q-carousel-slide :name="4" :img-src= imageUrl4 />
        <q-carousel-slide :name="5" :img-src= imageUrl5 />
      </q-carousel>
    </div>
  </q-card-section>
  </template>
  
