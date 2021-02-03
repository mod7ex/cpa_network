<template>
	<div class="h-full w-full">
		<Block :fit="false" title="Today Conversions Per Hour">
			<canvas id="TodayConversions" class="bg-blue-50 shadow rounded p-2 w-full h-full"></canvas>
		</Block>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";
	import Chart from "chart.js";

	export default {
		name: "TodayConversions",

		computed: {
			...mapGetters({ stats: "TODAY_CONVERSIONS" }),
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
				let ctx = document.getElementById("TodayConversions");
				let charDeps = this.charDeps();

				let TodayConversionsChart = new Chart(ctx, {
					type: "bar",

					data: {
						labels: charDeps.labels,

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
								data: charDeps.data,

								borderColor: "rgb(0, 128, 0)",
								borderWidth: 1,
								backgroundColor: "rgb(0, 255, 0, 0.3)",
							},
						],
					},

					options: {
						title: {
							display: true,
							text: "Today Conversions Per Hour",
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
