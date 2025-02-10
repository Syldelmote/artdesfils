<script setup>
import { api } from 'src/boot/axios';
import { onBeforeMount, ref, watch } from 'vue';
import { debounce } from 'quasar';
import CatalogGrid from 'src/components/CatalogPage/CatalogGrid.vue';
import SearchInput from 'src/components/CatalogPage/SearchInput.vue';
import TabBar from 'src/components/CatalogPage/TabBar.vue';
import PageHeader from 'src/components/IndexPage/PageHeader.vue';

const produits = ref([]);
const searchFilter = ref();
const loading = ref(false);
const searchBarIsActive = ref(false)
const debouncedSearch = debounce(asyncSearch, 300);


onBeforeMount(() => {
  fetchProduits();
});

async function fetchProduits() {
  loading.value = true;
  try {
    const res = await api.get('/produits');
    produits.value = res.data['hydra:member'];
  } catch (error) {
    console.error('Erreur lors du chargement des produits:', error);
  } finally {
    loading.value = false;
  }
}

async function asyncSearch() {
  if (searchFilter.value === '') {
    return fetchProduits();
  }
  loading.value = true;
  const searchTerm = encodeURIComponent(searchFilter.value);
  const searchUrl = `produits?custom_search=${searchTerm}`;
  try {
    const res = await api.get(searchUrl);
    produits.value = res.data['hydra:member'];
  } catch (error) {
    console.error('Erreur lors de la recherche:', error);
  } finally {
    loading.value = false;
  }
}

async function handleTabChange(filter) {
  if (filter.startsWith('Tous')) {
    return fetchProduits();
  }
  loading.value = true;
  const filteredUrl = `produits?categorie.nom=${filter}`;
  try {
    const res = await api.get(filteredUrl);
    produits.value = res.data['hydra:member'];
  } catch (error) {
    console.error('Erreur lors de la recherche:', error);
  } finally {
    loading.value = false;
  }
}
</script>

<template>
  <q-page>
    <PageHeader :width=150 />
    <div style="position: relative;" >
    <q-toolbar  class="flex-center " >
      <TabBar  class="z-top" v-show="!searchBarIsActive"  @tabChange="handleTabChange"  />
      <SearchInput
        v-model="searchFilter" 
        @update:model-value="debouncedSearch" 
        @clear="fetchProduits" 
        @searchBarActive='()=>  searchBarIsActive = true'
        @searchBarInactive = '()=>  searchBarIsActive = false'
        class="flex justify-end"
        style="position: absolute; top: 0;"
        
      />
    </q-toolbar>

 



    </div>

    <q-separator inset class="q-mb-md" />

    <q-inner-loading :showing="loading">
      <q-spinner-infinity size="50px" color="primary" />
    </q-inner-loading>

    <CatalogGrid :produits="produits" />
  </q-page>
</template>