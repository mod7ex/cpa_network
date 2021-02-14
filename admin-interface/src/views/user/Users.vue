<template>
	<Admin>
		<template v-slot:title>Users List</template>

		<div class="p-4">
			<form class="bg-white rounded shadow-lg">
				<h1 class="bg-gray-600 p-3 text-2xl font-black text-gray-100"><i class="fas fa-filter mr-2"></i>Filter Data</h1>
				<div class="p-6">
					<div class="m-3">
						<label for="email">E-mail</label>
						<input type="text" />
					</div>
				</div>
			</form>
		</div>

		<hr class="my-3" />

		<div>
			<div class="px-4">
				<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
					<div class="block w-full overflow-x-auto">
						<table class="items-center w-full bg-transparent border-collapse">
							<thead class="thead-light">
								<tr>
									<th></th>
									<th>Name</th>
									<th>E-mail</th>
									<th>actif</th>
									<th>Country</th>
									<th>Balance</th>
									<th class="min-w-140-px"></th>
								</tr>
							</thead>
							<tbody v-if="users">
								<tr v-for="i in Idx">
									<th>
										<i class="fas fa-user-circle font-black text-2xl"></i>
									</th>
									<th>
										<router-link class="text-blue-700 hover:underline" :to="{ name: 'User', params: { id: users[i]._id } }">{{ users[i].name }}</router-link>
									</th>
									<td>
										{{ users[i].email }}
									</td>
									<td>
										<i class="fas fa-circle font-black text-xl" :class="{ 'text-green-700': users[i].active, 'text-red-700': !users[i].active }"></i>
									</td>
									<td>{{ users[i].country }}</td>
									<td>{{ users[i].balance / 100 }} $</td>
									<td>
										<div class="flex items-center">
											<span class="mr-2">60%</span>
											<div class="relative w-full">
												<div class="overflow-hidden h-2 text-xs flex rounded bg-red-200">
													<div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500" style="width: 60%;"></div>
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
		</div>

		<!-- paginator -->
		<div v-if="users">
			<Paginator :arr="users" @pageChanged="Idx = $event" />
		</div>
	</Admin>
</template>

<script>
	import { mapGetters } from "vuex";
	import Paginator from "@/components/Paginator";

	export default {
		name: "Users",

		components: {
			Paginator,
		},

		data() {
			return {
				Idx: null,
			};
		},

		computed: {
			...mapGetters({ users: "USERS" }),
		},

		mounted() {
			this.$store.dispatch("fetchUsers");
		},
	};
</script>

<style scoped>
	thead th {
		@apply px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left;
	}

	tbody td {
		@apply border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4;
	}

	tbody th {
		@apply border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4 text-left;
	}
</style>
