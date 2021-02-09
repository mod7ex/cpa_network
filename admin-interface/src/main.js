import { createApp } from "vue";

import "./assets/tailwind.css";
import "./assets/all";

import Admin from "./layouts/Admin.vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

const app = createApp(App);

app.component("Admin", Admin);

app.use(store)
	.use(router)
	.mount("#app");
