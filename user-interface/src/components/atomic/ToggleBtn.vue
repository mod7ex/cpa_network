<template>
	<div class="ml-auto">
		<!-- Toggle Button -->
		<label for="toogleA" class="flex items-center cursor-pointer">
			<!-- toggle -->
			<div class="relative">
				<!-- input -->
				<input id="toogleA" type="checkbox" class="hidden" @click="foo" />
				<!-- line -->
				<div class="toggle__line w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
				<!-- dot -->
				<div class="toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"></div>
			</div>
			<!-- label -->
			<!-- <div class="ml-3 text-gray-700 font-medium">
				Toggle Me!
			</div> -->
		</label>
	</div>
</template>

<script>
	export default {
		name: "ToggleBtn",

		methods: {
			foo() {
				this.$emit("buttonCLicked");
			},
		},
	};
</script>

<style scoped>
	.toggle__dot {
		top: -0.25rem;
		left: -0.25rem;
		transition: all 0.3s ease-in-out;
	}

	input:checked ~ .toggle__dot {
		transform: translateX(100%);
		/* background-color: #48bb78; */
		background-color: white;
	}

	.toggle__dot {
		background-color: #48bb78;
	}
</style>
