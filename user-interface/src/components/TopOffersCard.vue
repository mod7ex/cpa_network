<template>
	<div id="slider" class="rounded shadow m-6 border h-full w-full flex flex-col">
		<div class="flex items-center p-3 rounded-t bg-gray-700">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z" /></svg>
			<h1 class="font-black ml-3 text-yellow-500">Top Offers</h1>
		</div>

		<div class="flex-1 flex flex-col p-3">
			<div class="relative flex-1">
				<div v-for="k in numberOfSlides" :key="k">
					<transition name="slide-fade">
						<div v-if="currentSlide == k" :class="'slide-item' + k" class="absolute w-full h-full"></div>
					</transition>
				</div>

				<div class="flex absolute left-0 right-0 justify-center bottom-4">
					<svg v-for="k in numberOfSlides" :key="k" @click="currentSlide = k" class="fill-current mx-1" :class="{ 'text-white ': currentSlide == k }" width="24" height="24" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" fill-rule="evenodd" clip-rule="evenodd">
						<circle serif:id="shape 19" cx="9" cy="9" r="9" />
					</svg>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "Slider",

		data() {
			return {
				currentSlide: 1,
				numberOfSlides: 3,
			};
		},

		computed: {
			numOfSlides() {
				return document.querySelectorAll("#slider > div").length;
			},
		},

		mounted() {
			this.timeIntervall = setInterval(() => {
				this.currentSlide %= this.numberOfSlides;
				this.currentSlide += 1;
			}, 4000);
		},

		beforeUnmount() {
			clearInterval(this.timeIntervall);
		},
	};
</script>

<style scoped>
	#slider {
		max-width: 800px;
		min-width: 300px;
		min-height: 400px;
	}

	.slide-item1 {
		background-color: greenyellow;
	}

	.slide-item2 {
		background-color: blue;
	}

	.slide-item3 {
		background-color: red;
	}

	/* VueJs Css Text */
	/* .fade-enter-active,
	.fade-leave-active {
	  transition: opacity 0.5s ease;
	}

	.fade-enter-from,
	.fade-leave-to {
	  opacity: 0;
	} */

	/* VueJs Css Slide */
	.slide-fade-enter-active {
		transition: all 0.8s ease-out;
	}

	.slide-fade-leave-active {
		transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
	}

	.slide-fade-enter-from {
		opacity: 0;
		transform: translateX(100%);
	}

	.slide-fade-leave-to {
		opacity: 0;
		transform: translateX(-100%);
	}
</style>
