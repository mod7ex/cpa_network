<template>
	<div class="w-full h-full">
		<Block :fit="false" title="Donut chart">
			<canvas id="doughnutchart" class="bg-blue-50 shadow rounded p-2 w-full h-full mx-auto"></canvas>
		</Block>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";
	import Chart from "chart.js";

	export default {
		name: "DoughnutPieChart",

		computed: {
			...mapGetters({ stats: "DONUT_STATS" }),
		},

		methods: {
			r() {
				return (Math.random() * 256) >> 0;
			},

			bgColors() {
				let backgroundColor = [];
				for (let i = 0; i < this.stats.labels.length; i++) {
					backgroundColor.push(`rgb(${this.r()}, ${this.r()}, ${this.r()})`);
				}
				return backgroundColor;
			},

			renderChart() {
				let bgColor = this.bgColors();

				let ctx = document.getElementById("doughnutchart");
				let TodayClicksChart = new Chart(ctx, {
					type: "doughnut",
					data: {
						// labels: ["windows", "iphone", "sumsung", "indroid", "macOs"],
						labels: this.stats.labels,

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
								// lineTension: 0.3,

								// data: [13, 50, 66, 44, 95],
								data: this.stats.data,

								borderColor: "gray",
								// backgroundColor: ["rgba(red, green, blue, alpha)", "red", "blue", "white", "orange"],
								backgroundColor: bgColor,
								borderWidth: 1,
							},
						],
					},
					options: {
						title: {
							display: true,
							text: "Segments distrubution",
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

			changeChartType() {},
		},

		watch: {
			stats: function(val, oldval) {
				if (val != null) {
					this.renderChart();
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
