/*
 * Axios & api
 */

// import axios from 'axios'
const axios = require("axios");

// use axios globally with a configue
window.api = axios.create({
	baseURL: "http://127.0.0.1:8000/api",
	timeout: 3000,
	headers: {
		Accept: "application/json",
	},
});

//  ***********************************************@(:^-^:)@***********************************************  \\

import { createApp } from "vue";

import App from "./App.vue";
import router from "./router";
import store from "./store";
import "./assets/css/tailwind.css";

const app = createApp(App);

store.dispatch("checkMeOut").finally(() => {
	app.use(store);
	app.use(router);
	app.mount("#app");
});
