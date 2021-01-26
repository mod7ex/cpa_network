import { createStore } from "vuex";

export default createStore({
	state: {
		me: null,

		tokenRefresherInterval: null,
	},

	mutations: {
		fillMe(state, me) {
			state.me = me;
		},

		clearMe(state) {
			state.me = null;
		},

		setTokenRefresherInterval(state, interval) {
			state.tokenRefresherInterval = interval;
		},

		clearTokenRefresherInterval(state) {
			clearInterval(state.tokenRefresherInterval);
			state.tokenRefresherInterval = null;
		},
	},

	getters: {
		isLoggedIn(state) {
			return state.me ? true : false;
		},

		ACCESS_TOKEN() {
			return localStorage.getItem("ACCESS_TOKEN");
		},

		ME(state) {
			return state.me;
		},
	},

	actions: {
		handleToken(context, data) {
			localStorage.setItem("ACCESS_TOKEN", data.access_token);

			if (!isNaN(data.expires_in) && data.expires_in > 0) {
				context.commit(
					"setTokenRefresherInterval",

					setInterval(() => {
						api.post(`/auth/refresh`).then((resp) => {
							localStorage.setItem("ACCESS_TOKEN", resp.data.access_token);
						});
					}, (data.expires_in * 500 * 5) / 3)
				);
			}
		},

		checkMeOut(context) {
			return new Promise((resolve, reject) => {
				if (context.getters.ACCESS_TOKEN) {
					api.defaults.headers.common["Authorization"] = `Bearer ${context.getters.ACCESS_TOKEN}`;
					api.post(`/auth/me`)
						.then((res) => {
							context.commit("fillMe", res.data);
							resolve();
						})
						.catch((err) => {
							reject(err);
						});
				} else {
					reject();
				}
			});
		},

		register(context, data) {
			return new Promise((resolve, reject) => {
				api.post(`/auth/register`, data)
					.then((res) => {
						return context.dispatch("handleToken", res.data);
					})
					.then(() => {
						return context.dispatch("checkMeOut");
					})
					.then(() => {
						resolve();
					})
					.catch((err) => {
						reject(err);
					});
			});
		},

		login(context, data) {
			return new Promise((resolve, reject) => {
				api.post(`/auth/login`, data)
					.then((resp) => {
						return context.dispatch("handleToken", resp.data);
					})
					.then(() => {
						return context.dispatch("checkMeOut");
					})
					.then(() => {
						resolve();
					});
			});
		},

		logout(context) {
			return new Promise((resolve, reject) => {
				api.defaults.headers.common["Authorization"] = `Bearer ${context.getters.ACCESS_TOKEN}`;
				api.post(`/auth/logout`).then((resp) => {
					context.commit("clearTokenRefresherInterval");
					localStorage.clear();
					context.commit("clearMe");
					resolve();
				});
			});
		},
	},
});
