<template>
	<div class="bg-white shadow-lg z-50">
		<header class="px-8 py-3 flex items-center">
			<button class="text-gray-700 hover:bg-gray-300 p-3 rounded-full focus:outline-none" @click="toggleNav">
				<svg class="fill-current rounded" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" /></svg>
			</button>
			<div class="ml-12">
				<h1 class="font-black text-2xl">Mourad<span class="text-green-800">CPA</span></h1>
			</div>
			<div class="flex ml-auto">
				<button>
					<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.137 3.945c-.644-.374-1.041-1.07-1.04-1.82v-.003c0-1.172-.939-2.122-2.097-2.122s-2.097.95-2.097 2.122v.003c.001.751-.396 1.446-1.041 1.82-4.667 2.712-1.985 11.715-6.862 13.306v1.749h20v-1.749c-4.877-1.591-2.195-10.594-6.863-13.306zm-6.728 12.055h-1.882c1.245-2.741.879-9.012 3.873-10.655-1.761 2.067-.95 7.504-1.991 10.655zm3.591-13c-.552 0-1-.448-1-1 0-.551.448-1 1-1s1 .449 1 1c0 .552-.448 1-1 1zm-3 18h6c0 1.598-1.393 3-2.971 3-1.579 0-3.029-1.402-3.029-3z"/></svg> -->
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.137 3.945c-.644-.374-1.042-1.07-1.041-1.82v-.003c.001-1.172-.938-2.122-2.096-2.122s-2.097.95-2.097 2.122v.003c.001.751-.396 1.446-1.041 1.82-4.667 2.712-1.985 11.715-6.862 13.306v1.749h20v-1.749c-4.877-1.591-2.195-10.594-6.863-13.306zm-3.137-2.945c.552 0 1 .449 1 1 0 .552-.448 1-1 1s-1-.448-1-1c0-.551.448-1 1-1zm3 20c0 1.598-1.392 3-2.971 3s-3.029-1.402-3.029-3h6zm5.778-11.679c.18.721.05 1.446-.304 2.035l.97.584c.504-.838.688-1.869.433-2.892-.255-1.024-.9-1.848-1.739-2.351l-.582.97c.589.355 1.043.934 1.222 1.654zm.396-4.346l-.597.995c1.023.616 1.812 1.623 2.125 2.874.311 1.251.085 2.51-.53 3.534l.994.598c.536-.892.835-1.926.835-3-.001-1.98-1.01-3.909-2.827-5.001zm-16.73 2.692l-.582-.97c-.839.504-1.484 1.327-1.739 2.351-.255 1.023-.071 2.053.433 2.892l.97-.584c-.354-.588-.484-1.314-.304-2.035.179-.72.633-1.299 1.222-1.654zm-4.444 2.308c0 1.074.299 2.108.835 3l.994-.598c-.615-1.024-.841-2.283-.53-3.534.312-1.251 1.101-2.258 2.124-2.873l-.597-.995c-1.817 1.092-2.826 3.021-2.826 5z" /></svg>
				</button>
			</div>
		</header>
		<div class="relative">
			<transition name="slide-fade">
				<nav class="absolute bg-white min-h-screen shadow-lg text-gray-700" v-if="navIsOpen">
					<div class="bg-white w-full flex items-center p-2 my-2 shadow border">
						<div class="flex items-center space-x-4">
							<img src="https://avatars2.githubusercontent.com/u/1490347?s=460&u=39d7a6b9bc030244e2c509119e5f64eabb2b1727&v=4" alt="My profile" class="w-16 h-16 rounded-full" />
						</div>

						<div class="flex-grow p-3">
							<div class="font-semibold text-gray-700">
								<small>Your AM: </small>
								<small>Mourad EL CADI</small>
							</div>

							<div class="text-sm text-gray-500 flex">
								<svg class="svg-icon h-6" viewBox="0 0 20 20">
									<path d="M17.218,2.268L2.477,8.388C2.13,8.535,2.164,9.05,2.542,9.134L9.33,10.67l1.535,6.787c0.083,0.377,0.602,0.415,0.745,0.065l6.123-14.74C17.866,2.46,17.539,2.134,17.218,2.268 M3.92,8.641l11.772-4.89L9.535,9.909L3.92,8.641z M11.358,16.078l-1.268-5.613l6.157-6.157L11.358,16.078z"></path>
								</svg>

								<small>Telegram: </small>
								<small>
									<a class="text-blue-700 underline" href="#">@modex987</a>
								</small>
							</div>
						</div>
						<div class="p-2">
							<img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144" alt="My profile" class="w-4 h-4 rounded-full order-1" />
						</div>
					</div>

					<ul class="">
						<li class="mb-3 cursor-pointer transition duration-500 ease-in-out hover:bg-gray-300 px-6 py-2">
							<router-link :to="{ name: 'Dashboard' }" class="flex">
								<svg class="fill-current mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 13c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 2.583.816 5.042 2.205 7h4.358c.93 1.647 3.015 3 5.438 3s4.508-1.353 5.438-3h4.357c1.388-1.958 2.204-4.417 2.204-7zm-4.492-6.436l-2.203 2.203c-.316-.396-.676-.755-1.071-1.071l2.203-2.203c.382.328.742.688 1.071 1.071zm-4.431-2.964c.479.156.948.352 1.399.581l-1.193 2.878c-.443-.245-.913-.44-1.399-.58l1.193-2.879zm-3.835-.46c.256-.02.51-.029.758-.029s.502.01.758.029v3.115c-.252-.027-.506-.042-.758-.042s-.506.014-.758.042v-3.115zm-.371 10.441l1.129-5.294 1.129 5.293c.721.398 1.207 1.165 1.207 2.045 0 1.29-1.045 2.336-2.336 2.336-1.29 0-2.336-1.046-2.336-2.336 0-.88.486-1.646 1.207-2.044zm-1.986-9.969l1.205 2.875c-.486.141-.954.338-1.397.585l-1.205-2.874c.45-.231.919-.427 1.397-.586zm-3.322 1.881l2.203 2.203c-.395.316-.754.675-1.071 1.071l-2.202-2.203c.328-.383.688-.743 1.07-1.071zm-2.964 4.432c.156-.479.351-.948.58-1.399l2.879 1.192c-.246.443-.44.913-.58 1.399l-2.879-1.192zm15.893 1.091c-.147-.483-.35-.95-.603-1.39l2.86-1.238c.235.445.438.912.602 1.39l-2.859 1.238z" /></svg>
								<span>Dashboard</span>
							</router-link>
						</li>
						<li class="mb-3 cursor-pointer transition duration-500 ease-in-out hover:bg-gray-300 px-6 py-2">
							<router-link :to="{ name: 'AccountInfo' }" class="flex">
								<svg class="fill-current mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 21.193l-.003.807h-19.993l-.004-.833c-.009-2.224.088-3.495 2.647-4.086 2.805-.647 5.573-1.227 4.242-3.682-3.943-7.275-1.123-11.399 3.111-11.399 4.153 0 7.043 3.971 3.11 11.398-1.292 2.44 1.375 3.02 4.242 3.682 2.57.594 2.657 1.873 2.648 4.113zm4-17.193h-7v2h7v-2zm0 4h-7v2h7v-2zm0 4h-7v2h7v-2z" /></svg>
								<span>Account Infos</span>
							</router-link>
						</li>
						<li class="mb-3 cursor-pointer transition duration-500 ease-in-out hover:bg-gray-300 px-6 py-2">
							<router-link :to="{ name: 'OffersListing' }" class="flex">
								<svg class="fill-current mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 12c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm9 0c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm9 0c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3z" /></svg>
								<span>Offers Listing</span>
							</router-link>
						</li>
						<li class="mb-3 cursor-pointer transition duration-500 ease-in-out hover:bg-gray-300 px-6 py-2">
							<router-link :to="{ name: 'Stats' }" class="flex">
								<svg class="fill-current mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 19h-4v-8h4v8zm6 0h-4v-18h4v18zm6 0h-4v-12h4v12zm6 0h-4v-4h4v4zm1 2h-24v2h24v-2z" /></svg>
								<span>Stats</span>
							</router-link>
						</li>
						<li @click="logout" class="mb-3 cursor-pointer transition duration-500 ease-in-out hover:bg-gray-300 px-6 py-2">
							<router-link :to="{ name: '' }" class="flex">
								<svg class="fill-current mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 9v-4l8 7-8 7v-4h-8v-6h8zm-2 10v-.083c-1.178.685-2.542 1.083-4 1.083-4.411 0-8-3.589-8-8s3.589-8 8-8c1.458 0 2.822.398 4 1.083v-2.245c-1.226-.536-2.577-.838-4-.838-5.522 0-10 4.477-10 10s4.478 10 10 10c1.423 0 2.774-.302 4-.838v-2.162z" /></svg>
								<span>Log Out</span>
							</router-link>
						</li>
					</ul>
				</nav>
			</transition>
		</div>
	</div>
</template>

<script>
	import router from "../router";
	export default {
		name: "DashboardNav",

		data: () => {
			return {
				navIsOpen: false,
			};
		},

		methods: {
			toggleNav() {
				this.navIsOpen = !this.navIsOpen;
			},

			logout() {
				this.$store.dispatch("logout").finally(() => {
					router.push({ name: "Home" });
				});
			},
		},
	};
</script>

<style scoped>
	body {
		overflow: hidden;
	}

	nav {
		min-width: 150px;
		z-index: 10000000000000000000;
	}

	/* Enter and leave animations can use different */
	/* durations and timing functions. */
	.slide-fade-enter-active {
		transition: all 0.5s ease-out;
	}

	.slide-fade-leave-active {
		transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
	}

	.slide-fade-enter-from,
	.slide-fade-leave-to {
		transform: translateX(-150px);
		opacity: 0;
	}
</style>
