<script setup>
import { RouterLink } from 'vue-router';

const props = defineProps({
    width:{
        type:Number,
        default:200
    }
})
</script>
<template>
<header class="bg-accent full-width flex flex-center " >
    <RouterLink to="/" >
        <q-img src="/images/Logo1.webp"   height="auto"  :width="`${props.width}px `" />
        <q-tooltip :delay="600" class="q-pa-sm">Page Accueil </q-tooltip>
    </RouterLink>
</header>
</template>