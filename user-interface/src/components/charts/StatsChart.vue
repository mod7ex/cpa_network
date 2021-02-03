<template>
	<div class="w-full h-full">
		<Block :fit="false" title="Chart data throught the applied filter">
			<button @click="changeChartType" class="bg-blue-50 shadow rounded p-2 w-full h-full mx-auto">Change</button>
			<canvas id="statsChart" class="bg-blue-50 shadow rounded p-2 w-full h-full mx-auto"></canvas>
		</Block>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";
	import Chart from "chart.js";

	export default {
		name: "StatsChart",

		computed: {
			...mapGetters({ stats: "FILTERD_STATS", tools: "STATS_TOOLS" }),
		},

		data() {
			return {
				chartType: 0,
			};
		},

		methods: {
			changeChartType() {
				this.chartType = (this.chartType + 1) % 2;
			},

			step() {
				let a = new Date(this.tools.from);
				let b = new Date(this.tools.to);
				let diff = Math.abs(b - a) / (1000 * 60 * 60 * 24);

				if (diff < 2) {
					return {
						step: 1000 * 60 * 60,
						stepChar: "hour",
					};
				} else if (diff < 60) {
					return {
						step: 1000 * 60 * 60 * 24,
						stepChar: "day",
					};
				} else if (diff < 720) {
					return {
						step: 1000 * 60 * 60 * 24 * 30,
						stepChar: "month",
					};
				} else {
					return {
						step: 1000 * 60 * 60 * 24 * 30 * 12,
						stepChar: "year",
					};
				}
			},

			check(elm, d, stepChar) {
				if (stepChar === "hour") {
					if (elm.hour == d.getHours() && elm.day == d.getDate() && elm.month == d.getMonth() + 1 && elm.year == d.getFullYear()) return true;
				} else if (stepChar === "day") {
					if (elm.day == d.getDate() && elm.month == d.getMonth() + 1 && elm.year == d.getFullYear()) return true;
				} else if (stepChar === "month") {
					if (elm.month == d.getMonth() + 1 && elm.year == d.getFullYear()) return true;
				} else if (stepChar === "year") {
					if (elm.year == d.getFullYear()) return true;
				}

				return false;
			},

			chartDeps() {
				let from = new Date(this.tools.from),
					to = new Date(this.tools.to),
					step = this.step();

				let labels = [],
					data = [],
					x = 0;

				while (x <= to - from) {
					let d = new Date(Date.parse(from) + x),
						acc = 0;

					this.stats.forEach((element) => {
						if (this.check(element, d, step.stepChar)) {
							acc += element.count;
						}
					});

					labels.push(`${d.getDate()}-${d.getMonth() + 1}-${d.getFullYear()}`);
					data.push(acc);

					x += step.step;
				}

				return {
					labels: labels,
					data: data,
					step: step.stepChar,
				};
			},

			renderLineChart() {
				let ctx = document.getElementById("statsChart");
				let chartDeps = this.chartDeps();

				let TodayClicksChart = new Chart(ctx, {
					type: "line",

					data: {
						labels: chartDeps.labels,

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
								data: chartDeps.data,

								borderColor: "rgb(0, 0, 128)",
								borderWidth: 1,
								backgroundColor: "rgb(0, 0, 255, 0.3)",
							},
						],
					},

					options: {
						title: {
							display: true,
							text: `Your clicks per ${chartDeps.step}`,
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
				let chartDeps = this.chartDeps();

				let TodayConversionsChart = new Chart(ctx, {
					type: "bar",

					data: {
						labels: chartDeps.labels,

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
								data: chartDeps.data,

								borderColor: "rgb(0, 128, 0)",
								borderWidth: 1,
								backgroundColor: "rgb(0, 255, 0, 0.3)",
							},
						],
					},

					options: {
						title: {
							display: true,
							text: `Your clicks per ${chartDeps.step}`,
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

			stats: function(val, oldval) {
				this.renderLineChart();
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
