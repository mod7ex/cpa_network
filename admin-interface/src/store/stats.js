export default {
	state: {
		today: null,

		topOffers: null,

		topUsers: null,
	},

	mutations: {
		fillTodayStats(state, payload) {
			state.today = payload;
		},

		fillTopOffers(state, payload) {
			state.topOffers = payload;
		},

		fillTopUsers(state, payload) {
			state.topUsers = payload;
		},
	},

	getters: {
		TODAY(state) {
			return state.today;
		},

		// Today
		TODAY_CLICKS(state) {
			if (state.today) {
				return state.today.today.reduce((acc, elm) => {
					return acc + elm.count;
				}, 0);
			}

			return null;
		},

		TODAY_CONVERSIONS(state) {
			if (state.today) {
				return state.today.today.reduce((acc, elm) => {
					return elm.count * Number(elm.converted) + acc;
				}, 0);
			}

			return null;
		},

		TODAY_EARNINGS(state) {
			if (state.today) {
				return (
					state.today.today.reduce((acc, elm) => {
						return elm.earnings + acc;
					}, 0) / 100
				);
			}

			return null;
		},

		// Yesterday
		YESTERDAY_CLICKS(state) {
			if (state.today) {
				return state.today.yesterday.reduce((acc, elm) => {
					return acc + elm.count;
				}, 0);
			}

			return null;
		},

		YESTERDAY_CONVERSIONS(state) {
			if (state.today) {
				return state.today.yesterday.reduce((acc, elm) => {
					return elm.count * Number(elm.converted) + acc;
				}, 0);
			}

			return null;
		},

		YESTERDAY_EARNINGS(state) {
			if (state.today) {
				return (
					state.today.yesterday.reduce((acc, elm) => {
						return elm.earnings + acc;
					}, 0) / 100
				);
			}

			return null;
		},

		TOP_OFFERS(state) {
			return state.topOffers;
		},

		TOP_USERS(state) {
			return state.topUsers;
		},
	},

	actions: {
		fetchTodayStats(context) {
			return new Promise((resolve, reject) => {
				api.get("stats/today").then((resp) => {
					context.commit("fillTodayStats", resp.data);
					resolve();
				});
			});
		},

		fetchTopOffers(context) {
			return new Promise((resolve, reject) => {
				api.get("stats/top-offers").then((resp) => {
					context.commit("fillTopOffers", resp.data);
					resolve();
				});
			});
		},

		fetchTopUsers(context) {
			return new Promise((resolve, reject) => {
				api.get("stats/top-users").then((resp) => {
					context.commit("fillTopUsers", resp.data);
					resolve();
				});
			});
		},
	},
};
