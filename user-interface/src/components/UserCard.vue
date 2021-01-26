<template>
	<div v-if="me" id="userCard" class="rounded rounded-t-lg overflow-hidden shadow m-3 w-full bg-white">
		<img src="https://i.imgur.com/dYcYQ7E.png" class="w-full" />

		<div class="flex justify-center -mt-8">
			<img src="https://i.imgur.com/8Km9tLL.jpg" class="rounded-full border-solid border-white border-2 -mt-3" />
		</div>

		<div class="text-center px-3 pb-6 pt-2">
			<h3 class="text-black font-bold">{{ me.contact_infos.first_name }} {{ me.contact_infos.last_name }}</h3>
			<p class="mt-2 flex items-center justify-center">
				<svg class="fill-current text-green-700 mr-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" fill-rule="evenodd" clip-rule="evenodd"><circle serif:id="shape 19" cx="9" cy="9" r="9" /></svg>
				<span>Actif User</span>
			</p>
		</div>

		<div class="flex justify-center p-3 text-grey-dark">
			<div class="text-center mr-3 border-r pr-3">
				<h1 class="text-gray-800 font-black text-xl">Balance: {{ me.balance }}$</h1>
			</div>

			<div class="text-center mr-3 border-r pr-3">
				<h2 class="font-black">Today Clicks</h2>
				<span>1123</span>
			</div>

			<div class="text-center">
				<h2 class="font-black">Today Conversions</h2>
				<span>7</span>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";

	export default {
		name: "UserCard",

		computed: {
			...mapGetters({ me: "ME" }),
		},
	};
</script>

<style scoped>
	#userCard {
		max-width: 500px;
	}
</style>
