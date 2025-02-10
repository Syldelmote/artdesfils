<template>
	<div class="flex justify-between full-width q-px-xl q-py-md ">
		<q-img 
			fetchpriority="high" 
			no-spinner no-native-menu 
			src="/images/img2.jpg" 
			srcset="/images/img2_lowres.jpg 400w, /images/img2.jpg 800w"
			class="gallery-image" />
		<q-img 
			fetchpriority="high" 
			no-spinner no-native-menu 
			src="/images/img3.jpg" 
			srcset="/images/img3_lowres.jpg 400w, /images/img3.jpg 800w"
			class="gallery-image " />
		<q-img 
			fetchpriority="high" 
			no-spinner no-native-menu 
			src="/images/img4.jpg" 
			srcset="/images/img4_lowres.jpg 400w, /images/img4.jpg 800w"
			class="gallery-image " />
	
	</div>
</template>


<style scoped>


.gallery-image {
  width: 30%;
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

</style>