export default {
	state: {
		offers: null,

		filter: null,
	},

	mutations: {
		fillOffers(state, offers) {
			state.offers = offers;
		},

		fillFilter(state, filter) {
			state.filter = filter;
		},
	},

	getters: {
		OFFERS(state) {
			return state.offers;
		},

		FILTER(state) {
			return state.filter;
		},
	},

	actions: {
		fetchOffers(context) {
			return new Promise((resolve, reject) => {
				api.get("/offers").then((resp) => {
					context.commit("fillOffers", resp.data);
					resolve();
				});
			});
		},

		fetchOffersFilter(context) {
			return new Promise((resolve, reject) => {
				api.get("/offersfilter").then((resp) => {
					context.commit("fillFilter", resp.data);
					resolve();
				});
			});
		},
	},
};
