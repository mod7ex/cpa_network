<template>
	<Admin>
		<template v-slot:title>Admin Settings</template>

		<div id="settings">
			<div class="flex flex-wrap">
				<div class="w-full lg:w-8/12 px-4">
					<div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0">
						<div class="rounded-t bg-white mb-0 px-6 py-6">
							<div class="text-center">
								<h6 class="text-gray-800 text-xl font-bold"><i class="fas fa-user-shield mr-2"></i> Admin Infos</h6>
							</div>
						</div>

						<div class="flex-auto px-4 lg:px-10 py-10 pt-0">
							<fieldset disabled="disabled">
								<form>
									<h6 class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase">User Information</h6>
									<div class="flex flex-wrap">
										<div class="w-full lg:w-6/12 px-4">
											<div class="relative w-full mb-3">
												<label htmlfor="grid-password" class="block uppercase text-gray-700 text-xs font-bold mb-2"> Full Name </label>
												<input type="text" value="Jenna Stones" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" />
											</div>
										</div>

										<div class="w-full lg:w-6/12 px-4">
											<div class="relative w-full mb-3"><label htmlfor="grid-password" class="block uppercase text-gray-700 text-xs font-bold mb-2"> E-mail Address </label><input type="text" value="jenston83@yandex.com" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" /></div>
										</div>
									</div>
									<hr class="mt-6 border-b-1 border-gray-400" />
									<h6 class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase">Contact Information</h6>
									<div class="flex flex-wrap">
										<div class="w-full lg:w-12/12 px-4">
											<div class="relative w-full mb-3"><label htmlfor="grid-password" class="block uppercase text-gray-700 text-xs font-bold mb-2"> Address </label><input type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" /></div>
										</div>
										<div class="w-full lg:w-4/12 px-4">
											<div class="relative w-full mb-3"><label htmlfor="grid-password" class="block uppercase text-gray-700 text-xs font-bold mb-2"> City </label><input type="email" value="New York" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" /></div>
										</div>
										<div class="w-full lg:w-4/12 px-4">
											<div class="relative w-full mb-3"><label htmlfor="grid-password" class="block uppercase text-gray-700 text-xs font-bold mb-2"> Country </label><input type="text" value="United States" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" /></div>
										</div>
										<div class="w-full lg:w-4/12 px-4">
											<div class="relative w-full mb-3"><label htmlfor="grid-password" class="block uppercase text-gray-700 text-xs font-bold mb-2"> Postal Code </label><input type="text" value="99524" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150" /></div>
										</div>
									</div>
									<hr class="mt-6 border-b-1 border-gray-400" />
									<h6 class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase">About Me</h6>
									<div class="flex flex-wrap">
										<div class="w-full lg:w-12/12 px-4">
											<div class="relative w-full mb-3">
												<label htmlfor="grid-password" class="block uppercase text-gray-700 text-xs font-bold mb-2"> About me </label>
												<textarea type="text" rows="4" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150">
                                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae quos ea eveniet dolor aperiam facilis ab dolorum suscipit asperiores temporibus in minima, placeat quod expedita saepe ad dignissimos eaque nobis.
                                                </textarea>
											</div>
										</div>
									</div>
								</form>
							</fieldset>
						</div>
					</div>
				</div>

				<div class="w-full lg:w-4/12 px-4">
					<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
						<div class="px-6">
							<div class="flex flex-wrap justify-center">
								<div class="w-full px-4 flex justify-center">
									<div class="relative">
										<img src="../assets/img/team-1-800x800.53033970.jpg" class="shadow-xl rounded-full border-none absolute -top-20 -left-20" />
									</div>
								</div>
								<div class="w-full px-4 text-center mt-20">
									<div class="flex justify-center py-4 lg:pt-4 pt-8">
										<div class="vue-stars text-3xl cursor-pointer flex-1">
											<span class="text-blue-700">★</span>
											<span class="text-blue-700">★</span>
											<span class="text-blue-700">★</span>
											<span class="text-gray-200 hover:text-blue-700">★</span>
										</div>
									</div>
								</div>
							</div>
							<div class="text-center mt-9">
								<h3 class="text-xl font-semibold leading-normal mb-2 text-gray-800 mb-2">Jenna Stones</h3>
								<div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase"><i class="fas fa-map-marker-alt mr-2 text-lg text-gray-500"></i> Los Angeles, California</div>
								<div class="mb-2 text-gray-700 mt-10"><i class="fas fa-briefcase mr-2 text-lg text-gray-500"></i> Solution/Account Manager - mouradCPA</div>
								<div class="mb-2 text-gray-700"><i class="fas fa-university mr-2 text-lg text-gray-500"></i> University of Computer Science</div>
							</div>
							<div class="mt-10 py-10 border-t border-gray-300 text-center">
								<div class="flex flex-wrap justify-center">
									<div class="w-full lg:w-9/12 px-4">
										<p class="mb-4 text-lg leading-relaxed text-gray-800">
											Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum perspiciatis nesciunt saepe animi iste odio iure, atque laboriosam voluptatibus dolore amet ex harum ratione voluptas modi cupiditate sed consequuntur quibusdam!
										</p>
										<a href="javascript:void(0);" class="font-normal text-green-500"> Show more </a>
									</div>
								</div>
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
		name: "Settings",
	};
</script>

<style scoped>
	img {
		min-width: 150px;
		min-height: 150px;
	}

	#settings {
		@apply p-3 pt-9;
		background: -webkit-gradient(linear, left top, left bottom, color-stop(74%, #f3f4f6), to(#1f2937));
		background: -o-linear-gradient(top, #f3f4f6 74%, #1f2937 100%);
		background: linear-gradient(to bottom, #f3f4f6 74%, #1f2937 100%);
	}
</style>
