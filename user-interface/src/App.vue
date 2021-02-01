<template>
	<!-- <div>
		<router-link class="mr-8" to="login">Login</router-link>
		<router-link to="dashboard">dashboard</router-link>
	</div> -->

	<div class="min-h-screen flex flex-col">
		<DashboardNav v-if="isLoggedIn" />
		<HomeNav v-if="!isLoggedIn" />
		<div class="flex-grow bg-none">
			<router-view />
		</div>
		<Footer />
	</div>
</template>

<script>
	import HomeNav from "./components/HomeNav";
	import DashboardNav from "./components/DashboardNav";
	import Footer from "./components/Footer";
	import { mapGetters } from "vuex";

	export default {
		name: "App",

		components: { HomeNav, DashboardNav, Footer },

		computed: {
			...mapGetters(["isLoggedIn"]),
		},
	};
</script>

<style></style>
