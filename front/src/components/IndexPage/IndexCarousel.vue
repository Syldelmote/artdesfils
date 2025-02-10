<script setup>
import { ref } from 'vue'

const slide = ref(1)

</script>


<template>
    <div class="q-pb-md full-width">
      <q-carousel
        animated
        v-model="slide"
        arrows
        infinite
        :autoplay=true

      >
        <q-carousel-slide :name="1" img-src="/images/img2.jpg" />
        <q-carousel-slide :name="2" img-src="/images/img3.jpg"/>
        <q-carousel-slide :name="3" img-src="/images/img4.jpg" />
      </q-carousel>
    </div>
  </template>
  
