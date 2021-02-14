<template>
	<div class="p-3 my-3 flex items-center justify-center">
		<small>({{ elementsPerPage }}/page)</small>

		<button v-if="currentPage > 1" @click="changePage(false)" class="ml-2 focus:outline-none p-3 rounded-full hover:bg-gray-400 transition duration-500 ease-in-out">
			<svg width="18px" height="17px" viewBox="0 0 18 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g id="prev" transform="translate(8.500000, 8.500000) scale(-1, 1) translate(-8.500000, -8.500000)">
					<polygon class="arrow" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
					<polygon class="arrow-fixed" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
					<path d="M-1.48029737e-15,0.56157424 L-1.48029737e-15,16.1929159 L9.708,8.33860465 L-2.66453526e-15,0.56157424 L-1.48029737e-15,0.56157424 Z M1.33333333,3.30246869 L7.62533333,8.34246869 L1.33333333,13.4327013 L1.33333333,3.30246869 L1.33333333,3.30246869 Z"></path>
				</g>
			</svg>
		</button>

		<span class="mx-1 rounded py-1 px-3" v-if="currentPage > 2">
			<svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M6 12c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm9 0c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm9 0c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3z" /></svg>
		</span>

		<span class="mx-1 rounded bg-gray-300 py-1 px-3" v-if="currentPage > 1">{{ currentPage - 1 }}</span>
		<span class="mx-1 rounded border-2 py-1 px-3">{{ currentPage }}</span>
		<span class="mx-1 rounded bg-gray-300 py-1 px-3" v-if="currentPage < numberOfPages()">{{ currentPage + 1 }}</span>

		<span class="mx-1 rounded py-1 px-3" v-if="currentPage < numberOfPages() - 1">
			<svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M6 12c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm9 0c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm9 0c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3z" /></svg>
		</span>

		<button v-if="currentPage < numberOfPages()" @click="changePage(true)" class="focus:outline-none p-3 rounded-full hover:bg-gray-400 transition duration-500 ease-in-out">
			<svg width="18px" height="17px" viewBox="-1 0 18 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g>
					<polygon class="arrow" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
					<polygon class="arrow-fixed" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
					<path d="M-4.58892184e-16,0.56157424 L-4.58892184e-16,16.1929159 L9.708,8.33860465 L-1.64313008e-15,0.56157424 L-4.58892184e-16,0.56157424 Z M1.33333333,3.30246869 L7.62533333,8.34246869 L1.33333333,13.4327013 L1.33333333,3.30246869 L1.33333333,3.30246869 Z"></path>
				</g>
			</svg>
		</button>
	</div>
</template>

<script>
	export default {
		name: "Paginator",

		props: {
			elementsPerPage: {
				type: Number,
				default: 7,
			},

			arr: Array,
		},

		data() {
			return {
				currentPage: 1,
			};
		},

		methods: {
			numberOfPages() {
				return Math.floor(this.arr.length / this.elementsPerPage) + ((this.arr.length % this.elementsPerPage) / this.elementsPerPage != 0 ? 1 : 0);
			},

			currentPageIndexes() {
				return Array.from(this.arr.keys()).slice(this.elementsPerPage * (this.currentPage - 1), this.elementsPerPage * this.currentPage);
			},

			changePage(next) {
				if (next && this.currentPage < this.numberOfPages()) {
					this.currentPage++;
				} else if (!next && this.currentPage > 1) {
					this.currentPage--;
				}

				this.$emit("pageChanged", this.currentPageIndexes());
			},
		},

		mounted() {
			this.$emit("pageChanged", this.currentPageIndexes());
		},
	};
</script>

<style></style>
