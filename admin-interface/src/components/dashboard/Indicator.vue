<template>
	<div class="indicator">
		<div>
			<h3 class="uppercase">
				<slot name="title" />
			</h3>
			<div class="mb-2">
				<span class="mr-2">
					<slot name="value" />
				</span>
				<span><i class="fas" :class="{ 'fa-caret-up': state, 'fa-caret-down': !state }"></i></span>
			</div>
			<div>
				<small :class="{ 'text-green-800': state, 'text-red-800': !state }">
					<i class="fas" :class="{ 'fa-arrow-up': state, 'fa-arrow-down': !state }"></i>

					<slot name="percentage" />% &nbsp;
				</small>
				<small class="text-gray-400">from last day</small>
			</div>
		</div>
		<span>
			<slot name="i" />
		</span>
	</div>
</template>

<script>
	export default {
		name: "Indicator",

		props: {
			state: Boolean,
		},
	};
</script>

<style scoped>
	.indicator {
		@apply p-3 m-2 border rounded shadow-lg w-full bg-white flex justify-between items-start text-gray-800 font-bold;
	}

	@screen md {
		.indicator {
			max-width: 300px;
		}
	}

	.indicator > span {
		@apply p-3 bg-blue-700 rounded-full text-white flex items-center justify-center shadow-lg;
	}

	.indicator > div > h3 {
		@apply mb-2 font-black;
	}

	.indicator > div > div {
		@apply flex justify-start items-center;
	}

	.indicator > div > div span:last-of-type {
		@apply text-green-800 font-black text-2xl;
	}
</style>
