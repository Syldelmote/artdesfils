<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { api } from 'src/boot/axios';

const route = useRoute();
const tag = ref(route.params.tag);
const produits = ref([]);

async function fetchProduits() {
  try {
    const res = await api.get(`/produits?tag=${tag.value}`);
    produits.value = res.data['hydra:member'];
  } catch (error) {
    console.error('Erreur lors du chargement des produits:', error);
  }
}


onMounted(fetchProduits);
  
 
  </script>

<template>
    <div>
      <h1>Produits {{ tag }}</h1>
      <ul>
        <li v-for="produit in produits" :key="produit.id">
          {{ produit.nom }}
        </li>
      </ul>
    </div>
  </template>
  
