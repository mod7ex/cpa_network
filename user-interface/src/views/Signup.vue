<template>
	<form class="bg-white my-10 mx-auto px-6 py-10 shadow-md rounded text-gray-700">
		<h1 class="text-3xl font-black mb-3 text-center">Sign Up</h1>
		<hr class="mb-3" />
		<div v-if="message.details" class="mb-10 px-5 py-3 rounded font-bold text-black" :class="{ 'bg-red-400': !message.status, 'bg-green-600': message.status }">
			<h1>{{ message.details }}</h1>
		</div>

		<div class="mb-10">
			<label for="first_name" class="py-4">First Name</label>
			<input v-model.trim="signupForm.first_name.val" type="text" id="first_name" :class="{ 'bg-red-100': !signupForm.first_name.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="first name" />
			<small class="text-red-400" v-for="(err, index) in signupForm.first_name.errors" :key="index">{{ err }}, </small>
		</div>

		<div class="mb-10">
			<label for="first_name" class="py-4">Last Name</label>
			<input v-model.trim="signupForm.last_name.val" type="text" id="last_name" :class="{ 'bg-red-100': !signupForm.last_name.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="last name" />
			<small class="text-red-400" v-for="(err, index) in signupForm.last_name.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="email" class="py-4">E-mail</label>
			<input v-model.trim="signupForm.email.val" type="email" id="email" :class="{ 'bg-red-100': !signupForm.email.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="email address" />
			<small class="text-red-400" v-for="(err, index) in signupForm.email.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="website" class="py-4">Website (optional)</label>
			<input v-model.trim="signupForm.website.val" type="text" id="website" :class="{ 'bg-red-100': !signupForm.website.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="web site" />
			<small class="text-red-400" v-for="(err, index) in signupForm.website.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10 relative">
			<label for="country" class="py-4">Country</label>
			<input type="text" id="country" @input="fetchCountries" v-model.trim="country.name" :class="{ 'bg-red-100': !signupForm.country_id.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" autocomplete="off" placeholder="country" />
			<div v-if="country.list.length" class="absolute bg-gray-200 min-w-full mt-1 overflow-scroll">
				<span v-for="(c, i) in country.list" :key="i" @click="chooseCountry(c)" class="hover:bg-gray-400 cursor-pointer block px-3 py-2">{{ c.details.name }}, {{ c.details.code }}</span>
			</div>
			<small class="text-red-400" v-for="(err, index) in signupForm.country_id.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="street_address" class="py-4">Street address</label>
			<input v-model.trim="signupForm.street_address.val" type="text" id="street_address" :class="{ 'bg-red-100': !signupForm.street_address.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Street address" />
			<small class="text-red-400" v-for="(err, index) in signupForm.street_address.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="city" class="py-4">City</label>
			<input v-model.trim="signupForm.city.val" type="text" id="city" :class="{ 'bg-red-100': !signupForm.city.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="city" />
			<small class="text-red-400" v-for="(err, index) in signupForm.city.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="region" class="py-4">Region or State</label>
			<input v-model.trim="signupForm.region.val" type="text" id="region" :class="{ 'bg-red-100': !signupForm.region.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Region or state" />
			<small class="text-red-400" v-for="(err, index) in signupForm.region.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="zip_code" class="py-4">Zip code (postal code)</label>
			<input v-model.trim="signupForm.zip_code.val" type="text" id="zip_code" :class="{ 'bg-red-100': !signupForm.zip_code.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Zip code (postal code)" />
			<small class="text-red-400" v-for="(err, index) in signupForm.zip_code.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-5">
			<label for="phone_number" class="py-4">Phone number</label>
			<input v-model.trim="signupForm.phone_number.val" type="text" id="phone_number" :class="{ 'bg-red-100': !signupForm.phone_number.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Phone number" />
			<small class="text-red-400" v-for="(err, index) in signupForm.phone_number.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-5 text-center">
			<small>fill one or the other or both</small>
		</div>
		<div class="mb-10">
			<label for="skype" class="py-4">Skype</label>
			<div class="flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.748 13.648c0 1.773-1.414 2.935-3.523 2.935-1.855 0-3.721-.845-3.711-2.299.002-.439.328-.841.763-.841 1.093 0 1.083 1.63 2.822 1.63 1.221 0 1.638-.669 1.638-1.134 0-1.684-5.275-.652-5.275-3.817 0-1.713 1.401-2.895 3.604-2.765 2.101.124 3.332 1.052 3.451 1.918.059.566-.316 1.007-.968 1.007-.95 0-1.047-1.272-2.684-1.272-.738 0-1.361.308-1.361.977 0 1.397 5.244.586 5.244 3.661zm8.252-1.648c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-5.591 1.147c.792-4.53-3.159-8.407-7.614-7.571-3.396-2.077-7.293 1.882-5.21 5.267-.811 4.519 3.139 8.447 7.631 7.589 3.401 2.062 7.287-1.902 5.193-5.285z" /></svg>
				<input v-model.trim="signupForm.skype.val" type="text" id="skype" :class="{ 'bg-red-100': !signupForm.skype.is_valid }" class="ml-4 flex-grow px-2 py-2 shadow-md outline-none border rounded" placeholder="Skype" />
			</div>
			<small class="text-red-400" v-for="(err, index) in signupForm.skype.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="telegram" class="py-4">Telegram</label>
			<div class="flex items-center">
				<svg width="24px" height="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><path id="telegram-4" d="M12,0c-6.626,0 -12,5.372 -12,12c0,6.627 5.374,12 12,12c6.627,0 12,-5.373 12,-12c0,-6.628 -5.373,-12 -12,-12Zm3.224,17.871c0.188,0.133 0.43,0.166 0.646,0.085c0.215,-0.082 0.374,-0.267 0.422,-0.491c0.507,-2.382 1.737,-8.412 2.198,-10.578c0.035,-0.164 -0.023,-0.334 -0.151,-0.443c-0.129,-0.109 -0.307,-0.14 -0.465,-0.082c-2.446,0.906 -9.979,3.732 -13.058,4.871c-0.195,0.073 -0.322,0.26 -0.316,0.467c0.007,0.206 0.146,0.385 0.346,0.445c1.381,0.413 3.193,0.988 3.193,0.988c0,0 0.847,2.558 1.288,3.858c0.056,0.164 0.184,0.292 0.352,0.336c0.169,0.044 0.348,-0.002 0.474,-0.121c0.709,-0.669 1.805,-1.704 1.805,-1.704c0,0 2.084,1.527 3.266,2.369Zm-6.423,-5.062l0.98,3.231l0.218,-2.046c0,0 3.783,-3.413 5.941,-5.358c0.063,-0.057 0.071,-0.153 0.019,-0.22c-0.052,-0.067 -0.148,-0.083 -0.219,-0.037c-2.5,1.596 -6.939,4.43 -6.939,4.43Z" /></svg>
				<input v-model.trim="signupForm.telegram.val" type="text" id="telegram" :class="{ 'bg-red-100': !signupForm.telegram.is_valid }" class="ml-4 flex-grow px-2 py-2 shadow-md outline-none border rounded" placeholder="Telegram" />
			</div>
			<small class="text-red-400" v-for="(err, index) in signupForm.telegram.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="password" class="py-4">Password</label>
			<input v-model="signupForm.password.val" type="password" id="password" :class="{ 'bg-red-100': !signupForm.password.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Strong Password" />
			<small class="text-red-400" v-for="(err, index) in signupForm.password.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="password_confirmation" class="py-4">Confirm Password</label>
			<input v-model="signupForm.password_confirmation.val" type="password" id="password_confirmation" :class="{ 'bg-red-100': !signupForm.password_confirmation.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Password Confirmation" />
			<small class="text-red-400" v-for="(err, index) in signupForm.password_confirmation.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10 flex items-center">
			<label class="inline-flex items-center">
				<input v-model="signupForm.terms_conditions.val" type="checkbox" :class="{ 'bg-red-100': !signupForm.terms_conditions.is_valid }" class="h-5 w-5" />
				<span class="ml-2 text-gray-700">
					<small>
						Accept
						<span class="font-bold underline">
							<router-link :to="{ name: '' }">Terms & Conditions</router-link>
						</span>
					</small>
				</span>
				<br />
				<small class="text-red-400" v-for="(err, index) in signupForm.terms_conditions.errors" :key="index"> {{ err }}, </small>
			</label>
		</div>
		<div class="mb-10">
			<input type="submit" @click.prevent="formIsValid" class="min-w-full text-white cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-900 rounded" value="Sign Up" />
		</div>
		<div class="flex justify-between px-6">
			<small class="font-bold underline">
				<router-link :to="{ name: '' }">Have an account? Login</router-link>
			</small>
		</div>
	</form>
</template>

<script>
	import { ref } from "vue";
	import { useStore } from "vuex";
	import Field from "../utilities/validation";
	import router from "../router";

	export default {
		name: "Signup",

		setup() {
			const store = useStore();

			let signupForm = ref({
				first_name: new Field("first_name"),
				last_name: new Field("last_name"),
				website: new Field("website"),
				country_id: new Field("country_id"),
				street_address: new Field("street_address"),
				city: new Field("city"),
				region: new Field("region"),
				zip_code: new Field("zip_code"),
				phone_number: new Field("phone_number"),
				skype: new Field("skype"),
				telegram: new Field("telegram"),

				email: new Field("email"),
				password: new Field("password"),
				password_confirmation: new Field("password_confirmation"),

				terms_conditions: new Field("terms_conditions"),
			});

			let message = ref({
				details: null,
				status: null,
			});

			let formIsValid = () => {
				for (let key in signupForm.value) {
					signupForm.value[key].reset();
				}

				signupForm.value.first_name.require("first name is required");
				signupForm.value.last_name.require("last name is required");
				// signupForm.value.website.require('website is required')
				signupForm.value.country_id.require("country is required");
				signupForm.value.street_address.require("street address is required");
				signupForm.value.city.require("city is required");
				signupForm.value.region.require("region is required");
				signupForm.value.zip_code.require("zip code is required");
				signupForm.value.phone_number.require("phone number is required");
				// signupForm.value.skype.require('skype is required')
				// signupForm.value.telegram.require('telegram is required')
				signupForm.value.email.require("email is required");
				signupForm.value.password.require("password is required");
				signupForm.value.password_confirmation.require("password confirmation is required");
				signupForm.value.terms_conditions.require("terms conditions is required");

				for (let key in signupForm.value) {
					if (!signupForm.value[key].is_valid) {
						return;
					}
				}

				store
					.dispatch("register", {
						first_name: signupForm.value.first_name.val,
						last_name: signupForm.value.last_name.val,
						website: signupForm.value.website.val,
						country_id: signupForm.value.country_id.val,
						street_address: signupForm.value.street_address.val,
						city: signupForm.value.city.val,
						region: signupForm.value.region.val,
						zip_code: signupForm.value.zip_code.val,
						phone_number: signupForm.value.phone_number.val,
						skype: signupForm.value.skype.val,
						telegram: signupForm.value.telegram.val,
						email: signupForm.value.email.val,
						password: signupForm.value.password.val,
						password_confirmation: signupForm.value.password_confirmation.val,
						terms_conditions: signupForm.value.terms_conditions.val,
					})
					.then(() => {
						router.go({ name: "Dashboard" });
					})
					.catch((err) => {
						console.log(err);
					});
			};

			let country = ref({
				name: null,
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

			let chooseCountry = (c) => {
				signupForm.value.country_id.val = c._id;
				country.value.name = c.details.name + ", " + c.details.code;
				country.value.list = [];
			};

			return {
				signupForm,
				formIsValid,
				message,
				country,
				fetchCountries,
				chooseCountry,
			};
		},

		methods: {
			ToggleOptions(e) {
				if (!document.querySelector("#country").parentElement.contains(e.target)) {
					this.country.list = [];
				}
			},
		},

		mounted() {
			document.addEventListener("click", this.ToggleOptions);
		},

		unmounted() {
			document.removeEventListener("click", this.ToggleOptions);
		},
	};
</script>

<style scoped>
	form {
		max-width: 500px;
	}

	#country + div {
		max-height: 500px;
	}
</style>
