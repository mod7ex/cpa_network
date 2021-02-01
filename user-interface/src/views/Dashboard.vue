<template>
	<div class="p-4 bg-gray-200 min-h-screen">
		<Block :fit="false">
			<div class="flex flex-wrap lg:flex-nowrap justify-evenly">
				<TopOffersCard />
				<UserCard />
			</div>
		</Block>

		<hr />

		<div class="flex flex-wrap lg:flex-nowrap justify-evenly items-start lg:p-5">
			<TodayClicks />
			<TodayConversions />
		</div>
	</div>
	<!--  -->
</template>

<script>
	import UserCard from "@/components/UserCard";
	import TopOffersCard from "@/components/TopOffersCard";
	import TodayClicks from "@/components/charts/TodayClicks";
	import TodayConversions from "@/components/charts/TodayConversions";

	export default {
		name: "Dashboard",

		components: {
			UserCard,
			TopOffersCard,
			TodayClicks,
			TodayConversions,
		},

		data() {
			return {};
		},
	};
</script>

<style scoped></style>
