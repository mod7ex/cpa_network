<template>
	<Admin v-if="offer && filter">
		<template v-slot:title>Offer Id: {{ offer._id }}</template>

		<div class="w-full px-4">
			<div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0">
				<div class="rounded-t bg-white mb-0 px-6 py-6">
					<div class="text-center">
						<h6 class="text-gray-800 text-xl font-bold"><i class="fab fa-buffer mr-2"></i>Offer Details</h6>
					</div>
				</div>

				<div class="flex-auto px-4 lg:px-10 py-10 pt-0  border shadow-xl">
					<form>
						<h6 class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase">offer details</h6>
						<div class="flex flex-wrap">
							<div class="px-4 max-w-lg">
								<div class="w-full mb-3">
									<label for="" class="block uppercase text-gray-700 text-xs font-bold mb-2"> Name </label>
									<input type="text" v-model="offer.name" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" />
								</div>
							</div>

							<div class="px-4 max-w-lg">
								<div class="w-full mb-3">
									<label for="" class="block uppercase text-gray-700 text-xs font-bold mb-2"> payout (¢) </label>
									<input type="text" v-model="offer.payout" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" />
								</div>
							</div>

							<div class="px-4 max-w-lg">
								<div class="w-full mb-3">
									<label for="domain" class="block uppercase text-gray-700 text-xs font-bold mb-2"> domain </label>
									<select name="" id="domain" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150">
										<option selected disabled>choose ...</option>
										<option value="">ght.com</option>
										<option value="">modalso.me</option>
										<option value="">tryit4free.co</option>
									</select>
								</div>
							</div>

							<div class="w-full lg:w-6/12 px-4">
								<div class="relative w-full mb-3">
									<label for="" class="block uppercase text-gray-700 text-xs font-bold mb-2"> description </label>
									<textarea v-model="offer.description" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"></textarea>
								</div>
							</div>
						</div>

						<hr class="mt-6 border-2 border-gray-400" />

						<h6 class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase">offer tools</h6>
						<div class="flex flex-wrap">
							<div class="w-full px-4 mb-4">
								<div class="relative w-full mb-3">
									<label for="" class="block uppercase text-gray-700 text-xs font-bold mb-2"> add landers </label>
									<div class="flex items-center px-3">
										<input v-model="lander" type="text" placeholder="https://sub.offer.com ..." class="px-3 py-3 mr-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" />
										<button class="font-black text-4xl focus:outline-none" @click.prevent="addLander" @keypress.enter="addLander">
											<i class="fas fa-plus"></i>
										</button>
									</div>
								</div>
								<div class="relative w-full mb-3">
									<span class="p-2 m-1 mb-3 border rounded border-gray-500 shadow-inner block" v-for="(lander, i) in offer.landing_pages" :key="i">lander-{{ i + 1 }} : {{ lander }}</span>
								</div>
							</div>

							<div class="w-full px-4">
								<div class="relative max-w-sm mb-3">
									<label for="" class="block uppercase text-gray-700 text-xs font-bold mb-2"> screens </label>
									<input type="file" class="px-3 py-3 mr-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" />
								</div>

								<div class="flex">
									<img class="w-44 m-2 shadow-xl" src="../../assets/img/unnamed.png" alt="" />
									<img class="w-44 m-2 shadow-xl" src="../../assets/img/GM-Diet-Plan-Feature.jpg" alt="" />
								</div>
							</div>
						</div>

						<hr class="mt-6 border-2 border-gray-400" />

						<h6 class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase">offer instructions</h6>

						<small>
							<router-link class="text-blue-700 hover:underline" :to="{}">add Items ?</router-link>
						</small>

						<div class="flex flex-wrap">
							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(1, $event)">
										<span>Choose from browsers</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 1">
										<span v-for="(br, i) in filter.browsers" :key="i" @click="choose('browser', br)">{{ br.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.browser_ids" :key="i">
										{{ obj(filter.browsers, id).name }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(2, $event)">
										<span>Choose from countries</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 2">
										<span v-for="(cr, i) in filter.countries" :key="i" @click="choose('country', cr)">{{ cr.details.code }} - {{ cr.details.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.country_ids" :key="i">
										{{ obj(filter.countries, id).details.code }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(3, $event)">
										<span>Choose from devices</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 3">
										<span v-for="(dv, i) in filter.devices" :key="i" @click="choose('device', dv)">{{ dv.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.device_ids" :key="i">
										{{ obj(filter.devices, id).name }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(4, $event)">
										<span>Choose from niches</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 4">
										<span v-for="(nc, i) in filter.niches" :key="i" @click="choose('niche', nc)">{{ nc.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.niche_ids" :key="i">
										{{ obj(filter.niches, id).name }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(5, $event)">
										<span>Choose from oss</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 5">
										<span v-for="(os, i) in filter.oss" :key="i" @click="choose('os', os)">{{ os.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.os_ids" :key="i">
										{{ obj(filter.oss, id).name }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(6, $event)">
										<span>Choose from payout types</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 6">
										<span v-for="(pt, i) in filter.payout_types" :key="i" @click="choose('payout_type', pt)">{{ pt.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.payout_type_ids" :key="i">
										{{ obj(filter.payout_types, id).name }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(7, $event)">
										<span>Choose from promotion methods</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 7">
										<span v-for="(pm, i) in filter.promotion_methods" :key="i" @click="choose('promotion_method', pm)">{{ pm.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.promotion_method_ids" :key="i">
										{{ obj(filter.promotion_methods, id).name }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(8, $event)">
										<span>Choose from verticals</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 8">
										<span v-for="(vt, i) in filter.verticals" :key="i" @click="choose('vertical', vt)">{{ vt.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.vertical_ids" :key="i">
										{{ obj(filter.verticals, id).name }}
									</small>
								</div>
							</div>

							<!--  -->

							<div class="dropDown">
								<div class="relative w-full mb-3">
									<button @click.prevent="toggleDropDown(9, $event)">
										<span>Choose from restrictions</span>
										<i class="fas fa-caret-down"></i>
									</button>
									<div class="dropDown-area" v-if="showDropDown === 9">
										<span v-for="(rs, i) in filter.restrictions" :key="i" @click="choose('restriction', rs)">{{ rs.name }}</span>
									</div>
								</div>
								<div class="dropDown-listing">
									<small v-for="(id, i) in offer.restriction_ids" :key="i">
										{{ obj(filter.restrictions, id).name }}
									</small>
								</div>
							</div>
						</div>

						<div class="flex items-center justify-center mt-3">
							<input @click.prevent="saveOffer" type="submit" class="bg-gray-700 text-gray-100 rounded cursor-pointer p-2 px-6" value="Save changes" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</Admin>
</template>

<script>
	import { mapGetters } from "vuex";

	export default {
		name: "Offer",

		data() {
			return {
				offer: null,

				showDropDown: false,

				lander: null,
			};
		},

		computed: {
			...mapGetters({ filter: "FILTER" }),
		},

		methods: {
			addLander() {
				if (this.lander) {
					this.offer.landing_pages.push(this.lander);
				}
				this.lander = null;
			},

			toggleDropDown(k = 0, e) {
				if (k === this.showDropDown) {
					this.showDropDown = 0;
				} else {
					this.showDropDown = k;
				}
			},

			saveOffer() {},

			choose(txt, item) {
				if (!this.offer[`${txt}_ids`].includes(item._id)) {
					this.offer[`${txt}_ids`].push(item._id);
				}

				this.toggleDropDown();
			},

			obj(list, id) {
				return list.reduce((acc, curr) => {
					if (id === curr._id) {
						return curr;
					}
					return acc;
				}, null);
			},
		},

		mounted() {
			api.get(`/offers/${this.$route.params.id}`).then((resp) => {
				this.offer = resp.data;
			});

			if (!this.filter) {
				this.$store.dispatch("fetchOffersFilter").then(() => {});
			}
		},
	};
</script>

<style scoped>
	.dropDown {
		@apply w-full max-w-md p-2 rounded mb-6 bg-gray-300 m-3 shadow-lg;
	}

	.dropDown button {
		@apply flex justify-between items-center px-3 py-3 mr-3 text-gray-700 bg-white rounded text-sm shadow w-full ease-linear transition-all duration-150;
	}

	.dropDown button:focus {
		@apply outline-none;
	}

	.dropDown-listing {
		@apply p-2 rounded shadow-inner flex flex-wrap items-center justify-start;
	}

	.dropDown-listing small {
		@apply p-1 rounded-full m-1 bg-gray-400 text-gray-700;
	}

	.dropDown-area {
		@apply absolute bg-white w-full border-t-2 rounded max-h-72 overflow-y-scroll z-50;
	}

	.dropDown-area span {
		@apply block p-2 hover:bg-gray-400 cursor-pointer;
	}
</style>
