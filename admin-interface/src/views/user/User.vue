<template>
	<Admin v-if="user">
		<template v-slot:title>User @:{{ user.email }}</template>

		<div id="container" class="p-6 flex items-start justify-center md:justify-evenly flex-wrap md:flex-nowrap">
			<div class="w-full lg:w-8/12 px-4">
				<div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0">
					<div class="rounded-t bg-white mb-0 px-6 py-6">
						<div class="text-center">
							<h6 class="text-gray-800 text-xl font-bold"><i class="fas fa-id-card"></i> User Infos</h6>
						</div>
					</div>

					<div class="flex-auto px-4 lg:px-10 py-10 pt-0">
						<fieldset disabled="disabled">
							<form>
								<!--  -->
								<h6>Contact Information</h6>
								<div class="flex flex-wrap">
									<div class="lg:w-12/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">Title</label>
											<input type="text" v-model="user.contact_infos.title" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">first Name</label>
											<input type="email" v-model="user.contact_infos.first_name" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">last Name</label>
											<input type="email" v-model="user.contact_infos.last_name" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">E-mail Address</label>
											<input type="email" v-model="user.email" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">phone number</label>
											<input type="email" v-model="user.contact_infos.phone_number" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"><i class="fab fa-skype"></i> Skype</label>
											<input type="email" v-model="user.contact_infos.skype" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"><i class="fab fa-telegram-plane"></i> Telegram</label>
											<input type="email" v-model="user.contact_infos.telegram" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">website</label>
											<input type="email" v-model="user.contact_infos.website" />
										</div>
									</div>
								</div>
								<hr />

								<!--  -->
								<h6>Adress</h6>
								<div class="flex flex-wrap">
									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> Country </label>
											<input type="text" v-model="user.country.details.name" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> Postal Code </label>
											<input type="text" v-model="user.contact_infos.zip_code" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">region</label>
											<input type="text" v-model="user.contact_infos.region" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">city</label>
											<input type="text" v-model="user.contact_infos.city" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password">street address</label>
											<input type="text" v-model="user.contact_infos.street_address" />
										</div>
									</div>
								</div>
								<hr />

								<!--  -->
								<h6>Time</h6>
								<div class="flex flex-wrap">
									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> time zone </label>
											<input type="text" v-model="user.timezone.name" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> Best time to call </label>
											<input type="text" v-model="user.contact_infos.best_time_to_call" />
										</div>
									</div>
								</div>
								<hr />

								<!--  -->
								<h6>Billing Details</h6>
								<!-- every payment method should have it's own component -->
								<div class="flex flex-wrap">
									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> chosen payment method </label>
											<input type="text" v-model="user.paymentmethod.name" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> payment method fees ($) </label>
											<input type="text" v-model="user.paymentmethod.fees" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> chosen min payout ($)</label>
											<input type="text" v-model="user.billing_infos.min_payout" />
										</div>
									</div>

									<div class="w-full lg:w-4/12 px-4">
										<div class="relative w-full mb-3">
											<label htmlfor="grid-password"> billing email </label>
											<input type="text" v-model="user.billing_infos.billing_details.email" />
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</div>

			<!--  -->

			<div class="bg-green-100 shadow-xl rounded m-2">
				<div class="w-full h-32 bg-green-300 flex items-center justify-center">
					<h1 class="font-black text-2xl">mourad<span class="text-green-700">CPA</span></h1>
				</div>

				<div class="flex items-center p-4">
					<div class="relative flex flex-col items-center w-full">
						<div class="h-24 w-24 md rounded-full relative flex items-end justify-end text-purple-600 min-w-max absolute -top-16 row-start-1 row-end-3 ring-1 ring-white">
							<img class="h-24 w-24 md rounded-full" src="../../assets/img/team-1-800x8sdfsdf970.jpg" />
						</div>

						<div class="flex flex-col space-y-1 justify-center items-center -mt-12 w-full">
							<div class="flex justify-evenly mb-3">
								<span class="mx-2 text-md whitespace-nowrap text-gray-800 font-semibold">{{ user.contact_infos.first_name }}</span>
								<span class="mx-2 text-md whitespace-nowrap text-gray-600">{{ user.contact_infos.last_name }}</span>
							</div>

							<p class="text-sm text-gray-500 text-center mb-3">
								I can't start my day without a coffee cup
							</p>

							<div class="py-2 flex items-center justify-center flex-wrap">
								<button class="m-1 flex justify-center max-h-max whitespace-nowrap focus:outline-none focus:ring focus:border-blue-300 rounded max-w-max border bg-transparent border-purple-700 text-purple-700 hover:border-purple-800 hover:border-purple-800 px-4 py-1 flex items-center hover:shadow-lg">
									<span class="mr-2"></span>
									Disable Account
									<span class="ml-2"></span>
								</button>

								<button class="m-1 flex justify-center max-h-max whitespace-nowrap focus:outline-none focus:ring focus:border-blue-300 rounded max-w-max text-gray-100 bg-green-500 hover:bg-green-600 px-4 py-1 flex items-center hover:shadow-lg">
									<span class="mr-2"></span>
									<i class="fas fa-chart-bar mr-2"></i>
									Stats
									<span class="ml-2"></span>
								</button>
							</div>

							<div class="py-4 flex flex-wrap justify-center items-center w-full">
								<span class="text-center px-2 mb-3">
									<i class="fas fa-circle" :class="{ 'text-green-700': user.active, 'text-red-700': !user.active }"></i>
								</span>

								<span class="text-center px-2 mb-3">
									<span class="text-gray-600 mr-2">Balance</span>
									<span class="font-bold text-gray-700">{{ user.balance / 100 }} $</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</Admin>
</template>

<script>
	export default {
		name: "User",

		data() {
			return {
				user: null,
			};
		},

		mounted() {
			api.get(`/users/${this.$route.params.id}`).then((resp) => {
				this.user = resp.data;
				console.log(this.user);
			});
		},
	};
</script>

<style scoped>
	form label {
		@apply block uppercase text-gray-700 text-xs font-bold mb-2;
	}

	form input,
	form textarea {
		@apply px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150;
	}

	form hr {
		@apply mt-6 border-b-2 border-gray-400;
	}

	form h6 {
		@apply text-gray-500 text-sm mt-3 mb-6 font-bold uppercase;
	}

	#container {
		background: linear-gradient(to bottom, #f3f4f6 20%, #6ee7b7 58%);
	}
</style>
