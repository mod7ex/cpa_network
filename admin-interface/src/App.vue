<template>
	<div class="px-6 bg-green-200 flex justify-evenly">
		<router-link :to="{ name: 'Login' }">login</router-link>
		<router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
	</div>
	<router-view />
</template>

<script>
	export default {
		name: "App",
	};
</script>

<style></style>
