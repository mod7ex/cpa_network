<template>
	<div class="pt-16 p-3 flex flex-col items-center justify-center">
		<h1 class="font-black text-2xl mr-3">mourad<span class="text-green-700">CPA</span></h1>
		<h1 class="text-4xl font-black text-gray-600 mb-16">Admin Login</h1>

		<form class="border shadow bg-white rounded">
			<div class="bg-gray-100 text-gray-600 p-4">
				<h1 class="text-4xl font-black">Login</h1>
			</div>

			<div class="p-3 py-6">
				<div class="mb-6 input-field">
					<label for="email">E-mail</label>
					<input type="text" id="email" />
				</div>

				<div class="mb-12 input-field">
					<label for="password">Password</label>
					<input type="password" id="password" />
				</div>

				<div class="my-6">
					<input type="submit" value="Login" @submit.prevent="" class="bg-gray-600 text-white p-3 rounded w-full font-black cursor-pointer focus:outline-none hover:opacity-75" />
				</div>

				<div class="mt-6 text-center">
					<small class="text-gray-600">In case you forgot your credentials please get in touch with your Boss</small>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		name: "Login",
		components: {},
	};
</script>

<style scoped>
	form {
		max-width: 600px;
		width: 100%;
	}

	.input-field {
		@apply flex flex-col items-start;
	}

	.input-field label {
		@apply py-2;
	}

	.input-field input {
		@apply p-1 border rounded w-full;
	}

	.input-field input:focus {
		@apply outline-none border-gray-600 bg-gray-100;
	}
</style>
