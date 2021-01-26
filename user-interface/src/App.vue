<template>
	<div>
		<router-link class="mr-8" to="login">Login</router-link>
		<router-link to="dashboard">dashboard</router-link>
	</div>
	<DashboardNav v-if="isLoggedIn" />
	<HomeNav v-if="!isLoggedIn" />
	<router-view />
	<Footer />
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
