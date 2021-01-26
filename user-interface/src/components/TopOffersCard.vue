<template>
    <div id="sliderContainer" class="rounded m-3 shadow bg-white">
        <div class="flex items-center p-3 rounded-t bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z"/></svg>
            <h1 class="font-black ml-3 text-yellow-500">Top Offers</h1>
        </div>
        <div class="px-5" id="slider">

            <div v-for="k in numberOfSlides" :key="k">

                <transition name="slide-fade">
                    <div v-if="currentSlide == k" :class="'slide-item'+k"></div>
                </transition>

            </div>

            <div class="flex">
                <svg v-for="k in numberOfSlides" :key="k"  @click="currentSlide = k" class="fill-current mx-1" :class="{'text-white ': currentSlide == k}" width="24" height="24" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" fill-rule="evenodd" clip-rule="evenodd"><circle serif:id="shape 19" cx="9" cy="9" r="9"/></svg>
            </div>

        </div>
    </div>
</template>



<script>

export default {
    name: 'Slider',

    data() {
        return {
            currentSlide: 1,
            numberOfSlides: 3,
        }
    },

    computed: {
        numOfSlides(){
            return document.querySelectorAll('#slider > div').length
        }
    },

    mounted(){      
        
        this.timeIntervall = setInterval(() => {
            this.currentSlide %= this.numberOfSlides
            this.currentSlide += 1
        }, 4000)
    },
    
    beforeUnmount(){
        clearInterval(this.timeIntervall)
    }

}
</script>



<style scoped>
body{
  overflow: hidden;
}

#slider{
    position: relative;
}

#slider > div:last-of-type{
    position: absolute;
    top: 310px;
    left: 43%;
}

#slider > div > div{
    position: absolute;
    width: 100%;
    height: 300px;
    top: 0;
    left: 0;
}

#sliderContainer{
    max-width: 700px;
    min-width: 300px;
    height: 400px;
}

.slide-item1{
    background-color: greenyellow;
}

.slide-item2{
    background-color: blue;
}

.slide-item3{
    background-color: red;
}



/* VueJs Css Text */
/* .fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
} */

/* VueJs Css Slide */
.slide-fade-enter-active {
  transition: all 0.8s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from {
  opacity: 0;
  transform: translateX(100%);
}

.slide-fade-leave-to {
  opacity: 0;
  transform: translateX(-100%);
}

</style>