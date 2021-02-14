import { createStore } from "vuex";

import auth from "./auth";
import stats from "./stats";
import offers from "./offers";
import users from "./users";

export default createStore({
	state: {},

	mutations: {},

	getters: {},

	actions: {},

	modules: {
		auth,
		stats,
		offers,
		users,
	},
});
