export default {
	state: {
		offers: null,
	},

	mutations: {
		fillOffers(state, offers) {
			state.offers = offers;
		},
	},

	getters: {
		OFFERS(state) {
			return state.offers;
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
	},
};
