<template>
	<div class="p-6">
		<Block title="Chart Filter" :fit="false">
			<form class="mb-6" v-if="filter">
				<div class="filterBlock">
					<div class="filterItem">
						<div class="mr-6">
							<label for="from">from</label>
							<input v-model="chartFilter.from" class="inputField" type="date" id="from" />
						</div>
						<div>
							<label for="from">to</label>
							<input v-model="chartFilter.to" class="inputField" type="date" id="to" />
						</div>
					</div>

					<div class="filterItem">
						<label for="by">filter by</label>
						<select id="by" v-model="chartFilter.by" class="inputField">
							<option value="false">Clicks</option>
							<option value="true">Conversions</option>
						</select>
					</div>

					<div class="filterItem" v-if="filter.verticals.length">
						<label for="filter">Donut chart filter</label>
						<select v-model="chartFilter.filter" class="inputField" id="filter">
							<option selected disabled></option>
							<option value="vertical">by verticals</option>
							<option value="niche">by niches</option>
							<option value="payout_type">by payout types</option>
							<option value="promotion_method">by promotion methods</option>
						</select>
					</div>
				</div>

				<!--  -->
				<div class="filterBlock">
					<div class="filterItem" v-if="filter.countries.length">
						<label for="country">country</label>
						<select v-model="chartFilter.country" class="inputField" id="country">
							<option selected disabled></option>
							<option v-for="(c, i) in filter.countries" :key="i" :value="c._id">{{ c.details.name }}, {{ c.details.code }}</option>
						</select>
					</div>

					<div class="filterItem" v-if="filter.oss.length">
						<label for="os">Os</label>
						<select v-model="chartFilter.os" class="inputField" id="os">
							<option selected disabled></option>
							<option v-for="(os, i) in filter.oss" :key="i" :value="os._id">{{ os.name }}</option>
						</select>
					</div>

					<div class="filterItem" v-if="filter.browsers.length">
						<label for="browser">Browser</label>
						<select v-model="chartFilter.browser" class="inputField" id="browser">
							<option selected disabled></option>
							<option v-for="(br, i) in filter.browsers" :key="i" :value="br._id">{{ br.name }}</option>
						</select>
					</div>

					<div class="filterItem" v-if="filter.devices.length">
						<label for="device">Device</label>
						<select v-model="chartFilter.device" class="inputField" id="device">
							<option selected disabled></option>
							<option v-for="(dv, i) in filter.devices" :key="i" :value="dv._id">{{ dv.name }}</option>
						</select>
					</div>
				</div>
			</form>
			<hr />
			<div class="flex">
				<button @click="chartFilter = {}" class="rounded p-3 bg-gray-700 text-gray-300 mt-6">reset</button>
				<button @click="drawChart" class="rounded p-3 bg-gray-700 text-gray-300 mt-6 ml-auto">Show Chart</button>
			</div>
		</Block>

		<!--  -->
		<Block title="Charts" :fit="false">
			<div class="flex flex-wrap justify-evenly lg:flex-nowrap p-3">
				<StatsChart />
				<DoughnutPieChart />
			</div>
		</Block>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";
	import StatsChart from "../components/charts/StatsChart";
	import DoughnutPieChart from "../components/charts/DoughnutPieChart";
	export default {
		name: "Stats",

		components: {
			StatsChart,
			DoughnutPieChart,
		},

		computed: {
			...mapGetters({ filter: "offersFilter" }),
		},

		data() {
			return {
				chartFilter: {},
			};
		},

		methods: {
			drawChart() {
				this.$store.dispatch("fetchFilteredStats", {
					from: this.chartFilter.from,
					to: this.chartFilter.to,

					by: this.chartFilter.by,

					os: this.chartFilter.o,
					browser: this.chartFilter.browse,
					device: this.chartFilter.devic,
					country: this.chartFilter.country,
				});

				if (this.chartFilter.filter) {
					this.$store.dispatch("fetchDonutStats", {
						from: this.chartFilter.from,
						to: this.chartFilter.to,

						by: this.chartFilter.by,

						filter: this.chartFilter.filter,
					});
				}
			},
		},

		mounted() {
			if (!this.filter) {
				this.$store.dispatch("fetchOffersFilters");
			}
		},
	};
</script>

<style scoped>
	.inputField {
		@apply bg-gray-200 ml-2 p-2 rounded shadow;
	}
	.inputField:hover {
		@apply bg-gray-300;
	}

	.inputField:focus {
		@apply outline-none;
	}

	/* ************** */

	.filterItem {
		@apply flex flex-wrap items-center shadow p-3 m-1;
	}

	.filterBlock {
		@apply flex flex-wrap items-center justify-items-stretch shadow p-1 mb-6;
	}

	label {
		@apply text-gray-800;
	}
	/* @screen md {
		.foo {
			@apply inline-block;
		}
	} */
</style>
