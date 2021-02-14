<template>
	<div class="px-2">
		<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
			<div class="rounded-t mb-0 px-4 py-3 border-0">
				<div class="flex flex-wrap items-center">
					<div class="relative w-full px-4 max-w-full flex-grow flex-1"><h3 class="font-semibold text-base text-gray-800">Top marketers</h3></div>
					<div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
						<router-link class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" :to="{ name: 'Users' }">
							See all
						</router-link>
					</div>
				</div>
			</div>
			<div class="block w-full overflow-x-auto">
				<table class="items-center w-full bg-transparent border-collapse">
					<thead class="thead-light">
						<tr>
							<th>Name</th>
							<th>Clicks</th>
							<th>Conversions</th>
							<th>earnings</th>
							<th></th>
						</tr>
					</thead>

					<tbody v-if="users">
						<tr v-for="(u, i) in users" :key="i">
							<th class="text-left">
								<router-link class="text-blue-700 hover:underline" :to="{ name: 'User', params: { id: u.user._id } }">{{ u.user.first_name }} {{ u.user.last_name }}</router-link>
							</th>
							<td>{{ u.clicks }}</td>
							<td>{{ u.conversions }}</td>
							<td>{{ u.today_earnings / 100 }} $</td>
							<td style="min-width: 150px;">
								<div class="flex items-center">
									<span class="mr-2">{{ perf(u).text }}%</span>
									<div class="relative w-full">
										<div class="overflow-hidden h-2 text-xs flex rounded" :class="{ 'bg-green-200': perf(u).bool, 'bg-red-200': !perf(u).bool }">
											<div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center" :class="{ 'bg-green-500': perf(u).bool, 'bg-red-500': !perf(u).bool }" :style="{ width: perf(u).percent + '%' }"></div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters } from "vuex";

	export default {
		name: "TopUsers",

		computed: {
			...mapGetters({ users: "TOP_USERS" }),
		},

		methods: {
			perf({ today_earnings, yesterday_earnings }) {
				if (yesterday_earnings === 0) {
					if (today_earnings === 0) {
						return {
							percent: 0, // for color
							text: 0,
							bool: false,
						};
					}

					return {
						percent: 100, // for color
						text: "+oo",
						bool: true,
					};
				}

				return {
					percent: Math.abs(Math.floor((today_earnings / yesterday_earnings - 1) * 10000) / 100), // for color
					text: Math.floor((today_earnings / yesterday_earnings - 1) * 10000) / 100,
					bool: today_earnings > yesterday_earnings,
				};
			},
		},
	};
</script>

<style scoped>
	thead tr th {
		@apply px-4 bg-gray-100 text-xs text-gray-600 align-middle border border-solid border-gray-200 py-3 uppercase border-l-0 border-r-0 font-semibold text-left;
	}

	tbody th,
	tbody td {
		@apply border-t-0  align-middle border-l-0 border-r-0 p-4 text-xs;
	}
</style>
