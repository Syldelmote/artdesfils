<script setup>
import { ref, computed } from 'vue'


const props = defineProps({
  article: Object
})

const zoomedImg = ref()
const zoomModel = ref(false)

function toggleZoom(e) {
  if (e.target.tagName === 'IMG') {
    zoomedImg.value = e.target.src
    zoomModel.value = true
  }
}

const imageUrl = computed(() => process.env.API + '/uploads/images/' + props.article.imageUrl)
const imageUrl2 = computed(() => props.article.imageUrl2 ? process.env.API + '/uploads/images/' + props.article.imageUrl2 : null)
const imageUrl3 = computed(() => props.article.imageUrl3 ? process.env.API + '/uploads/images/' + props.article.imageUrl3 : null)
const imageUrl4 = computed(() => props.article.imageUrl4 ? process.env.API + '/uploads/images/' + props.article.imageUrl4 : null)
const imageUrl5 = computed(() => props.article.imageUrl5 ? process.env.API + '/uploads/images/' + props.article.imageUrl5 : null)

const imageCount = computed(() => {
  return [imageUrl.value, imageUrl2.value, imageUrl3.value, imageUrl4.value, imageUrl5.value ].filter(Boolean).length
})

</script>

<template>
  <q-card-section class="col-grow " @click="toggleZoom">
    <div :class="['image-grid', `grid-${imageCount}`]">
      <q-img :src="imageUrl" fit="contain" class="grid-item">
        <q-tooltip :delay="500" class="q-pa-sm text-caption"> cliquez pour agrandir</q-tooltip>
      </q-img>
      <q-img v-if="props.article.imageUrl2" :src="imageUrl2" fit="contain" class="grid-item">
        <q-tooltip :delay="500" class="q-pa-sm text-caption"> cliquez pour agrandir</q-tooltip>
      </q-img>
      <q-img v-if="props.article.imageUrl3" :src="imageUrl3" fit="contain" class="grid-item">
        <q-tooltip :delay="500" class="q-pa-sm text-caption"> cliquez pour agrandir</q-tooltip>
      </q-img>
      <q-img v-if="props.article.imageUrl4" :src="imageUrl4" fit="contain" class="grid-item">
        <q-tooltip :delay="500" class="q-pa-sm text-caption"> cliquez pour agrandir</q-tooltip>
      </q-img>
      <q-img v-if="props.article.imageUrl5" :src="imageUrl5" fit="contain" class="grid-item">
        <q-tooltip :delay="500" class="q-pa-sm text-caption"> cliquez pour agrandir</q-tooltip>
      </q-img>
    </div>
  </q-card-section>

  <q-dialog class="z-max"  full-width full-height v-model="zoomModel">
    <div @click="zoomModel = false">
      <q-img :src="zoomedImg">
        <q-btn flat color="white" icon="close" class=" cursor-pointer absolute-top-right" />

      </q-img>
    </div>
  </q-dialog>

</template>

<style scoped>
.image-grid {
  display: grid;
  gap: 1rem;
  height: 30vh;
}

.grid-1 {
  grid-template-columns: 1fr;
}

.grid-2 {
  grid-template-columns: 1fr 1fr;
}

.grid-3 {
  grid-template-columns: repeat(3, 1fr);
}
.grid-4 {
  grid-template-columns: repeat(4, 1fr);
}
.grid-5 {
  grid-template-columns: repeat(5, 1fr);
}

.grid-item {
  cursor: pointer;
  height: 100%;
  object-fit: contain;
}
</style>