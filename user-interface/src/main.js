import { createApp } from 'vue'

import { ValidationProvider } from 'vee-validate';
import { ValidationObserver } from 'vee-validate';

import App from './App.vue'
import router from './router'
import store from './store'
import "./assets/css/tailwind.css"



createApp(App)
    .component(ValidationProvider, "ValidationProvider")
    .component(ValidationObserver, "ValidationObserver")
    .use(store)
    .use(router)
    .mount('#app')
