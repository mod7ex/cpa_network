<template>
	<canvas id="TodayPerf"></canvas>
</template>

<script>
	import { mapGetters } from "vuex";
	import Chart from "chart.js";

	export default {
		name: "TodayPerf",

		computed: {
			...mapGetters({ today: "TODAY", clicks: "TODAY_CLICKS", conversions: "TODAY_CONVERSIONS", earnings: "TODAY_EARNINGS", yester_clicks: "YESTERDAY_CLICKS", yester_conversions: "YESTERDAY_CONVERSIONS", yester_earnings: "YESTERDAY_EARNINGS" }),
		},

		methods: {
			renderBarChart() {
				let ctx = document.getElementById("TodayPerf");

				let data = {
					today: [this.clicks, this.conversions, this.earnings / 100],
					yesterday: [this.yester_clicks, this.yester_conversions, this.yester_earnings / 100],
				};

				let TodayConversionsChart = new Chart(ctx, {
					type: "bar",
					data: {
						labels: ["clicks", "conversions", "profit($)"],
						datasets: [
							{
								label: "Today",
								data: data.today,
								fill: !1,
								borderColor: "rgb(0, 128, 0)",
								borderWidth: 1,
								barPercentage: 1,
								backgroundColor: "#1E4ED8",
								barThickness: 20,
							},

							{
								label: "Yesterday",
								data: data.yesterday,
								fill: !1,
								borderColor: "rgb(0, 128, 0)",
								borderWidth: 1,
								barPercentage: 1,
								backgroundColor: "#39FF14",
								barThickness: 20,
							},
						],
					},

					options: {
						title: {
							display: true,
							text: "Today Performance/yesterday",
						},
						maintainAspectRatio: !1,
						responsive: true,

						tooltips: {
							mode: "index",
							intersect: !1,
						},
						hover: {
							mode: "nearest",
							intersect: !0,
						},

						scales: {
							xAxes: [
								{
									display: !1,
									scaleLabel: {
										display: !0,
										labelString: "Month",
									},
									gridLines: {
										borderDash: [2],
										borderDashOffset: [2],
										color: "rgba(33, 37, 41, 0.3)",
										zeroLineColor: "rgba(33, 37, 41, 0.3)",
										zeroLineBorderDash: [2],
										zeroLineBorderDashOffset: [2],
									},
								},
							],
							yAxes: [
								{
									display: !0,
									scaleLabel: {
										display: !1,
										labelString: "Value",
									},
									gridLines: {
										borderDash: [2],
										drawBorder: !1,
										borderDashOffset: [2],
										color: "rgba(33, 37, 41, 0.2)",
										zeroLineColor: "rgba(33, 37, 41, 0.15)",
										zeroLineBorderDash: [2],
										zeroLineBorderDashOffset: [2],
									},
								},
							],
						},
					},
				});
			},
		},

		watch: {
			today: function(val, oldval) {
				this.renderBarChart();
			},
		},
	};
</script>

<style scoped>
	#TodayPerf {
		max-width: 400px;
		min-height: 600px;
	}
</style>
