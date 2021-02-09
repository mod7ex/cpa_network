<template>
	<Admin>
		<div class="dash-block">
			<div class="flex justify-evenly flex-wrap px-12">
				<!-- indicator -->
				<Indicator :state="false">
					<template v-slot:title>Today Clicks</template>
					<template v-slot:value>12356</template>
					<template v-slot:i>
						<i class="fas fa-chart-bar"></i>
					</template>
					<template v-slot:percentage>
						13
					</template>
				</Indicator>

				<!-- indicator -->
				<Indicator :state="true">
					<template v-slot:title>Today Conversions</template>
					<template v-slot:value>307</template>
					<template v-slot:i>
						<i class="fas fa-users"></i>
					</template>
					<template v-slot:percentage>
						17
					</template>
				</Indicator>

				<!-- indicator -->
				<Indicator :state="true">
					<template v-slot:title>Today Profit</template>
					<template v-slot:value>12356</template>
					<template v-slot:i>
						<i class="fas fa-user"></i>
					</template>
					<template v-slot:percentage>
						3
					</template>
				</Indicator>

				<!-- indicator -->
				<Indicator :state="true">
					<template v-slot:title>PERFORMANCE</template>
					<template v-slot:value>12356</template>
					<template v-slot:i>
						<i class="fas fa-percent"></i>
					</template>
					<template v-slot:percentage>
						5
					</template>
				</Indicator>

				<!-- indicator -->
				<Indicator :state="false">
					<template v-slot:title>pending users</template>
					<template v-slot:value>12356</template>
					<template v-slot:i>
						<i class="fas fa-percent"></i>
					</template>
					<template v-slot:percentage>
						5
					</template>
				</Indicator>
			</div>
		</div>
	</Admin>
</template>

<script>
	import Indicator from "../components/dashboard/Indicator";
	export default {
		name: "Dashboard",

		components: {
			Indicator,
		},
	};
</script>

<style scoped>
	.dash-block {
		@apply bg-green-600 shadow p-1 py-6;
	}
</style>
