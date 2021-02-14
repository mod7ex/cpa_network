<template>
	<canvas id="TodayChart"></canvas>
</template>

<script>
	import { mapGetters } from "vuex";
	import Chart from "chart.js";

	export default {
		name: "TodayChart",

		computed: {
			...mapGetters({ today: "TODAY" }),
		},

		methods: {
			charDeps() {
				let labels = [],
					clicks_data = [],
					conversions_data = [],
					now = new Date();

				for (let i = 0; i <= now.getHours(); i++) {
					labels.push(i);

					let conv_count = 0;
					let clicks_count = 0;

					this.today.today.forEach((element) => {
						if (element.hour === i) {
							clicks_count += element.count;
						}

						if (element.hour === i && element.converted) {
							conv_count += element.count;
						}
					});

					clicks_data.push(clicks_count);
					conversions_data.push(conv_count);
				}

				return {
					labels,
					clicks_data,
					conversions_data,
				};
			},

			renderChart() {
				let ctx = document.getElementById("TodayChart");
				let charDeps = this.charDeps();

				let TodayClicksChart = new Chart(ctx, {
					type: "line",
					data: {
						labels: charDeps.labels,
						// labels: ["a", "b", "c", "d", "e", "f", "g"],
						datasets: [
							{
								label: "Conversions",
								fill: true,
								lineTension: 0.3,
								data: charDeps.conversions_data,
								// data: [12, 21, 63, 7, 65, 8, 13],
								borderColor: "rgb(0, 0, 128)",
								borderWidth: 1,
								backgroundColor: "rgba(255, 0, 0, 0.9)",
							},

							{
								label: "clicks",
								fill: true,
								lineTension: 0.3,
								data: charDeps.clicks_data,
								// data: [33, 30, 59, 7, 8, 25, 13],
								borderColor: "rgb(0, 0, 128)",
								borderWidth: 1,
								backgroundColor: "#39FF14",
							},
						],
					},
					options: {
						title: {
							display: true,
							text: "Today actions Per Hour",
						},
						responsive: true,
						maintainAspectRatio: false,
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
			today: function(val, oldVal) {
				this.renderChart();
			},
		},
	};
</script>
