<script setup>
const url = process.env.DEV ?  process.env.API+'/admin':'/api/public/admin'
</script>

<template>
  <q-btn color="accent" :href=url label="Administration" class="q-ma-md" ></q-btn>
</template>
