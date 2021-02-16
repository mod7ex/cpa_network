<template>
	<div class="flex flex-col">
		<transition name="slide-fade">
			<nav class="bg-gray-100 absolute top-0 bottom-0 shadow-2xl border z-50" v-if="navIsVisible">
				<button @click="toggleNav" class="p-6 focus:outline-none">
					<i class="fas fa-times"></i>
				</button>
				<div class="pt-6 text-gray-600">
					<router-link class="nav-item" :to="{ name: 'Dashboard' }"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</router-link>

					<router-link class="nav-item" :to="{ name: 'Offers' }"><i class="fab fa-buffer mr-2"></i>Offers</router-link>

					<router-link class="nav-item" :to="{ name: 'Users' }"><i class="fas fa-users mr-2"></i>Users</router-link>

					<router-link class="nav-item" :to="{ name: 'Settings' }"><i class="fas fa-cogs mr-2"></i>Settings</router-link>

					<router-link class="nav-item" :to="{}"><i class="fas fa-plus-square mr-2"></i>add offer</router-link>

					<router-link class="nav-item" :to="{ name: 'Login' }"><i class="fas fa-sign-out-alt mr-2"></i>Log Out</router-link>
				</div>
			</nav>
		</transition>

		<div class="flex flex-wrap-reverse justify-between items-center p-2 pt-6 mb-16 text-gray-600">
			<div class="flex items-center my-3">
				<h1 class="font-black text-2xl mr-3">mourad<span class="text-green-700">CPA</span></h1>
				<button @click="toggleNav" class="text-3xl focus:outline-none hover:border-gray-600 border p-1 px-2 rounded">
					<i class="fas fa-bars"></i>
				</button>
			</div>

			<div class=" my-3">
				<h1 class="font-black text-4xl "><slot name="title" /></h1>
			</div>

			<div class="flex justify-end items-center px-3 my-3 mx-auto md:mx-0">
				<div class="flex rounded shadow">
					<button class="bg-white p-2 focus:outline-none hover:text-black">
						<i class="fas fa-search"></i>
					</button>
					<input type="search" class="focus:outline-none rounded-r p-2" placeholder="Search here ..." />
				</div>
				<div class="mx-3">
					<img class="rounded-full" width="50" height="50" src="../assets/img/team-1-800x800.53033970.jpg" alt="" />
				</div>
			</div>
		</div>

		<div>
			<slot />
		</div>

		<footer class="bg-gray-800 p-5 flex flex-wrap items-center justify-evenly font-black text-gray-400">
			<div>Copyright 2021 &copy; mouradCPA</div>
			<div class="flex  items-center justify-center ">
				<h1>Contact Boss: <i class="fas fa-at"></i> <a href="mailto:mourad@mail.com">mourad@mail.com</a></h1>
				<span class="mx-3">or</span>
				<h1 class="text-2xl font-black">
					<a href="#"><i class="fab fa-telegram"></i></a>
				</h1>
			</div>
			<div>
				<small>&reg; Remeber to do your job right</small>
			</div>
		</footer>
	</div>
</template>

<script>
	export default {
		name: "Admin",

		data() {
			return {
				navIsVisible: false,
			};
		},

		methods: {
			toggleNav() {
				this.navIsVisible = !this.navIsVisible;
			},
		},
	};
</script>

<style scoped>
	nav {
		min-width: 200px;
	}
	.nav-item {
		@apply block w-full p-3 mb-3 border-l-4 hover:border-gray-700 hover:bg-gray-200;
	}

	/* Enter and leave animations can use different */
	/* durations and timing functions.              */
	.slide-fade-enter-active {
		transition: all 0.3s ease-out;
	}

	.slide-fade-leave-active {
		transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
	}

	.slide-fade-enter-from,
	.slide-fade-leave-to {
		transform: translateX(-200px);
		opacity: 0;
	}
</style>
