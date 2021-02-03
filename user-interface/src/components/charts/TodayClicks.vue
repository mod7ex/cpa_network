<template>
	<div class="w-full h-full">
		<Block :fit="false" title="Today Clicks Per Hour">
			<canvas id="TodayClicks" class="bg-blue-50 shadow rounded p-2 w-full h-full mx-auto"></canvas>
		</Block>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";
	import Chart from "chart.js";

	export default {
		name: "TodayClicks",

		computed: {
			...mapGetters({ stats: "TODAY_CLICKS" }),
		},

		methods: {
			charDeps() {
				let labels = [],
					data = [],
					now = new Date();

				for (let i = 0; i <= now.getHours(); i++) {
					labels.push(i);
					let count = 0;

					this.stats.forEach((element) => {
						if (element.hour === i) {
							count = element.count;
						}
					});

					data.push(count);
				}

				return {
					labels: labels,
					data: data,
				};
			},

			renderChart() {
				let ctx = document.getElementById("TodayClicks");
				let charDeps = this.charDeps();

				let TodayClicksChart = new Chart(ctx, {
					type: "line",

					data: {
						labels: charDeps.labels,

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
								data: charDeps.data,

								borderColor: "rgb(0, 0, 128)",
								borderWidth: 1,
								backgroundColor: "rgb(0, 0, 255, 0.3)",
							},
						],
					},

					options: {
						title: {
							display: true,
							text: "Today Clicks Per Hour",
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
			stats: function(val, oldVal) {
				this.renderChart();
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
