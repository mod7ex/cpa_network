<template>
  <form class="bg-white mt-10 mx-auto px-6 py-10 shadow-md rounded text-gray-700" @submit.prevent="submitForm">
      <h1 class="text-3xl font-black mb-3 text-center">Log In</h1>
      <hr class="mb-3">
      <div class="mb-10">
          <label for="email" class="py-4">E-mail</label>
          <input type="email" id="email" v-model="loginForm.email" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="email address">
      </div>
      <div class="mb-10">
          <label for="password" class="py-4">Password</label>
          <input type="password" id="password" v-model="loginForm.password" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="password">
      </div>
      <div class="mb-10 flex items-center">
        <label class="inline-flex items-center">
            <input type="checkbox" class="h-5 w-5" v-model="loginForm.remember">
            <span class="ml-2 text-gray-700">Remeber me</span>
        </label>
      </div>
      <div class="mb-10">
          <input type="submit" class="min-w-full text-white cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-900 rounded" value="Log In">
      </div>
      <div class="flex justify-between px-6">
          <small class="font-bold underline">
              <router-link :to="{name: ''}" >Forgot password?</router-link>
          </small>
          <small class="opacity-70">or</small>
          <small class="font-bold underline">
              <router-link :to="{name: ''}" >Create an account</router-link>
          </small>
      </div>
  </form>
</template>



<script>
import { ref } from "vue"

export default {
    name: 'Login',

    setup(){
        let loginForm = ref({
            email: null,
            password: null,
            remember: false,
        })

        let submitForm = () => {
            console.log(loginForm.value)
        }


        return {
            loginForm,
            submitForm
        }
    }

}
</script>



<style scoped>
form{
    max-width: 500px;
}
</style>