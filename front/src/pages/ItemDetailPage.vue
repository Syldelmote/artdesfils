<script setup>
import ItemDialogBar from '../components/ItemDetail/ItemDialogBar.vue'
import CloseButton from '../components/ItemDetail/CloseButton.vue'
import ItemGallery from '../components/ItemDetail/ItemGallery.vue'
import ItemCarousel from 'src/components/ItemDetail/ItemCarousel.vue'
import { useQuasar } from 'quasar'
import ItemDescription from '../components/ItemDetail/ItemDescription.vue'

const props = defineProps({
  article: Object
})
const popup = defineModel()
const $q = useQuasar()
const mobile =   $q.platform.is.mobile

</script>

<template>
  <q-dialog class="z-top"  full-width v-model="popup" backdrop-filter="blur(4px) saturate(150%)">
    <q-card class=" q-pa-sm flex bg-primary">
      <CloseButton v-model="popup" class="col-auto q-pa-sm" />
      <div class="full-width">
      <ItemCarousel v-if="mobile" :article />
      <ItemGallery v-else  :article  />
      <ItemDescription :article  />
    </div>
      <ItemDialogBar :id="props.article['@id']" />
    </q-card>
  </q-dialog>
</template>

