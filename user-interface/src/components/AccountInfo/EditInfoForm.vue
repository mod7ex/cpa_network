<template>
	<form class="bg-white mt-10 mx-auto p-6 shadow-md rounded text-gray-700">
		<div v-if="message.details" class="mb-10 px-5 py-3 rounded font-bold text-black" :class="{ 'bg-red-400': !message.status, 'bg-green-600': message.status }">
			<h1>{{ message.details }}</h1>
		</div>
		<!--  -->

		<div class="flex items-start flex-wrap justify-center">
			<div class="flex-grow p-4 formSection">
				<div class="mb-10">
					<label for="title" class="py-4">Title</label>
					<select id="title" v-model="updateInfoForm.title.val" :class="{ 'bg-red-100': !updateInfoForm.title.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded bg-white">
						<option selected disabled>Choose Title</option>
						<option :selected="updateInfoForm.title.val === 'Mr'" value="Mr">Mr</option>
						<option :selected="updateInfoForm.title.val === 'Mrs'" value="Mrs">Mrs</option>
						<option :selected="updateInfoForm.title.val === 'Mss'" value="Mss">Mss</option>
					</select>
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.title.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10">
					<label for="first_name" class="py-4">First Name</label>
					<input v-model.trim="updateInfoForm.first_name.val" type="text" id="first_name" :class="{ 'bg-red-100': !updateInfoForm.first_name.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="first name" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.first_name.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10">
					<label for="first_name" class="py-4">Last Name</label>
					<input v-model.trim="updateInfoForm.last_name.val" type="text" id="last_name" :class="{ 'bg-red-100': !updateInfoForm.last_name.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="last name" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.last_name.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="p-2 shadow rounded my-4 bg-gray-300">
					<div class="mb-10">
						<label for="old_password" class="py-4">Old Password</label>
						<input v-model="updateInfoForm.old_password.val" type="password" id="old_password" :class="{ 'bg-red-100': !updateInfoForm.old_password.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Strong Password" />
						<small class="text-red-400" v-for="(err, index) in updateInfoForm.old_password.errors" :key="index">{{ err }}, </small>
					</div>

					<div class="mb-10">
						<label for="password" class="py-4">Password</label>
						<input v-model="updateInfoForm.password.val" type="password" id="password" :class="{ 'bg-red-100': !updateInfoForm.password.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Strong Password" />
						<small class="text-red-400" v-for="(err, index) in updateInfoForm.password.errors" :key="index">{{ err }}, </small>
					</div>

					<div class="mb-10">
						<label for="password_confirmation" class="py-4">Confirm Password</label>
						<input v-model="updateInfoForm.password_confirmation.val" type="password" id="password_confirmation" :class="{ 'bg-red-100': !updateInfoForm.password_confirmation.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Password Confirmation" />
						<small class="text-red-400" v-for="(err, index) in updateInfoForm.password_confirmation.errors" :key="index">{{ err }}, </small>
					</div>
				</div>
			</div>

			<div class="flex-grow p-4 formSection">
				<div class="mb-10">
					<label for="website" class="py-4">Website (optional)</label>
					<input v-model.trim="updateInfoForm.website.val" type="text" id="website" :class="{ 'bg-red-100': !updateInfoForm.website.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="web site" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.website.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10 relative z-50">
					<label for="country" class="py-4">Country</label>
					<input type="text" id="country" @input="fetchCountries" v-model.trim="country.name" :class="{ 'bg-red-100': !updateInfoForm.country_id.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" autocomplete="off" placeholder="country" />
					<div v-if="country.list.length" class="absolute bg-gray-200 min-w-full mt-1 overflow-scroll">
						<span v-for="(c, i) in country.list" :key="i" @click="chooseCountry(c)" class="hover:bg-gray-400 cursor-pointer block px-3 py-2">{{ c.details.name }}, {{ c.details.code }}</span>
					</div>
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.country_id.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10 relative z-40">
					<label for="timezone" class="py-4">Time zone</label>
					<input type="text" id="timezone" @focus="fetchTz" @input="fetchTz" v-model.trim="timezone.name" :class="{ 'bg-red-100': !updateInfoForm.timezone_id.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" autocomplete="off" placeholder="Time zone" />

					<div v-if="timezone.visible" class="absolute bg-gray-200 min-w-full mt-1 overflow-scroll">
						<span v-for="(tz, i) in timezone.list" :key="i" @click="chooseTz(tz)" class="hover:bg-gray-400 cursor-pointer block px-3 py-2">{{ tz.name }}</span>
					</div>

					<small class="text-red-400" v-for="(err, index) in updateInfoForm.timezone_id.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10">
					<label for="best_time_to_call" class="py-4">Bet Time To Call You</label>
					<select id="best_time_to_call" v-model="updateInfoForm.best_time_to_call.val" :class="{ 'bg-red-100': !updateInfoForm.best_time_to_call.is_valid }" class="min-w-full bg-white px-2 py-2 shadow-md outline-none border rounded">
						<option selected disabled>Choose ...</option>
						<option :selected="updateInfoForm.best_time_to_call.val === 'AM'" value="AM">AM</option>
						<option :selected="updateInfoForm.best_time_to_call.val === 'PM'" value="PM">PM</option>
					</select>
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.best_time_to_call.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10">
					<label for="street_address" class="py-4">Street address</label>
					<input v-model.trim="updateInfoForm.street_address.val" type="text" id="street_address" :class="{ 'bg-red-100': !updateInfoForm.street_address.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Street address" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.street_address.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10">
					<label for="city" class="py-4">City</label>
					<input v-model.trim="updateInfoForm.city.val" type="text" id="city" :class="{ 'bg-red-100': !updateInfoForm.city.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="city" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.city.errors" :key="index">{{ err }}, </small>
				</div>
			</div>

			<div class="flex-grow p-4 formSection">
				<div class="mb-10">
					<label for="region" class="py-4">Region or State</label>
					<input v-model.trim="updateInfoForm.region.val" type="text" id="region" :class="{ 'bg-red-100': !updateInfoForm.region.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Region or state" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.region.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10">
					<label for="zip_code" class="py-4">Zip code (postal code)</label>
					<input v-model.trim="updateInfoForm.zip_code.val" type="text" id="zip_code" :class="{ 'bg-red-100': !updateInfoForm.zip_code.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Zip code (postal code)" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.zip_code.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-5">
					<label for="phone_number" class="py-4">Phone number</label>
					<input v-model.trim="updateInfoForm.phone_number.val" type="text" id="phone_number" :class="{ 'bg-red-100': !updateInfoForm.phone_number.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Phone number" />
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.phone_number.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-5 text-center">
					<small>fill one or the other or both</small>
				</div>

				<div class="mb-10">
					<label for="skype" class="py-4">Skype</label>
					<div class="flex items-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.748 13.648c0 1.773-1.414 2.935-3.523 2.935-1.855 0-3.721-.845-3.711-2.299.002-.439.328-.841.763-.841 1.093 0 1.083 1.63 2.822 1.63 1.221 0 1.638-.669 1.638-1.134 0-1.684-5.275-.652-5.275-3.817 0-1.713 1.401-2.895 3.604-2.765 2.101.124 3.332 1.052 3.451 1.918.059.566-.316 1.007-.968 1.007-.95 0-1.047-1.272-2.684-1.272-.738 0-1.361.308-1.361.977 0 1.397 5.244.586 5.244 3.661zm8.252-1.648c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-5.591 1.147c.792-4.53-3.159-8.407-7.614-7.571-3.396-2.077-7.293 1.882-5.21 5.267-.811 4.519 3.139 8.447 7.631 7.589 3.401 2.062 7.287-1.902 5.193-5.285z" /></svg>
						<input v-model.trim="updateInfoForm.skype.val" type="text" id="skype" :class="{ 'bg-red-100': !updateInfoForm.skype.is_valid }" class="ml-4 flex-grow px-2 py-2 shadow-md outline-none border rounded" placeholder="Skype" />
					</div>
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.skype.errors" :key="index">{{ err }}, </small>
				</div>

				<div class="mb-10">
					<label for="telegram" class="py-4">Telegram</label>
					<div class="flex items-center">
						<svg width="24px" height="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><path id="telegram-4" d="M12,0c-6.626,0 -12,5.372 -12,12c0,6.627 5.374,12 12,12c6.627,0 12,-5.373 12,-12c0,-6.628 -5.373,-12 -12,-12Zm3.224,17.871c0.188,0.133 0.43,0.166 0.646,0.085c0.215,-0.082 0.374,-0.267 0.422,-0.491c0.507,-2.382 1.737,-8.412 2.198,-10.578c0.035,-0.164 -0.023,-0.334 -0.151,-0.443c-0.129,-0.109 -0.307,-0.14 -0.465,-0.082c-2.446,0.906 -9.979,3.732 -13.058,4.871c-0.195,0.073 -0.322,0.26 -0.316,0.467c0.007,0.206 0.146,0.385 0.346,0.445c1.381,0.413 3.193,0.988 3.193,0.988c0,0 0.847,2.558 1.288,3.858c0.056,0.164 0.184,0.292 0.352,0.336c0.169,0.044 0.348,-0.002 0.474,-0.121c0.709,-0.669 1.805,-1.704 1.805,-1.704c0,0 2.084,1.527 3.266,2.369Zm-6.423,-5.062l0.98,3.231l0.218,-2.046c0,0 3.783,-3.413 5.941,-5.358c0.063,-0.057 0.071,-0.153 0.019,-0.22c-0.052,-0.067 -0.148,-0.083 -0.219,-0.037c-2.5,1.596 -6.939,4.43 -6.939,4.43Z" /></svg>
						<input v-model.trim="updateInfoForm.telegram.val" type="text" id="telegram" :class="{ 'bg-red-100': !updateInfoForm.telegram.is_valid }" class="ml-4 flex-grow px-2 py-2 shadow-md outline-none border rounded" placeholder="Telegram" />
					</div>
					<small class="text-red-400" v-for="(err, index) in updateInfoForm.telegram.errors" :key="index">{{ err }}, </small>
				</div>
			</div>
		</div>

		<div class="mb-10">
			<input type="submit" @click.prevent="formIsValid" class="min-w-full text-white cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-900 rounded" value="Sign Up" />
		</div>
	</form>
</template>

<script>
	import { ref } from "vue";
	import Field from "@/utilities/validation";
	import { useStore } from "vuex";

	export default {
		name: "EditInfoForm",

		setup() {
			const store = useStore();

			let me = store.getters.ME;

			let updateInfoForm = ref({
				first_name: new Field("first_name", true, me.contact_infos.first_name),
				last_name: new Field("last_name", true, me.contact_infos.last_name),
				website: new Field("website", true, me.contact_infos.website),
				country_id: new Field("country_id", true, me.contact_infos.country_id),
				street_address: new Field("street_address", true, me.contact_infos.street_address),
				city: new Field("city", true, me.contact_infos.city),
				region: new Field("region", true, me.contact_infos.region),
				zip_code: new Field("zip_code", true, me.contact_infos.zip_code),
				phone_number: new Field("phone_number", true, me.contact_infos.phone_number),
				skype: new Field("skype", true, me.contact_infos.skype),
				telegram: new Field("telegram", true, me.contact_infos.telegram),

				old_password: new Field("old_password"),
				password: new Field("password"),
				password_confirmation: new Field("password_confirmation"),

				title: new Field("title", true, me.contact_infos.title),
				timezone_id: new Field("timezone_id", true, me.contact_infos.timezone_id),
				best_time_to_call: new Field("best_time_to_call", true, me.contact_infos.best_time_to_call),
			});

			let message = ref({
				details: null,
				status: null,
			});

			let formIsValid = () => {
				for (let key in updateInfoForm.value) {
					updateInfoForm.value[key].reset();
				}

				updateInfoForm.value.first_name.require("first name is required");
				updateInfoForm.value.last_name.require("last name is required");
				// updateInfoForm.value.website.require('website is required')
				updateInfoForm.value.country_id.require("country is required");
				updateInfoForm.value.street_address.require("street address is required");
				updateInfoForm.value.city.require("city is required");
				updateInfoForm.value.region.require("region is required");
				updateInfoForm.value.zip_code.require("zip code is required");
				updateInfoForm.value.phone_number.require("phone number is required");
				// updateInfoForm.value.skype.require('skype is required')
				// updateInfoForm.value.telegram.require('telegram is required')
				updateInfoForm.value.password.require("password is required");
				updateInfoForm.value.password_confirmation.require("password confirmation is required");
				updateInfoForm.value.terms_conditions.require("terms conditions is required");

				for (let key in updateInfoForm.value) {
					if (!updateInfoForm.value[key].is_valid) {
						return;
					}
				}

				api.post(`${apiUrl}/auth/register`, {
					first_name: updateInfoForm.value.first_name.val,
					last_name: updateInfoForm.value.last_name.val,
					website: updateInfoForm.value.website.val,
					country_id: updateInfoForm.value.country_id.val,
					street_address: updateInfoForm.value.street_address.val,
					city: updateInfoForm.value.city.val,
					region: updateInfoForm.value.region.val,
					zip_code: updateInfoForm.value.zip_code.val,
					phone_number: updateInfoForm.value.phone_number.val,
					skype: updateInfoForm.value.skype.val,
					telegram: updateInfoForm.value.telegram.val,
					password: updateInfoForm.value.password.val,
					password_confirmation: updateInfoForm.value.password_confirmation.val,
					terms_conditions: updateInfoForm.value.terms_conditions.val,
				})
					.then((resp) => {
						message.value = {
							details: "data saved with success",
							status: true,
						};
					})
					.catch((err) => {
						if (err.response.data.errors) {
							updateInfoForm.value.first_name.serverInvalidate(err.response.data.errors.first_name);
							updateInfoForm.value.last_name.serverInvalidate(err.response.data.errors.last_name);
							updateInfoForm.value.website.serverInvalidate(err.response.data.errors.website);
							updateInfoForm.value.country_id.serverInvalidate(err.response.data.errors.country_id);
							updateInfoForm.value.street_address.serverInvalidate(err.response.data.errors.street_address);
							updateInfoForm.value.city.serverInvalidate(err.response.data.errors.city);
							updateInfoForm.value.region.serverInvalidate(err.response.data.errors.region);
							updateInfoForm.value.zip_code.serverInvalidate(err.response.data.errors.zip_code);
							updateInfoForm.value.phone_number.serverInvalidate(err.response.data.errors.phone_number);
							updateInfoForm.value.skype.serverInvalidate(err.response.data.errors.skype);
							updateInfoForm.value.telegram.serverInvalidate(err.response.data.errors.telegram);
							updateInfoForm.value.password.serverInvalidate(err.response.data.errors.password);
							updateInfoForm.value.password_confirmation.serverInvalidate(err.response.data.errors.password_confirmation);
							updateInfoForm.value.terms_conditions.serverInvalidate(err.response.data.errors.terms_conditions);
						}
						if (err.response.data.error) {
							message.value = {
								details: err.response.data.error,
								status: false,
							};
						}
					})
					.then(() => {
						setTimeout(() => {
							message.value = {
								details: null,
								status: false,
							};
						}, 5000);
					});
			};

			let country = ref({
				name: me ? me.country.details.name : null,
				list: [],
			});

			let timezone = ref({
				name: me.timezone ? me.timezone.name : null,
				visible: false,
				list: [],
			});

			let fetchCountries = () => {
				api.get(`/countries?q=${country.value.name}`)
					.then((resp) => {
						country.value.list = resp.data;
					})
					.catch((err) => {
						message.value = {
							details: "something went wrong",
							status: false,
						};
					});
			};

			let fetchTz = () => {
				let params = timezone.value.name != "" && timezone.value.name != null ? "q=" + timezone.value.name : "all=1";

				api.get(`/timezones?${params}`)
					.then((resp) => {
						timezone.value.list = resp.data;
						timezone.value.visible = true;
					})
					.catch((err) => {
						message.value = {
							details: "something went wrong",
							status: false,
						};
					});
			};

			let chooseCountry = (c) => {
				updateInfoForm.value.country_id.val = c._id;
				country.value.name = c.details.name + ", " + c.details.code;
				country.value.list = [];
			};

			let chooseTz = (tz) => {
				updateInfoForm.value.timezone_id.val = tz._id;
				timezone.value.name = tz.name;
				timezone.value.visible = false;
			};

			return {
				updateInfoForm,
				formIsValid,
				message,
				country,
				fetchCountries,
				fetchTz,
				chooseCountry,
				chooseTz,
				timezone,
			};
		},

		methods: {
			hideOptions(e) {
				if (!document.querySelector("#country").parentElement.contains(e.target)) {
					this.country.list = [];
					this.timezone.visible = false;
				}
			},
		},

		mounted() {
			document.addEventListener("click", this.hideOptions);
		},

		unmounted() {
			document.removeEventListener("click", this.hideOptions);
		},
	};
</script>

<style scoped>
	#timezone + div,
	#country + div {
		max-height: 500px;
	}
</style>
