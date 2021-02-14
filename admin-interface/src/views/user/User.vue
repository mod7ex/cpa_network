<template>
	<Admin v-if="user">
		<template v-slot:title>User @:username.mail.com</template>

		<div class="m-3 p-1 flex">
			<div class="min-w-sm border border-gray-100 bg-green-100 shadow-xl min-w-max rounded">
				<div class="w-full h-32 w-96 bg-green-300 flex items-center justify-center">
					<h1 class="font-black text-2xl">mourad<span class="text-green-700">CPA</span></h1>
				</div>
				<div class="flex items-center p-4">
					<div class="relative flex flex-col items-center w-full">
						<div class="h-24 w-24 md rounded-full relative avatar flex items-end justify-end text-purple-600 min-w-max absolute -top-16 flex bg-purple-200 text-purple-100 row-start-1 row-end-3 text-purple-650 ring-1 ring-white">
							<img class="h-24 w-24 md rounded-full relative" src="https://avatars3.githubusercontent.com/u/11801238?v=4" alt="" />
							<div class="absolute"></div>
						</div>
						<div class="flex flex-col space-y-1 justify-center items-center -mt-12 w-full">
							<span class="text-md whitespace-nowrap text-gray-800 font-semibold">Brahim</span><span class="text-md whitespace-nowrap text-gray-600">boussadjra</span>
							<p class="text-sm text-gray-500">
								I can't start my day without a coffee cup
							</p>
							<div class="py-2 flex space-x-2">
								<button class="flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring  focus:border-blue-300 rounded max-w-max border bg-transparent border-purple-700 text-purple-700 hover:border-purple-800 hover:border-purple-800 px-4 py-1 flex items-center hover:shadow-lg"><span class="mr-2"></span>FOLLOW<span class="ml-2"></span></button
								><button class="flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring  focus:border-blue-300 rounded max-w-max text-gray-100 bg-green-500 hover:bg-green-600 px-4 py-1 flex items-center hover:shadow-lg">
									<span class="mr-2"
										><svg height="20" width="20" viewBox="0 0 32 32" class="fill-current text-red-100"><path d="M22.5,4c-2,0-3.9,0.8-5.3,2.2L16,7.4l-1.1-1.1C12,3.3,7.2,3.3,4.3,6.2c0,0-0.1,0.1-0.1,0.1c-3,3-3,7.8,0,10.8L16,29	l11.8-11.9c3-3,3-7.8,0-10.8C26.4,4.8,24.5,4,22.5,4z"></path></svg></span
									>SPONSOR <span class="ml-2"></span>
								</button>
							</div>
							<div class="py-4 flex justify-center items-center w-full divide-x divide-gray-400 divide-solid">
								<span class="text-center px-2"><span class="font-bold text-gray-700">56</span><span class="text-gray-600"> followers</span></span
								><span class="text-center px-2"><span class="font-bold text-gray-700">112</span><span class="text-gray-600"> following</span></span
								><span class="text-center px-2"><span class="font-bold text-gray-700">27</span><span class="text-gray-600"> repos</span></span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--  -->

			<div></div>
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

<style></style>
