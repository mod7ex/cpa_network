<template>
	<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
		<div class="rounded-t mb-0 px-4 py-3 border-0">
			<div class="flex flex-wrap items-center">
				<div class="relative w-full px-4 max-w-full flex-grow flex-1"><h3 class="font-semibold text-base text-gray-800">Top performing offers</h3></div>
				<div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
					<router-link class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" :to="{ name: 'Offers' }">
						See all
					</router-link>
				</div>
			</div>
		</div>
		<div class="block w-full overflow-x-auto">
			<table class="items-center w-full bg-transparent border-collapse">
				<thead>
					<tr>
						<th>offer name</th>
						<th>Clicks</th>
						<th>Conversions</th>
						<th>Profit</th>
						<th>performance</th>
					</tr>
				</thead>

				<tbody v-if="offers">
					<tr v-for="(o, i) in offers" :key="i">
						<th class=" text-left">
							<router-link :to="{ name: 'Offer', params: { id: o.offer._id } }" class="text-blue-700 hover:underline">
								{{ o.offer.name }}
							</router-link>
						</th>
						<td>{{ o.clicks }}</td>
						<td>{{ o.today_conversions }}</td>
						<td>{{ (o.today_conversions * o.offer.payout) / 100 }} $</td>
						<td><i class="fas mr-2" :class="{ 'fa-arrow-up text-green-500': perf(o).bool, 'fa-arrow-down text-red-500': !perf(o).bool }"></i> {{ perf(o).percent }} %</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";

	export default {
		name: "TopOffers",

		computed: {
			...mapGetters({ offers: "TOP_OFFERS" }),
		},

		methods: {
			perf({ today_conversions, yesterday_conversions }) {
				if (yesterday_conversions === 0) {
					if (today_conversions === 0) {
						return {
							percent: 0,
							bool: false,
						};
					}

					return {
						percent: "+oo",
						bool: true,
					};
				}

				return {
					percent: Math.floor((today_conversions / yesterday_conversions - 1) * 10000) / 100,
					bool: today_conversions > yesterday_conversions,
				};
			},
		},
	};
</script>

<style scoped>
	thead tr th {
		@apply px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left;
	}

	tbody th,
	tbody td {
		@apply border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4;
	}
</style>
