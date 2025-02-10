<script setup>
import { ref, onBeforeMount } from 'vue'
import { api } from 'src/boot/axios';
import { useRoute } from 'vue-router';
import ContactForm from 'src/components/ContactPage/ContactForm.vue';
import PageHeader from 'src/components/IndexPage/PageHeader.vue';

const route = useRoute()
const id = route.params.id

const produit = ref({})

async function fetchProduit() {
  try {
    const res = await api.get('/produits/' + id);
    produit.value = res.data;
  } catch (error) {
    console.error('Erreur lors du chargement du produit', error);
  }
}

onBeforeMount(() => {
  fetchProduit();
});



</script>

<template>
  <q-page class="flex flex-center">
    <PageHeader  />
    <div v-if="produit"  style="height: 85vh;" >
      <div class="text-h5 q-pt-md text-center text-accent">Je suis interessé par un Produit </div>
      <ContactForm :produit />

    </div>
  </q-page>
</template>