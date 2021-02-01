<template>
	<div class="p-3" v-if="offer && filter">
		<div class="bg-white shadow-md mb-6">
			<div class="bg-gray-700 text-gray-300 rounded-t p-4 flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1 6h2v8h-2v-8zm1 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" /></svg>
				<h1 class="ml-3 font-black text-2xl">Offer Details</h1>
				<ToggleBtn />
			</div>
			<div class="p-2">
				<div class="text-gray-700 shadow border p-">
					<ul class="flex items-start flex-wrap">
						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black">
								Offer name: <span class="font-medium">{{ offer.name }}</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black">
								Offer payout: <span class="font-medium">{{ offer.payout / 100 }}$</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black">
								Allowed Countries:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1" v-for="(id, i) in offer.country_ids" :key="i">
									{{ bindProps("countries", id).details.name }}
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black flex flex-wrap items-center">
								Restrictions:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.restriction_ids" :key="i">
									<svg class="fill-current text-red-700 mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 1l6-1-4 8 8-2-7.395 13.903 2.395.097-5 4-1-6 1.955 1.379 2.045-7.379-9 3z" /></svg>
									<small>{{ bindProps("restrictions", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black flex flex-wrap items-center">
								Browsers:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.browser_ids" :key="i">
									<small>{{ bindProps("browsers", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700" v-if="offer.niche_ids.length">
							<h2 class="font-black flex flex-wrap items-center">
								Niches:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.niche_ids" :key="i">
									<small>{{ bindProps("niches", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black flex flex-wrap items-center">
								Devices:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.device_ids" :key="i">
									<small>{{ bindProps("devices", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black flex flex-wrap items-center">
								Os:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.os_ids" :key="i">
									<small>{{ bindProps("oss", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black flex flex-wrap items-center">
								Payout type:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.payout_type_ids" :key="i">
									<small>{{ bindProps("payout_types", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black flex flex-wrap items-center">
								Promotion methods:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.promotion_method_ids" :key="i">
									<small>{{ bindProps("promotion_methods", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<h2 class="font-black flex flex-wrap items-center">
								Verticals:
								<span class="font-medium bg-gray-300 rounded-full p-1 m-1 flex items-center" v-for="(id, i) in offer.vertical_ids" :key="i">
									<small>{{ bindProps("verticals", id).name }}</small>
								</span>
							</h2>
						</li>

						<li class="border-l-4 rounded-l shadow m-3 p-3 border-gray-700">
							<p class="font-medium max-w-full">
								<span class="font-black">Offer description:</span>
								{{ offer.description }}
							</p>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="bg-white shadow-md md:m-3 mb-6">
			<div class="bg-gray-700 text-gray-300 rounded-t p-4 flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1 6h2v8h-2v-8zm1 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" /></svg>
				<h1 class="ml-3 font-black text-2xl">Landers and links</h1>
				<ToggleBtn />
			</div>
			<div class="p-4 flex justify-between">
				<div class="flex-grow m-3">
					<h1 class="bg-gray-800 p-4 font-black text-xl rounded-t text-gray-300">Landers (Promotion Links)</h1>
					<div class="p-3 shadow" v-if="offer.landing_pages">
						<label v-for="(lk, i) in offer.landing_pages" :key="i" :for="`lander-${i}`" class="tooltip relative flex mb-3 p-3 rounded items-center bg-blue-100 font-bold">
							<input disabled type="text" :id="`lander-${i}`" :value="lk + '?aff=' + me._id" class="flex-grow mr-2 p-3" />
							<!--  -->
							<span class="tooltip-text bg-blue-200 p-3 rounded absolute font-light shadow-xl right-10 top-0">Click to copy</span>
							<!--  -->
							<svg @click="copyLanderUrl(lk, i)" class="tooltip ml-auto cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
								<path d="M15.143 13.244l.837-2.244 2.698 5.641-5.678 2.502.805-2.23s-8.055-3.538-7.708-10.913c2.715 5.938 9.046 7.244 9.046 7.244zm8.857-7.244v18h-18v-6h-6v-18h18v6h6zm-2 2h-12.112c-.562-.578-1.08-1.243-1.521-2h7.633v-4h-14v14h4v-3.124c.6.961 1.287 1.823 2 2.576v6.548h14v-14z" />
							</svg>
						</label>
					</div>

					<!-- in case the offer is private or pending request -->
					<div class="p-3 shadow" v-if="!offer.landing_pages">
						<span class="flex p-3 mb-3 text-white rounded bg-blue-900 font-bold">
							<span>Status goes here</span>
						</span>
					</div>
				</div>

				<div class="relative bg-green-800 m-3">
					<ul id="gallery" class="flex items-center">
						<li v-if="k + 1 === 1">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-1.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-2.jpg" v-if="k + 1 === 2">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-2.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-3.jpg" v-if="k + 1 === 3">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-3.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-4.jpg" v-if="k + 1 === 4">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-4.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-5.jpg" v-if="k + 1 === 5">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-5.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-6.jpg" v-if="k + 1 === 6">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-6.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-7.jpg" v-if="k + 1 === 7">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-7.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-8.jpg" v-if="k + 1 === 8">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-8.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-9.jpg" v-if="k + 1 === 9">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-9.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-10.jpg" v-if="k + 1 === 10">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-10.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-11.jpg" v-if="k + 1 === 11">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-12.jpg" />
						</li>

						<li data-thumb="https://sachinchoolur.github.io/lightslider/img/thumb/cS-13.jpg" v-if="k + 1 === 12">
							<img src="https://sachinchoolur.github.io/lightslider/img/cS-13.jpg" />
						</li>
					</ul>
					<span class="absolute min-w-full flex justify-between top-2/4 px-4">
						<button @click="changeImg(false)" class="text-black rounded-full p-1 border-2 focus:outline-none border-white">
							<svg class="w-7 h-w-7 svg-icon" viewBox="0 0 20 20">
								<path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
							</svg>
						</button>

						<button @click="changeImg(true)" class="text-black rounded-full p-1 border-2 focus:outline-none border-white">
							<svg class="w-7 h-w-7 svg-icon" viewBox="0 0 20 20">
								<path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
							</svg>
						</button>
					</span>
				</div>
			</div>
		</div>

		<!-- <div class="bg-white shadow-md md:m-3 mb-6">
			<div class="bg-gray-700 text-gray-300 rounded-t p-4 flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1 6h2v8h-2v-8zm1 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" /></svg>
				<h1 class="ml-3 font-black text-2xl">Title goes here</h1>
				<ToggleBtn />
			</div>
			<div class="p-4">
				Content goes here
			</div>
		</div> -->
	</div>
</template>

<script>
	import ToggleBtn from "../../components/atomic/ToggleBtn";
	import { mapGetters } from "vuex";
	export default {
		name: "OfferDetails",

		components: { ToggleBtn },

		computed: {
			...mapGetters({ filter: "offersFilter", me: "ME" }),
		},

		data() {
			return {
				offer: null,

				toolTip: {
					msg: "CLick to copy",
					show: false,
				},

				k: 0,
				n: 12,
			};
		},

		methods: {
			handleToolTip(msg, i) {
				document.querySelector(`#lander-${i} + .tooltip-text`).innerText = msg;
				document.querySelector(`#lander-${i} + .tooltip-text`).style.visibility = "visible";
				setTimeout(() => {
					document.querySelector(`#lander-${i} + .tooltip-text`).innerText = "Click to copy";
					document.querySelector(`#lander-${i} + .tooltip-text`).style.visibility = "hidden";
				}, 1500);
			},

			retreiveOffer() {
				api.defaults.headers.common["Authorization"] = `Bearer ${this.$store.getters.ACCESS_TOKEN}`;
				api.get(`offers/${this.$route.params.id}`)
					.then((resp) => {
						this.offer = resp.data;
						console.log(this.offer);
					})
					.catch((err) => {
						console.log(err);
					});
			},

			changeImg(bool) {
				if (bool) {
					this.k = ++this.k % this.n;
				} else {
					this.k = (--this.k + this.n) % this.n;
				}
			},

			bindProps(prop, id) {
				return this.filter[prop].reduce((acc, curr) => {
					return curr._id === id ? curr : acc;
				});
			},

			copyLanderUrl(link, i) {
				navigator.clipboard.writeText(link).then(
					() => {
						this.handleToolTip("Copying to clipboard was successful!", i);
					},
					(err) => {
						this.handleToolTip("Could not copy text: " + err.message(), i);
					}
				);
			},
		},

		mounted() {
			this.retreiveOffer();
			console.log(this.filter);
		},

		watch: {
			offer: function() {
				document.title = `Offer ${this.offer.name} details`;
			},
		},
	};
</script>

<style scoped>
	.tooltip .tooltip-text {
		visibility: hidden;
		z-index: 100;
	}
	.tooltip:hover .tooltip-text {
		visibility: visible;
	}

	ul li p {
		max-width: 450px;
	}
</style>
