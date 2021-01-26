<template>
	<div class="p-4 bg-gray-200 min-h-screen">
		<div class="flex flex-wrap justify-center items-start">
			<TopOffersCard class="flex-grow" />
			<UserCard />
		</div>

		<hr />

		<div class="flex flex-wrap justify-center">
			<TodayClicks class="flex-grow" />
			<TodayConversions class="flex-grow" />
		</div>
	</div>
	<!--  -->
</template>

<script>
	import UserCard from "@/components/UserCard";
	import TopOffersCard from "@/components/TopOffersCard";
	import TodayClicks from "@/components/TodayClicks";
	import TodayConversions from "@/components/TodayConversions";

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
