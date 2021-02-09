<template>
	<div class="flex flex-col">
		<nav class="bg-gray-600 px-6 absolute top-0 bottom-0" v-if="navIsVisible">
			<button @click="toggleNav">click</button>
			<h1>Nav</h1>
		</nav>

		<div class="flex justify-between items-center p-2 mb-16">
			<button @click="toggleNav" class="text-3xl text-gray-700 rounded-full p-3 focus:outline-none hover:bg-gray-400">
				<i class="fas fa-bars"></i>
			</button>
			<div class="flex justify-end items-center px-3">
				<input type="search" class="p-1 focus:outline-none border border-gray-200 rounded" placeholder="Search here ..." />
				<div class="mx-3">
					<img class="rounded-full" width="50" height="50" src="../assets/img/team-1-800x800.53033970.jpg" alt="" />
				</div>
				<span class="text-gray-700 p-2 rounded-full cursor-pointer hover:bg-gray-400">
					<i class="fas fa-ellipsis-v"></i>
				</span>
			</div>
		</div>

		<div>
			<slot />
		</div>
	</div>
</template>

<script>
	export default {
		name: "Admin",

		data() {
			return {
				navIsVisible: false,
			};
		},

		methods: {
			toggleNav() {
				this.navIsVisible = !this.navIsVisible;
			},
		},
	};
</script>

<style></style>
