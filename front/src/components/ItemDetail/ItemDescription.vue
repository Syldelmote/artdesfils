<script setup>

const props = defineProps({
	article:Object
})
</script>
<template>
	<div>
	<q-card-section horizontal class=" q-ml-md q-mr-lg justify-between items-center" style="max-height: 50vh;" >
		<p class="text-h6 q-mb-xs">{{ props.article.nom }}</p>
		<div>
			<q-chip size="xl" icon-right="euro" outline color="accent" :label='props.article.prix / 100' />
		</div>
	</q-card-section>
	<q-card-section class="full-width ">
		<p class="text-body2">{{ props.article.description }}</p>
	</q-card-section>
</div>
</template>
