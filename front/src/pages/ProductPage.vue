<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';
import { api } from 'src/boot/axios';
import PageHeader from 'src/components/IndexPage/PageHeader.vue';


const route = useRoute();
const id = ref(route.params.id);
const produit = ref(null);

const imageUrl = computed(() => process.env.API + '/uploads/images/' +produit.value.imageUrl)
const imageUrl2 = computed(() => process.env.API + '/uploads/images/' +produit.value.imageUrl2)
const imageUrl3 = computed(() => process.env.API + '/uploads/images/' +produit.value.imageUrl3)


async function fetchProduit() {
  try {
    const res = await api.get(`/produits/${id.value}`);
    produit.value = res.data;
  } catch (error) {
    console.error('Erreur lors du chargement du produit:', error);
  }
}


onMounted(fetchProduit);
  
 
  </script>

<template>
      <q-page class="flex flex-center">
        <PageHeader  />
    <div v-if="produit">
        <h3>{{ produit.nom }}</h3>
        <div>reference :{{ produit['@id'] }} </div>
        <div>prix :{{ produit['prix'] /100 }} Euros </div>

        <div>
            <q-img :src="imageUrl" spinner-color="white" style="height: 140px; max-width: 150px" />
            <q-img :src="imageUrl2" spinner-color="white" style="height: 140px; max-width: 150px" />
            <q-img :src="imageUrl3" spinner-color="white" style="height: 140px; max-width: 150px" />
        </div>
        <p>
           {{ produit.description }} 
        </p>


      

    </div>
    <div v-else>
      Chargement en cours...
    </div>
    </q-page>
  </template>
  
