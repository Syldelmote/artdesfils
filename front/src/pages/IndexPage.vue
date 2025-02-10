<script setup>
import CatalogButton from 'src/components/IndexPage/CatalogButton.vue';
import AdminButton from 'src/components/IndexPage/AdminButton.vue';
import PageHeader from 'src/components/IndexPage/PageHeader.vue';
import { useQuasar } from 'quasar'
import IndexGallery from 'src/components/IndexPage/IndexGallery.vue'
import IndexCarousel from 'src/components/IndexPage/IndexCarousel.vue';

const $q = useQuasar()
const mobile =   $q.platform.is.mobile

</script>

<template>
  <q-page>
    <div class="content-wrapper">
      <PageHeader :width="mobile? 200:350" />
      
      <IndexCarousel v-if="mobile" />
      <IndexGallery v-else/>

      <div class=" flex column items-center">
        <CatalogButton class="custom-button" />
        <AdminButton class="custom-button" />
      </div>
    </div>
  </q-page>
</template>

<style scoped>
.content-wrapper {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: justify-evenly;
  align-items: center;
}

.custom-button {
  font-family: 'Montserrat', sans-serif;
  padding: 0.5rem 1rem;
}
</style>