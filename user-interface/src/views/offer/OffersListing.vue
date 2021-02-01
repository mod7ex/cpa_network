<template>
	<div class="p-3">
		<div class="bg-white md:m-3 mb-3 shadow-md">
			<div class="bg-gray-700 text-gray-300 p-4  rounded-t flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 9c.552 0 1 .449 1 1s-.448 1-1 1-1-.449-1-1 .448-1 1-1zm0-2c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm-9 4c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm18 0c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm-9-6c.343 0 .677.035 1 .101v-3.101c0-.552-.447-1-1-1s-1 .448-1 1v3.101c.323-.066.657-.101 1-.101zm9 4c.343 0 .677.035 1 .101v-7.101c0-.552-.447-1-1-1s-1 .448-1 1v7.101c.323-.066.657-.101 1-.101zm0 10c-.343 0-.677-.035-1-.101v3.101c0 .552.447 1 1 1s1-.448 1-1v-3.101c-.323.066-.657.101-1 .101zm-18-10c.343 0 .677.035 1 .101v-7.101c0-.552-.447-1-1-1s-1 .448-1 1v7.101c.323-.066.657-.101 1-.101zm9 6c-.343 0-.677-.035-1-.101v7.101c0 .552.447 1 1 1s1-.448 1-1v-7.101c-.323.066-.657.101-1 .101zm-9 4c-.343 0-.677-.035-1-.101v3.101c0 .552.447 1 1 1s1-.448 1-1v-3.101c-.323.066-.657.101-1 .101z" /></svg>
				<h1 class="ml-4 font-black text-2xl">Filter offers</h1>
				<ToggleBtn @buttonCLicked="toggleFilterForm" />
			</div>

			<transition name="slide-fade">
				<div v-if="filterFormIsVisible">
					<div class="mb-3 p-6">
						<label for="search" class="">Search</label>
						<input type="text" v-model="searchText" id="search" class="p-1 rounded bg-gray-100 ml-3" placeholder="Search" />
					</div>

					<form class="p-3 flex flex-wrap items-center justify-items-stretch" v-if="offersFilter">
						<div class="p-2 mb-4 mr-4" v-if="offersFilter.browsers.length">
							<label class="block" for="browser">Browser</label>
							<select v-model="filterForm.browser" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="browser">
								<option selected disabled></option>
								<option v-for="(br, i) in offersFilter.browsers" :key="i" :value="br._id">{{ br.name }}</option>
							</select>
						</div>

						<div class="p-2 mb-4 mr-4" v-if="offersFilter.countries.length">
							<label class="block" for="country">country</label>
							<select v-model="filterForm.country" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="country">
								<option selected disabled></option>
								<option v-for="(c, i) in offersFilter.countries" :key="i" :value="c._id">{{ c.details.name }}, {{ c.details.code }}</option>
							</select>
						</div>

						<div class="p-2 mb-4 mr-4" v-if="offersFilter.devices.length">
							<label class="block" for="device">Device</label>
							<select v-model="filterForm.device" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="device">
								<option selected disabled></option>
								<option v-for="(dv, i) in offersFilter.devices" :key="i" :value="dv._id">{{ dv.name }}</option>
							</select>
						</div>

						<div class="p-2 mb-4 mr-4" v-if="offersFilter.niches.length">
							<label class="block" for="niche">Niche</label>
							<select v-model="filterForm.niche" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="niche">
								<option selected disabled></option>
								<option v-for="(nh, i) in offersFilter.niches" :key="i" :value="nh._id">{{ nh.name }}</option>
							</select>
						</div>

						<div class="p-2 mb-4 mr-4" v-if="offersFilter.oss.length">
							<label class="block" for="os">Os</label>
							<select v-model="filterForm.os" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="os">
								<option selected disabled></option>
								<option v-for="(os, i) in offersFilter.oss" :key="i" :value="os._id">{{ os.name }}</option>
							</select>
						</div>

						<div class="p-2 mb-4 mr-4" v-if="offersFilter.payout_types.length">
							<label class="block" for="payout_type">Payout Type</label>
							<select v-model="filterForm.payout_type" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="payout_type">
								<option selected disabled></option>
								<option v-for="(pt, i) in offersFilter.payout_types" :key="i" :value="pt._id">{{ pt.name }}</option>
							</select>
						</div>

						<div class="p-2 mb-4 mr-4" v-if="offersFilter.promotion_methods.length">
							<label class="block" for="promotion_method">Promotion method</label>
							<select v-model="filterForm.promotion_method" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="promotion_method">
								<option selected disabled></option>
								<option v-for="(pm, i) in offersFilter.promotion_methods" :key="i" :value="pm._id">{{ pm.name }}</option>
							</select>
						</div>

						<div class="p-2 mb-4 mr-4" v-if="offersFilter.verticals.length">
							<label class="block" for="vertical">Vertical</label>
							<select v-model="filterForm.vertical" class="shadow min-w-full p-2 bg-gray-100 focus:bg-gray-200 rounded focus:outline-none" id="vertical">
								<option selected disabled></option>
								<option v-for="(v, i) in offersFilter.verticals" :key="i" :value="v._id">{{ v.name }}</option>
							</select>
						</div>
					</form>

					<div class="px-16 py-6 flex flex-row-reverse items-center">
						<button @click="filterOffers" class="text-white mx-4 focus:outline-none hover:opacity-70 font-black cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-700 rounded">filter</button>
						<button @click="resetOffers" class="text-white focus:outline-none hover:opacity-70 font-black cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-700 rounded">reset</button>
					</div>
				</div>
			</transition>
		</div>

		<!-- ***************************************************************************** -->

		<div class="md:m-3 bg-white rounded-b shadow-md">
			<div class="bg-gray-700 text-gray-300 p-3 rounded-t">
				<h2 class="font-black text-xl">
					Listing <small>Choose from {{ offers.length }} offers (we have more ...)</small>
				</h2>
			</div>

			<!--  -->

			<div class="p-3">
				<table class="min-w-full">
					<thead class="bg-gray-400 rounded">
						<tr>
							<th class="p-3 text-left leading-4 tracking-wider">ID</th>
							<th class="p-3 text-left leading-4 tracking-wider text-sm">name</th>
							<th class="p-3 text-left leading-4 tracking-wider text-sm">payout</th>
							<th class="p-3 text-left leading-4 tracking-wider text-sm">targeting</th>
							<th class="p-3 text-left leading-4 tracking-wider text-sm">EPC($)</th>
							<th class="p-3 text-left leading-4 tracking-wider text-sm">countries</th>
							<th class=""></th>
						</tr>
					</thead>
					<tbody class="bg-white">
						<tr v-for="offerIx in currentPageIndexes()" :key="offerIx">
							<td class="p-3 flex items-center">
								<span>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.219 4h-3.926c-1.654-2.58-4.919-4.182-8.293-3.983v1.688c2.286-.164 4.79.677 6.113 2.295h-2.113v2.339c-2.059-.157-4.005.605-5 1.159l.688 1.617c1.196-.625 2.53-1.243 4.312-1.026v4.084l10.796 10.827 8.204-8.223-10.781-10.777zm-2.226 5.875c-.962.963-2.598.465-2.88-.85 1.318.139 2.192-.872 2.114-2.017 1.261.338 1.701 1.93.766 2.867z" /></svg>
									<img src="" alt="" />
								</span>
								<svg class="mx-3 fill-current text-green-700" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><circle cx="12" cy="12" r="12" /></svg>
								<small>Id:{{ offers[offerIx]._id }}</small>
							</td>

							<td class="p-3 font-bold">
								<router-link class="text-blue-700 hover:underline" :to="{ name: 'OfferDetails', params: { id: offers[offerIx]._id } }">{{ offers[offerIx].name }}</router-link>
							</td>

							<td class="p-3">{{ offers[offerIx].payout / 100 }} $</td>

							<td class="flex">
								<svg class="" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22 10h-1v-2h-11v13h5v1.617c0 .524.121 1.058.502 1.383h-5.002c-.398 0-.779-.158-1.061-.439-.281-.282-.439-.663-.439-1.061v-15c0-.398.158-.779.439-1.061.282-.281.663-.439 1.061-.439h10c.398 0 .779.158 1.061.439.281.282.439.663.439 1.061v2.5zm2 2.25c0-.69-.56-1.25-1.25-1.25h-5.5c-.69 0-1.25.56-1.25 1.25v10.5c0 .69.56 1.25 1.25 1.25h5.5c.69 0 1.25-.56 1.25-1.25v-10.5zm-15.407 11.75h-6.593l2.599-3h3.401v1.804c0 .579.337 1.09.593 1.196zm11.407-1c-.553 0-1-.448-1-1s.447-1 1-1c.552 0 .999.448.999 1s-.447 1-.999 1zm3-3v-6.024h-6v6.024h6zm-2-15h-2v-3h-17v15h6v2h-8v-19h21v5zm-.5 7h-1c-.276 0-.5.224-.5.5s.224.5.5.5h1c.275 0 .5-.224.5-.5s-.225-.5-.5-.5z" /></svg>
								<svg class="mx-1" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22.5 7c.828 0 1.5.672 1.5 1.5v14c0 .826-.671 1.5-1.5 1.5h-7c-.829 0-1.5-.675-1.5-1.5v-14c0-.827.673-1.5 1.5-1.5h7zm-8.907 17h-9.593l2.599-3h6.401v1.804c0 .579.336 1.09.593 1.196zm5.407-1c-.553 0-1-.448-1-1s.447-1 1-1c.552 0 .999.448.999 1s-.447 1-.999 1zm4-3v-10.024h-8v10.024h8zm-1-14h-2v-4h-18v15h11v2h-13v-19h22v6zm-2.5 3c.275 0 .5-.224.5-.5s-.225-.5-.5-.5h-1c-.276 0-.5.224-.5.5s.224.5.5.5h1z" /></svg>
								<svg class="" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M13.563 24h-11.563c-1.104 0-2-.896-2-2v-20c0-1.104.896-2 2-2h14c1.104 0 2 .896 2 2v4h-2v-3h-14v17h11v2.5c0 .524.182 1.175.563 1.5zm8.937-17c.828 0 1.5.672 1.5 1.5v14c0 .826-.671 1.5-1.5 1.5h-7c-.829 0-1.5-.675-1.5-1.5v-14c0-.827.673-1.5 1.5-1.5h7zm-13.5 14c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm10 2c-.553 0-1-.448-1-1s.447-1 1-1c.552 0 .999.448.999 1s-.447 1-.999 1zm4-3v-10.024h-8v10.024h8zm-3.5-11c.275 0 .5-.224.5-.5s-.225-.5-.5-.5h-1c-.276 0-.5.224-.5.5s.224.5.5.5h1z" /></svg>
							</td>

							<td class="p-3">
								<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
									<span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative text-xs">0.034</span>
								</span>
							</td>

							<td class="p-3">
								<small v-for="(id, i) in offers[offerIx].country_ids" :key="i" class="bg-gray-300 rounded-lg m-1 p-1">
									{{
										offersFilter.countries.reduce((acc, curr) => {
											return curr._id === id ? curr.details.code : acc;
										})
									}}
								</small>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<!--  -->

			<div class="p-3 text-center" v-if="!offers.length">
				<h2 class="font-black text-xl">
					No offers found (-@^-^@-)
				</h2>
			</div>

			<!-- pagination -->
			<div class="p-3 flex items-center justify-center">
				<small>Pages(-9/page)</small>

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
		</div>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";
	import ToggleBtn from "../../components/atomic/ToggleBtn";

	export default {
		name: "OffersListing",

		components: { ToggleBtn },

		data() {
			return {
				elementsPerPage: 9,
				currentPage: 1,

				searchText: null,
				filterForm: {},

				filterFormIsVisible: true,
			};
		},

		computed: {
			...mapGetters(["offers", "offersFilter"]),
		},

		methods: {
			toggleFilterForm() {
				this.filterFormIsVisible = !this.filterFormIsVisible;
			},

			numberOfPages() {
				return Math.floor(this.offers.length / this.elementsPerPage) + ((this.offers.length % this.elementsPerPage) / this.elementsPerPage != 0 ? 1 : 0);
			},

			currentPageIndexes() {
				return Array.from(this.offers.keys()).slice(this.elementsPerPage * (this.currentPage - 1), this.elementsPerPage * this.currentPage);
			},

			changePage(next) {
				if (next && this.currentPage < this.numberOfPages()) {
					this.currentPage++;
				} else if (!next && this.currentPage > 1) {
					this.currentPage--;
				}
			},

			filterOffers() {
				if (Object.keys(this.filterForm).length != 0) {
					this.$store.commit("filterOffers", this.filterForm);
				}
			},

			resetOffers() {
				this.filterForm = {};
				this.searchText = null;
				// this.$forceUpdate();
				setTimeout(() => {
					this.$store.commit("resetOffers");
				}, 500);
			},
		},

		watch: {
			searchText: function(val, oldval) {
				this.$store.commit("filterOffersByTextSearch", val);
			},
		},

		mounted() {
			this.$store.dispatch("fetchOffersFilters");
			this.$store.dispatch("fetchOffers");
		},
	};
</script>

<style scoped>
	form > div {
		min-width: 250px;
	}

	/* Enter and leave animations can use different */
	/* durations and timing functions. */
	.slide-fade-enter-active {
		transition: all 0.5s ease-out;
	}

	.slide-fade-leave-active {
		transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
	}

	.slide-fade-enter-from,
	.slide-fade-leave-to {
		transform: translateY(-90px);
		opacity: 0;
	}
</style>
