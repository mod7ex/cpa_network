<template>
  <form class="bg-white mt-10 mx-auto px-6 py-10 shadow-md rounded text-gray-700" @submit.prevent="submitForm">
      <h1 class="text-3xl font-black mb-3 text-center">Sign Up</h1>
      <hr class="mb-3">
      <div class="mb-10">
          <label for="first_name" class="py-4">First Name</label>
          <input v-model="signupForm.first_name" type="text" id="first_name" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="first name">
      </div>
      <div class="mb-10">
          <label for="first_name" class="py-4">Last Name</label>
          <input v-model="signupForm.last_name" type="text" id="last_name" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="last name">
      </div>
      <div class="mb-10">
          <label for="email" class="py-4">E-mail</label>
          <input v-model="signupForm.email" type="email" id="email" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="email address">
      </div>
      <div class="mb-10">
          <label for="website" class="py-4">Website (optional)</label>
          <input v-model="signupForm.website" type="text" id="website" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="web site">
      </div>
      <div class="mb-10">
          <label for="country" class="py-4">Country</label>
          <input type="text" id="country" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="country">
      </div>
      <div class="mb-10">
          <label for="street_address" class="py-4">Street address</label>
          <input v-model="signupForm.street_address" type="text" id="street_address" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Street address">
      </div>
      <div class="mb-10">
          <label for="city" class="py-4">City</label>
          <input v-model="signupForm.city" type="text" id="city" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="city">
      </div>
      <div class="mb-10">
          <label for="region" class="py-4">Region or State</label>
          <input v-model="signupForm.region" type="text" id="region" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Region or state">
      </div>
      <div class="mb-10">
          <label for="zip_code" class="py-4">Zip code (postal code)</label>
          <input v-model="signupForm.zip_code" type="text" id="zip_code" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Zip code (postal code)">
      </div>
      <div class="mb-5">
          <label for="phone_number" class="py-4">Phone number</label>
          <input v-model="signupForm.phone_number" type="text" id="phone_number" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Phone number">
      </div>
      <div class="mb-5 text-center">
        <small>fill one or the other or both</small>
      </div>
      <div class="mb-10">
          <label for="skype" class="py-4">Skype</label>
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.748 13.648c0 1.773-1.414 2.935-3.523 2.935-1.855 0-3.721-.845-3.711-2.299.002-.439.328-.841.763-.841 1.093 0 1.083 1.63 2.822 1.63 1.221 0 1.638-.669 1.638-1.134 0-1.684-5.275-.652-5.275-3.817 0-1.713 1.401-2.895 3.604-2.765 2.101.124 3.332 1.052 3.451 1.918.059.566-.316 1.007-.968 1.007-.95 0-1.047-1.272-2.684-1.272-.738 0-1.361.308-1.361.977 0 1.397 5.244.586 5.244 3.661zm8.252-1.648c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-5.591 1.147c.792-4.53-3.159-8.407-7.614-7.571-3.396-2.077-7.293 1.882-5.21 5.267-.811 4.519 3.139 8.447 7.631 7.589 3.401 2.062 7.287-1.902 5.193-5.285z"/></svg>
            <input v-model="signupForm.skype" type="text" id="skype" class="ml-4 flex-grow px-2 py-2 shadow-md outline-none border rounded" placeholder="Skype">
          </div>
      </div>
      <div class="mb-10">
          <label for="telegram" class="py-4">Telegram</label>
          <div class="flex items-center">
            <svg width="24px" height="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><path id="telegram-4" d="M12,0c-6.626,0 -12,5.372 -12,12c0,6.627 5.374,12 12,12c6.627,0 12,-5.373 12,-12c0,-6.628 -5.373,-12 -12,-12Zm3.224,17.871c0.188,0.133 0.43,0.166 0.646,0.085c0.215,-0.082 0.374,-0.267 0.422,-0.491c0.507,-2.382 1.737,-8.412 2.198,-10.578c0.035,-0.164 -0.023,-0.334 -0.151,-0.443c-0.129,-0.109 -0.307,-0.14 -0.465,-0.082c-2.446,0.906 -9.979,3.732 -13.058,4.871c-0.195,0.073 -0.322,0.26 -0.316,0.467c0.007,0.206 0.146,0.385 0.346,0.445c1.381,0.413 3.193,0.988 3.193,0.988c0,0 0.847,2.558 1.288,3.858c0.056,0.164 0.184,0.292 0.352,0.336c0.169,0.044 0.348,-0.002 0.474,-0.121c0.709,-0.669 1.805,-1.704 1.805,-1.704c0,0 2.084,1.527 3.266,2.369Zm-6.423,-5.062l0.98,3.231l0.218,-2.046c0,0 3.783,-3.413 5.941,-5.358c0.063,-0.057 0.071,-0.153 0.019,-0.22c-0.052,-0.067 -0.148,-0.083 -0.219,-0.037c-2.5,1.596 -6.939,4.43 -6.939,4.43Z"/></svg>
            <input v-model="signupForm.telegram" type="text" id="telegram" class="ml-4 flex-grow px-2 py-2 shadow-md outline-none border rounded" placeholder="Telegram">
          </div>
      </div>
      <div class="mb-10">
          <label for="password" class="py-4">Password</label>
          <input v-model="signupForm.password" type="password" id="password" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Strong Password">
      </div>
      <div class="mb-10">
          <label for="password_confirmation" class="py-4">Confirm Password</label>
          <input v-model="signupForm.password_confirmation" type="password" id="password_confirmation" class="min-w-full px-2 py-2 shadow-md outline-none border rounded" placeholder="Password Confirmation">
      </div>
      <div class="mb-10 flex items-center">
        <label class="inline-flex items-center">
            <input v-model="signupForm.terms_conditions" type="checkbox" class="h-5 w-5">
            <span class="ml-2 text-gray-700">
              <small>
                Accept
                <span class="font-bold underline">
                  <router-link :to="{name: ''}">Terms & Conditions</router-link>
                </span>
              </small>
            </span>
        </label>
      </div>
      <div class="mb-10">
          <input type="submit" class="min-w-full text-white cursor-pointer px-2 py-2 shadow-md outline-none bg-gray-900 rounded" value="Sign Up">
      </div>
      <div class="flex justify-between px-6">
          <small class="font-bold underline">
              <router-link :to="{name: ''}" >Have an account? Login</router-link>
          </small>
      </div>
  </form>
</template>



<script>
import { ref } from "vue"

export default {
    name: 'Signup',

    setup(){
      let signupForm = ref({
        first_name: null,
        last_name: null,
        website: null,
        country_id: null,
        street_address: null,
        city: null,
        region: null,
        zip_code: null,
        phone_number: null,
        skype: null,
        telegram: null,

        email: null,
        password: null,
        password_confirmation: null,

        terms_conditions: false,
      })

      let submitForm = () => {
        console.log(signupForm.value)
      }

      return {
        signupForm,
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