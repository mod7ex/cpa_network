import { createStore } from "vuex";

export default createStore({
	state: {
		me: null,

		tokenRefresherInterval: null,

		offers: [],
		allOffers: [],

		offersFilter: null,

		statsTools: null,

		filteredStats: null,
		donutStats: null,
		todayStats: null,
	},

	mutations: {
		fillMe(state, me) {
			state.me = me;
		},

		fillTodayStats(state, payload) {
			state.todayStats = payload;
		},

		fillStatsTools(state, payload) {
			state.statsTools = payload;
		},

		fillFilteredStats(state, filteredStats) {
			state.filteredStats = filteredStats;
		},

		fillDonutStats(state, donutStats) {
			state.donutStats = donutStats;
		},

		resetOffers(state) {
			state.offers = state.allOffers;
		},

		fillOffers(state, offers) {
			state.offers = offers;
			state.allOffers = offers;
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

		fillOffersFilter(state, offersFilter) {
			state.offersFilter = offersFilter;
		},

		filterOffers(state, payload) {
			state.offers = state.allOffers.filter((offer) => {
				for (let key in payload) {
					if (!offer[`${key}_ids`].includes(payload[key])) {
						return false;
					}
				}
				return true;
			});
		},

		filterOffersByTextSearch(state, payload) {
			state.offers = state.allOffers.filter((offer) => {
				return offer.name.includes(payload);
			});
		},
	},

	getters: {
		isLoggedIn(state) {
			return state.me ? true : false;
		},

		STATS_TOOLS(state) {
			return state.statsTools;
		},

		ACCESS_TOKEN(state) {
			return localStorage.getItem("ACCESS_TOKEN");
		},

		offers(state) {
			return state.offers;
		},

		offersFilter(state) {
			return state.offersFilter;
		},

		ME(state) {
			return state.me;
		},

		TODAY_CONVERSIONS(state) {
			if (state.todayStats && state.todayStats.length) {
				return state.todayStats.filter((item) => {
					if (item.converted) return item;
				});
			} else {
				return null;
			}
		},

		TODAY(state) {
			let today = {
				clicks: 0,
				conversions: 0,
			};

			if (state.todayStats && state.todayStats.length) {
				state.todayStats.forEach((item) => {
					today.clicks += item.count;
					if (item.converted) {
						today.conversions += item.count;
					}
				});
			}

			return today;
		},

		TODAY_CLICKS(state) {
			if (state.todayStats && state.todayStats.length) {
				return state.todayStats;
			} else {
				return null;
			}
		},

		FILTERD_STATS(state) {
			if (state.filteredStats && state.filteredStats.length) {
				return state.filteredStats;
			} else {
				return null;
			}
		},

		DONUT_STATS(state) {
			if (state.donutStats && state.donutStats.length) {
				return {
					labels: state.donutStats.map((item) => {
						return item.vertical_name;
					}),

					data: state.donutStats.map((item) => {
						return item.count;
					}),
				};
			} else {
				return null;
			}
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

		fetchOffers(context) {
			return new Promise((resolve, reject) => {
				api.defaults.headers.common["Authorization"] = `Bearer ${context.getters.ACCESS_TOKEN}`;

				api.get(`/offers`).then((resp) => {
					context.commit("fillOffers", resp.data);
					resolve();
				});
			});
		},

		fetchOffersFilters(context) {
			return new Promise((resolve, reject) => {
				api.defaults.headers.common["Authorization"] = `Bearer ${context.getters.ACCESS_TOKEN}`;
				api.get("/offersfilter").then((resp) => {
					context.commit("fillOffersFilter", resp.data);
					resolve();
				});
			});
		},

		fetchTodayStats(context) {
			return new Promise((resolve, reject) => {
				api.defaults.headers.common["Authorization"] = `Bearer ${context.getters.ACCESS_TOKEN}`;

				api.get("/stats/today").then((resp) => {
					context.commit("fillTodayStats", resp.data);
					resolve();
				});
			});
		},

		fetchFilteredStats(context, filter) {
			return new Promise((resolve, reject) => {
				api.defaults.headers.common["Authorization"] = `Bearer ${context.getters.ACCESS_TOKEN}`;

				api.post("/stats/filtered", filter).then((resp) => {
					context.commit("fillFilteredStats", resp.data);
					resolve();
				});
			});
		},

		fetchDonutStats(context, filter) {
			return new Promise((resolve, reject) => {
				api.defaults.headers.common["Authorization"] = `Bearer ${context.getters.ACCESS_TOKEN}`;

				api.post("/stats/donut", filter).then((resp) => {
					context.commit("fillDonutStats", resp.data);
					resolve();
				});
			});
		},
	},
});
