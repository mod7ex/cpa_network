<template>
	<div class="p-4 bg-gray-200 min-h-screen">
		<h1 class="text-center font-black text-4xl text-gray-400 mb-16">Account Infos.</h1>

		<div class="flex items-center flex-wrap bg-gray-800 text-white mb-4">
			<div class="flex-grow p-4 sm:border-r">Affiliate ID: {{ me._id }}</div>
			<div class="flex-grow p-4">{{ me.email }}</div>
		</div>

		<div class="bg-white shadow rounded">
			<nav class="flex flex-wrap">
				<button @click="selectedNum = 0" :class="{ 'border-gray-700 shadow-inner': selectedNum === 0 }" class="focus:outline-none flex-grow border-b-8 p-8">User Details</button>
				<button @click="selectedNum = 1" :class="{ 'border-gray-700 shadow-inner': selectedNum === 1 }" class="focus:outline-none flex-grow border-b-8">Billing Details</button>
				<button @click="selectedNum = 2" :class="{ 'border-gray-700 shadow-inner': selectedNum === 2 }" class="focus:outline-none flex-grow border-b-8 p-8">Notifications</button>
			</nav>

			<div class="">
				<div v-if="selectedNum === 0" class="">
					<EditInfoForm />
				</div>

				<div v-if="selectedNum === 1" class="">
					<EditBillingInfoForm />
				</div>

				<div v-if="selectedNum === 2" class=""></div>
			</div>
		</div>
	</div>
</template>

<script>
	import { ref } from "vue";
	import { mapGetters } from "vuex";
	import EditInfoForm from "@/components/AccountInfo/EditInfoForm";
	import EditBillingInfoForm from "@/components/AccountInfo/EditBillingInfoForm";

	export default {
		name: "AccountInfo",

		computed: {
			...mapGetters({ me: "ME" }),
		},

		components: {
			EditInfoForm,
			EditBillingInfoForm,
		},

		setup() {
			let selectedNum = ref(0);

			return {
				selectedNum,
			};
		},
	};
</script>

<style></style>
