export default {
	state: {
		users: null,
	},

	mutations: {
		fillUsers(state, users) {
			state.users = users;
		},
	},

	getters: {
		USERS(state) {
			return state.users;
		},
	},

	actions: {
		fetchUsers(context) {
			return new Promise((resolve, reject) => {
				api.get("/users").then((resp) => {
					context.commit("fillUsers", resp.data);
					resolve();
				});
			});
		},
	},
};
