<template>
	<form v-if="paymentMethodOptions.length" class="bg-white mt-10 mx-auto p-6 shadow-md rounded text-gray-700">
		<div v-if="message.details" class="mb-10 px-5 py-3 rounded font-bold text-black" :class="{ 'bg-red-400': !message.status, 'bg-green-600': message.status }">
			<h1>{{ message.details }}</h1>
		</div>

		<div class="mb-10">
			<label for="payout_method_id" class="py-8">Choose Payment Method</label>
			<select id="payout_method_id" v-model="billingInfoForm.payout_method_id.val" @change="choosePM" class="min-w-full px-2 py-2 shadow-md outline-none border rounded bg-white">
				<option selected disabled>Choose ...</option>

				<option v-for="(pm, i) in paymentMethodOptions" :key="i" :value="pm._id">
					{{ pm.name }} <small>fees: ({{ pm.fees }} $)</small>
				</option>
			</select>
		</div>

		<div v-if="min_payouts.length || billingInfoForm.min_payout.val" class="py-8 mb-10">
			<label for="min_payout" class="">Choose Minmum Payout</label>
			<select id="min_payout" v-model="billingInfoForm.min_payout.val" class="min-w-full px-2 py-2 shadow-md outline-none border rounded bg-white">
				<option selected disabled>Choose ...</option>

				<option v-for="mp in min_payouts" :key="mp" :value="mp"> {{ mp }} $ </option>
			</select>
		</div>

		<div class="mb-10" v-if="billingInfoForm.payout_method_id.val === '60107d6a4dcc881c7547bd3e'">
			<label for="email" class="py-4">Paypal E-mail</label>
			<input v-model.trim="billingInfoForm.email.val" type="text" id="email" :class="{ 'bg-red-100': !billingInfoForm.email.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="paypal email" />
			<small class="text-red-400" v-for="(err, index) in billingInfoForm.email.errors" :key="index">{{ err }}, </small>
		</div>

		<div class="mb-10" v-if="billingInfoForm.payout_method_id.val === '60107d6a4dcc881c7547bd3f'">
			<label for="email" class="py-4">Paxum E-mail</label>
			<input v-model.trim="billingInfoForm.email.val" type="text" id="email" :class="{ 'bg-red-100': !billingInfoForm.email.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="paxum email" />
			<small class="text-red-400" v-for="(err, index) in billingInfoForm.email.errors" :key="index">{{ err }}, </small>
		</div>

		<div class="mb-10" v-if="billingInfoForm.email.val">
			<input type="submit" @click.prevent="formIsValid" class="min-w-full text-white cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-900 rounded" value="Sign Up" />
		</div>
	</form>
</template>

<script>
	import { ref } from "vue";
	import { useStore } from "vuex";
	import Field from "@/utilities/validation";

	export default {
		name: "EditBillingInfoForm",

		setup() {
			const store = useStore();

			let billing_infos = store.getters.ME.billing_infos;

			let billingInfoForm = ref({
				payout_method_id: new Field("payout_method_id"),
				min_payout: new Field("min_payout"),

				// for paypal & paxum
				email: new Field("email"),

				// for wire transfer
			});

			if (billing_infos) {
				billingInfoForm.value.payout_method_id.val = billing_infos.payment_method_id;
				billingInfoForm.value.min_payout.val = billing_infos.min_payout;
				billingInfoForm.value.email.val = billing_infos.billing_details.email;
			}

			let paymentMethodOptions = ref([]);
			let fetchPaymentMethods = () => {
				api.get(`/paymentmethods`)
					.then((resp) => {
						paymentMethodOptions.value = resp.data;
					})
					.then(() => {
						if (billing_infos) {
							min_payouts.value = paymentMethodOptions.value.find((elm) => {
								return elm._id === billingInfoForm.value.payout_method_id.val;
							}).min_payout;
						}
					})
					.catch((err) => {
						console.log(err);
					});
			};

			let min_payouts = ref([]);
			let choosePM = () => {
				console.log(paymentMethodOptions.value);
				min_payouts.value = paymentMethodOptions.value.find((elm) => {
					return elm._id === billingInfoForm.value.payout_method_id.val;
				}).min_payout;

				billingInfoForm.value.email.val = null;
				// here you reset any other billing details
			};

			let message = ref({
				details: null,
				status: null,
			});

			let formIsValid = () => {
				for (let key in billingInfoForm.value) {
					billingInfoForm.value[key].reset();
				}

				/* billingInfoForm.value.payout_method_id.require('payment method is required')
        billingInfoForm.value.min_payout.require('minimum payout is required')
        billingInfoForm.value.email.require('email is required') */

				for (let key in billingInfoForm.value) {
					if (!billingInfoForm.value[key].is_valid) {
						return;
					}
				}

				let billing_details = {};
				if (billingInfoForm.value.email.val != null) {
					billing_details.email = billingInfoForm.value.email.val;
				}
				// here you add details

				api.post(`/users/${"userid"}`, {
					payout_method_id: billingInfoForm.value.payout_method_id.val,
					min_payout: billingInfoForm.value.min_payout.val,
					billing_details: billing_details,
				})
					.then((resp) => {
						message.value = {
							details: "data saved with success",
							status: true,
						};
					})
					.catch((err) => {
						console.log(err);
					});
			};

			return {
				billingInfoForm,
				paymentMethodOptions,
				fetchPaymentMethods,
				min_payouts,
				choosePM,
				message,
				formIsValid,
			};
		},

		mounted() {
			this.fetchPaymentMethods();
		},
	};
</script>

<style></style>
