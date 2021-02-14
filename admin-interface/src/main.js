/*
 * Axios & api
 */

// import axios from 'axios'
const axios = require("axios");

// use axios globally with a configue
window.api = axios.create({
	baseURL: "http://127.0.0.1:8000/api/admin",
	timeout: 3000,
	headers: {
		Accept: "application/json",
	},
});

//  ***********************************************@(:^-^:)@***********************************************  \\

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
