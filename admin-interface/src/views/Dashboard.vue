<template>
	<Admin>
		<template v-slot:title>Dashboard</template>

		<div class="stat-block">
			<!-- indicators -->
			<div class="p-1 py-6">
				<div class="flex justify-evenly flex-wrap px-12" v-if="today">
					<!-- indicator -->
					<Indicator :state="perf(clicks, yester_clicks).bool">
						<template v-slot:title>Today Clicks</template>
						<template v-slot:value>{{ clicks }}</template>
						<template v-slot:i>
							<i class="fas fa-chart-bar"></i>
						</template>
						<template v-slot:percentage>
							{{ perf(clicks, yester_clicks).percent }}
						</template>
					</Indicator>

					<!-- indicator -->
					<Indicator :state="perf(conversions, yester_conversions).bool">
						<template v-slot:title>Today Conversions</template>
						<template v-slot:value>{{ conversions }}</template>
						<template v-slot:i>
							<i class="fas fa-calendar-check"></i>
						</template>
						<template v-slot:percentage>
							{{ perf(conversions, yester_conversions).percent }}
						</template>
					</Indicator>

					<!-- indicator -->
					<Indicator :state="perf(earnings, yester_earnings).bool">
						<template v-slot:title>Today Profit</template>
						<template v-slot:value>{{ earnings }} $</template>
						<template v-slot:i>
							<i class="fas fa-search-dollar"></i>
						</template>
						<template v-slot:percentage>
							{{ perf(earnings, yester_earnings).percent }}
						</template>
					</Indicator>

					<!-- indicator -->
					<Indicator :state="false">
						<template v-slot:title>pending users</template>
						<template v-slot:value>13</template>
						<template v-slot:i>
							<i class="fas fa-percent"></i>
						</template>
						<template v-slot:percentage>
							5
						</template>
					</Indicator>
				</div>
			</div>

			<!-- conversions & clicks -->

			<div class="p-1 charts justify-evenly flex flex-wrap lg:flex-nowrap py-8 mb-8">
				<div class="p-2 m-3 rounded bg-gray-900 shadow-lg">
					<TodayChart />
				</div>
				<div class="p-2 m-3 rounded bg-white shadow-lg">
					<TodayPerf />
				</div>
			</div>
		</div>

		<div class="">
			<div class="today-trends flex flex-wrap justify-evenly p-3">
				<div>
					<TopOffers />
				</div>
				<div>
					<TopUsers />
				</div>
			</div>
		</div>
	</Admin>
</template>

<script>
	import Indicator from "../components/dashboard/Indicator";
	import TodayChart from "../components/charts/TodayChart";
	import TodayPerf from "../components/charts/TodayPerformance";
	import TopOffers from "../components/tables/TopOffers";
	import TopUsers from "../components/tables/TopUsers";

	import { mapGetters } from "vuex";

	export default {
		name: "Dashboard",

		components: {
			Indicator,
			TodayChart,
			TodayPerf,
			TopOffers,
			TopUsers,
		},

		computed: {
			...mapGetters({ today: "TODAY", clicks: "TODAY_CLICKS", conversions: "TODAY_CONVERSIONS", earnings: "TODAY_EARNINGS", yester_clicks: "YESTERDAY_CLICKS", yester_conversions: "YESTERDAY_CONVERSIONS", yester_earnings: "YESTERDAY_EARNINGS" }),
		},

		mounted() {
			this.$store.dispatch("fetchTodayStats");
			this.$store.dispatch("fetchTopOffers");
			this.$store.dispatch("fetchTopUsers");
		},

		methods: {
			perf(yesterday, today) {
				if (yesterday === 0) {
					if (today === 0) {
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
					percent: Math.abs(Math.floor((today / yesterday - 1) * 10000) / 100),
					bool: today > yesterday,
				};
			},
		},

		watch: {
			today: function(val, oldVal) {},
		},
	};
</script>

<style scoped>
	.stat-block {
		background: -webkit-gradient(linear, left top, left bottom, color-stop(47%, #059669), color-stop(72%, #ffffff));
		background: -o-linear-gradient(top, #059669 47%, #ffffff 72%);
		background: linear-gradient(to bottom, #059669 47%, #ffffff 72%);
		@apply shadow;
	}

	.charts > div {
		@apply w-full;
	}

	.charts > div:last-of-type {
		max-width: 450px;
		min-height: 600px;
	}

	@screen lg {
		.charts > div:first-of-type {
			max-width: 900px;
		}
	}

	/* trends */

	.today-trends > div {
		max-width: 700px;
		@apply w-full;
	}
</style>
