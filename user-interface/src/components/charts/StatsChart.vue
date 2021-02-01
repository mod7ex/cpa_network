<template>
	<div class="w-full h-full">
		<Block :fit="false" title="Chart data throught the applied filter">
			<button @click="changeChartType" class="bg-blue-50 shadow rounded p-2 w-full h-full mx-auto">Change</button>
			<canvas id="statsChart" class="bg-blue-50 shadow rounded p-2 w-full h-full mx-auto"></canvas>
		</Block>
	</div>
</template>

<script>
	import Chart from "chart.js";

	export default {
		name: "StatsChart",

		data() {
			return {
				chartType: 0,
			};
		},

		methods: {
			changeChartType() {
				this.chartType = (this.chartType + 1) % 2;
			},

			renderLineChart() {
				let ctx = document.getElementById("statsChart");

				let TodayClicksChart = new Chart(ctx, {
					type: "line",

					data: {
						labels: ["me", "him", "we", "dfgse", "wdgsetg", "dfgsedg", "dsfgsethe"],

						datasets: [
							{
								label: "clicks",
								// borderCapStyle: 'ffffffffffffffff',
								// borderDashOffset: 20,
								// pointBackgroundColor: 'red',
								fill: true,
								// order: 1,
								// steppedLine: true,
								// showLine: false,
								// spanGaps: true,
								lineTension: 0.3,
								data: [13, 50, 66, 44, 95, 70, 100, 52, 22],

								borderColor: "rgb(0, 0, 128)",
								borderWidth: 1,
								backgroundColor: "rgb(0, 0, 255, 0.3)",
							},
						],
					},

					options: {
						title: {
							display: true,
							text: "Your Clicks Per Hour",
						},

						responsive: true,

						scales: {
							yAxes: [
								{
									stacked: true,
								},
							],
						},
					},
				});
			},

			renderBarChart() {
				let ctx = document.getElementById("statsChart");

				let TodayConversionsChart = new Chart(ctx, {
					type: "bar",

					data: {
						labels: ["me", "him", "we", "dfgse", "wdgsetg", "dfgsedg", "dsfgsethe"],

						datasets: [
							{
								label: "conversions",
								// borderCapStyle: 'ffffffffffffffff',
								// borderDashOffset: 20,
								// pointBackgroundColor: 'red',
								fill: false,
								// order: 1,
								// steppedLine: true,
								// showLine: false,
								// spanGaps: true,
								data: [13, 50, 66, 44, 95, 70, 100, 52, 22],

								borderColor: "rgb(0, 128, 0)",
								borderWidth: 1,
								backgroundColor: "rgb(0, 255, 0, 0.3)",
							},
						],
					},

					options: {
						title: {
							display: true,
							text: "Your Conversions Per Hour",
						},

						responsive: true,

						scales: {
							yAxes: [
								{
									stacked: true,
								},
							],
						},
					},
				});
			},
		},

		mounted() {
			this.renderLineChart();
		},

		watch: {
			chartType: function(val, oldval) {
				let canvas = document.getElementById("statsChart");
				let context = canvas.getContext("2d");
				context.clearRect(0, 0, canvas.width, canvas.height);

				if (val === 0) {
					this.renderLineChart();
				} else if (val === 1) {
					this.renderBarChart();
				}
			},
		},
	};
</script>

<style scoped>
	div {
		max-height: 700px;
		max-width: 700px;
	}
</style>
