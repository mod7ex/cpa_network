<template>
	<div class="p-5">
		<div class="flex items-center justify-evenly flex-wrap md:flex-nowrap">
			<div id="showcase">
				<img src="../assets/hero.png" alt="" />
			</div>
			<!--  -->
			<div class="bg-gray-300 max-w-max mx-auto rounded-lg shadow-lg m-3 p-6">
				<h1 class="font-black text-2xl mb-6 text-green-800">We can take your busniss steps further</h1>
				<div class="flex mb-6">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
					<p class="px-3 font-bold text-lg">
						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum minus nesciunt aut ratione quaerat adipisci ullam, perspiciatis deserunt! Placeat laudantium, ab sint veritatis ex exercitationem totam minima mollitia tempora assumenda?
					</p>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" /></svg>
				</div>
				<div class="p-6 flex justify-evenly flex-wrap items-center">
					<button class="py-2 px-3 rounded-lg shadow-md border-4 border-green-900 font-bold mx-3">Looking for conversions ?</button>
					<button class="py-2 px-3 rounded-lg shadow-md border-4 bg-green-900 border-transparent text-white font-bold mx-3">Read More...</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "Home",
	};
</script>

<style scoped>
	p {
		max-width: 800px;
	}
</style>
