<template>
	<div id="block" class="bg-white shadow-md rounded-t-lg mb-12 m-5" :class="{ 'max-w-max': fit }">
		<div class="bg-gray-700 text-gray-300 rounded-t-lg p-4 flex items-center">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1 6h2v8h-2v-8zm1 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" /></svg>
			<h1 class="ml-3 font-black text-2xl">{{ title }}</h1>
			<ToggleBtn @buttonCLicked="toggleBlock" />
		</div>

		<div class="p-4" v-if="show">
			<slot> </slot>
		</div>
	</div>
</template>

<script>
	import ToggleBtn from "./ToggleBtn";
	export default {
		name: "Block",

		components: {
			ToggleBtn,
		},

		props: {
			title: {
				type: String,
				default: "Block Title",
			},

			fit: {
				type: Boolean,
				default: true,
			},
		},

		data() {
			return {
				show: true,
			};
		},

		methods: {
			toggleBlock() {
				// this.show = !this.show;
			},
		},
	};
</script>

<style>
	#block {
		flex-basis: 400px;
	}
</style>
