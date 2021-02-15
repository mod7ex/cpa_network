<template>
	<Admin>
		<template v-slot:title>Offers List</template>

		<div class="p-4">
			<form class="bg-white rounded shadow-lg">
				<h1 class="bg-gray-600 p-3 text-2xl font-black text-gray-100"><i class="fas fa-filter mr-2"></i>Filter Data</h1>
				<div class="p-6">
					<div class="m-3">
						<label for="email">name</label>
						<input type="text" />
					</div>
				</div>
			</form>
		</div>

		<hr class="my-3" />

		<div>
			<div class="px-4">
				<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
					<div class="block w-full overflow-x-auto">
						<table class="items-center w-full bg-transparent border-collapse">
							<thead class="thead-light">
								<tr>
									<th></th>
									<th>Offer Name</th>
									<th>Payout types</th>
									<th>Payouts</th>
									<th>verticals</th>
									<th>countries</th>
								</tr>
							</thead>
							<tbody v-if="offers">
								<tr v-for="i in Idx" :key="i">
									<td>
										<i class="fab fa-buffer text-2xl font-black"></i>
									</td>
									<th>
										<router-link :to="{ name: 'Offer', params: { id: offers[i]._id } }">{{ offers[i].name }}</router-link>
									</th>
									<td>
										<span class="item" v-for="(pt, j) in offers[i].payout_types" :key="j">{{ pt }}</span>
									</td>
									<td>{{ offers[i].payout / 100 }} $</td>
									<td>
										<span class="item" v-for="(v, j) in offers[i].verticals" :key="j">{{ v }}</span>
									</td>
									<td>
										<span class="item" v-for="(c, j) in offers[i].countries" :key="j">{{ c }}</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- paginator -->
		<div v-if="offers">
			<Paginator :arr="offers" @pageChanged="Idx = $event" />
		</div>
	</Admin>
</template>

<script>
	import { mapGetters } from "vuex";
	import Paginator from "@/components/Paginator";

	export default {
		name: "Offers",

		components: {
			Paginator,
		},

		data() {
			return {
				Idx: null,
			};
		},

		computed: {
			...mapGetters({ offers: "OFFERS", filter: "FILTER" }),
		},

		mounted() {
			if (!this.offers) {
				this.$store.dispatch("fetchOffers").then(() => {
					console.log(this.offers);
				});
			}

			if (!this.filter) {
				this.$store.dispatch("fetchOffersFilter").then(() => {
					console.log(this.filter);
				});
			}
		},
	};
</script>

<style scoped>
	thead th {
		@apply px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left;
	}

	tbody td {
		@apply border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4;
	}

	tbody th {
		@apply border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4 text-left text-blue-700 hover:underline;
	}

	.item {
		@apply p-2 bg-gray-400 m-1 rounded-full text-gray-900 font-bold text-xs;
	}
</style>
