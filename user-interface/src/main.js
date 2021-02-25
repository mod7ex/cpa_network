/*
 *
 *
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

// Date.prototype.getWeekNumber = function() {
// 	var d = new Date(Date.UTC(this.getFullYear(), this.getMonth(), this.getDate()));
// 	var dayNum = d.getUTCDay() || 7;
// 	d.setUTCDate(d.getUTCDate() + 4 - dayNum);
// 	var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
// 	return Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
// };

//  ***********************************************@(:^-^:)@***********************************************  \\

import { createApp } from "vue";

import App from "./App.vue";
import router from "./router";
import store from "./store";
import Block from "./components/atomic/Block.vue";
import "./assets/css/tailwind.css";

const app = createApp(App);

app.component("Block", Block);

store.dispatch("checkMeOut").finally(() => {
	app.use(store);
	app.use(router);
	app.mount("#app");
});
