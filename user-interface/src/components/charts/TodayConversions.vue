<template>
	<div class="h-full w-full">
		<Block :fit="false" title="Today Conversions Per Hour">
			<canvas id="TodayConversions" class="bg-blue-50 shadow rounded p-2 w-full h-full"></canvas>
		</Block>
	</div>
</template>

<script>
	import Chart from "chart.js";

	export default {
		name: "TodayConversions",

		methods: {
			renderChart() {
				let ctx = document.getElementById("TodayConversions");

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

		mounted() {
			this.renderChart();
		},
	};
</script>

<style scoped>
	div {
		max-height: 700px;
		max-width: 700px;
	}
</style>
