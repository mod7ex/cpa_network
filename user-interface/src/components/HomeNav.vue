<template>
  <nav class="bg-gray-900 text-gray-300 px-5 py-5 flex justify-between items-center">

    <router-link :to="{name: 'Home'}"><h1 class="font-black text-3xl">MouradCPA</h1></router-link>

    <ul class="flex items-center">
      <li class="mr-8">

        <div class="relative">

            <button @click="isMenueVisible = !isMenueVisible" @blur="isMenueVisible = !isMenueVisible" class="bg-blue-800 rounded  flex justify-between items-center px-3 py-2 focus:outline-none hover:opacity-70">
              <span>More ...</span>

              <svg class="h-4 ml-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                <g>
                  <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/>
                </g>
              </svg>

            </button>

            <div v-if="isMenueVisible" class="rounded shadow-md absolute min-w-full bg-white mt-1">
                <ul>
                  <li class="px-4 py-2 block text-black cursor-pointer hover:bg-gray-400"><router-link :to="{name: ''}">Contact</router-link></li>
                  <li class="px-4 py-2 block text-black cursor-pointer hover:bg-gray-400"><router-link :to="{name: ''}">Advertise</router-link></li>
                  <li class="px-4 py-2 block text-black cursor-pointer hover:bg-gray-400"><router-link :to="{name: 'About'}">About Us</router-link></li>
                </ul>
            </div>

        </div>

      </li>

      <li class="mr-8"><router-link :to="{name: 'Signup'}">Sign up</router-link></li>

      <li class="bg-green-700 px-3 rounded py-2 hover:opacity-70"><router-link :to="{name: 'Login'}">Log In</router-link></li>

    </ul>
  </nav>
</template>



<script>
import { ref } from "vue"

export default {
  name: 'HomeNav',

  setup(){
    let isMenueVisible = ref(false);


    return {
      isMenueVisible
    }
  }

}
</script>

<style scoped>

</style>