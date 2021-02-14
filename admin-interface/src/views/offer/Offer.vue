<template>
	<Admin v-if="offer">
		<template v-slot:title>Offer Id: sdf1s6f4z9r4fgz</template>
	</Admin>
</template>

<script>
	export default {
		name: "Offer",

		data() {
			return {
				offer: null,
			};
		},

		mounted() {
			api.get(`/offers/${this.$route.params.id}`).then((resp) => {
				this.offer = resp.data;
				console.log(this.offer);
			});
		},
	};
</script>

<style></style>
