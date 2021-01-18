<template>
  <HomeNav />
  <router-view />
</template>


<script>
import HomeNav from "./components/HomeNav"

export default {
  name: 'App',

  components: {HomeNav},

}
</script>




<style>


</style>