<script setup>
import { ref } from 'vue'

const search = defineModel()
const emits = defineEmits(['search', 'clear', 'searchBarActive', 'searchBarInactive'])

const toggleSearch = ref(false)

function handleSearchClick() {
  search.value = ''
  emits('searchBarActive')
  toggleSearch.value = true
}

function handleCancelClick() {
  emits('searchBarInactive')
  emits('clear')
  toggleSearch.value = false
}

function handleClear() {ar
  toggleSearch.value = false
}

</script>

<template>
  <q-toolbar class="relative">

    <q-input class=" col-12  shadow-14 bg-white q-pa-sm"  style="border-radius: 20px;" v-show="toggleSearch"  @clear=handleClear()  filled 
        v-model="search" placeholder="Rechercher"  >
        <q-btn dense flat icon="close" @click="handleCancelClick" color="grey" />

      </q-input>
      <q-icon v-show="!toggleSearch" size="sm" color="accent" name="search" class="cursor-pointer col-1" @click="handleSearchClick">
        <q-tooltip class="q-pa-sm text-caption " :delay="500">Rechercher</q-tooltip>
      </q-icon>
   
  </q-toolbar>
</template>
