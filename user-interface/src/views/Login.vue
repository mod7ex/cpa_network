<template>
	<form class="bg-white my-10 mx-auto px-6 py-10 shadow-md rounded text-gray-700">
		<h1 class="text-3xl font-black mb-3 text-center">Log In</h1>
		<hr class="mb-3" />
		<div v-if="message.details" class="mb-10 px-5 py-3 rounded font-bold text-black" :class="{ 'bg-red-400': !message.status, 'bg-green-600': message.status }">
			<h1>{{ message.details }}</h1>
		</div>
		<div class="mb-10">
			<label for="email" class="py-4">E-mail</label>
			<input type="email" id="email" v-model.trim="loginForm.email.val" :class="{ 'bg-red-100': !loginForm.email.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="email address" />
			<small class="text-red-400" v-for="(err, index) in loginForm.email.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10">
			<label for="password" class="py-4">Password</label>
			<input type="password" id="password" v-model.trim="loginForm.password.val" :class="{ 'bg-red-100': !loginForm.password.is_valid }" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="password" />
			<small class="text-red-400" v-for="(err, index) in loginForm.password.errors" :key="index">{{ err }}, </small>
		</div>
		<div class="mb-10 flex items-center">
			<label class="inline-flex items-center">
				<input type="checkbox" class="h-5 w-5" v-model="loginForm.remember.val" />
				<span class="ml-2 text-gray-700">Remeber me</span>
			</label>
		</div>
		<div class="mb-10">
			<input @click.prevent="formIsValid" type="submit" class="min-w-full text-white cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-900 rounded" value="Log In" />
		</div>
		<div class="flex justify-between px-6">
			<small class="font-bold underline">
				<router-link :to="{ name: '' }">Forgot password?</router-link>
			</small>
			<small class="opacity-70">or</small>
			<small class="font-bold underline">
				<router-link :to="{ name: '' }">Create an account</router-link>
			</small>
		</div>
	</form>
</template>

<script>
	import { ref } from "vue";
	import { useStore } from "vuex";
	import { useRouter } from "vue-router";

	import Field from "../utilities/validation";

	export default {
		name: "Login",

		setup() {
			const store = useStore();
			const router = useRouter();

			let loginForm = ref({
				email: new Field("email", true, "lambert.schimmel@example.com"),
				password: new Field("password", true, "password"),
				remember: new Field("remember", true, false),
			});

			let message = ref({
				details: null,
				status: null,
			});

			let formIsValid = () => {
				loginForm.value.email.reset();
				loginForm.value.password.reset();

				loginForm.value.email.require("email is required").isEmail("enter a valid email");
				loginForm.value.password.require("password is required").min(6, "invalid password");

				for (let key in loginForm.value) {
					if (!loginForm.value[key].is_valid) {
						return;
					}
				}

				store
					.dispatch("login", {
						email: loginForm.value.email.val,
						password: loginForm.value.password.val,
						remember: loginForm.value.remember.val,
					})
					.then(() => {
						router.push({ name: "Dashboard" });
					})
					.catch((err) => {
						console.log(err);
					});
			};

			return {
				loginForm,
				formIsValid,
				message,
			};
		},
	};
</script>

<style scoped>
	form {
		max-width: 500px;
	}
</style>
