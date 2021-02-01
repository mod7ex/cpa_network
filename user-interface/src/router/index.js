import { createRouter, createWebHistory } from "vue-router";

import store from "../store";

import Home from "../views/Home.vue";
import About from "../views/About.vue";
import Signup from "../views/Signup.vue";
import Login from "../views/Login.vue";
import Stats from "../views/Stats.vue";
import Dashboard from "../views/Dashboard.vue";
import AccountInfo from "../views/AccountInfo.vue";
import OffersListing from "../views/offer/OffersListing.vue";
import OfferDetails from "../views/offer/OfferDetails.vue";

const routes = [
	{
		path: "/",
		name: "Home",
		component: Home,
		meta: {
			requiresAuth: false,
			title: "Home",
		},
	},

	{
		path: "/about",
		name: "About",
		component: About,
		meta: {
			requiresAuth: false,
			title: "About Us",
		},
	},

	{
		path: "/signup",
		name: "Signup",
		component: Signup,
		meta: {
			requiresAuth: false,
			title: "Sign Up",
		},
	},

	{
		path: "/login",
		name: "Login",
		component: Login,
		meta: {
			requiresAuth: false,
			title: "Log In",
		},
	},

	{
		path: "/dashboard",
		name: "Dashboard",
		component: Dashboard,
		meta: {
			requiresAuth: true,
			title: "Dashboard",
		},
	},

	{
		path: "/accountInfo",
		name: "AccountInfo",
		component: AccountInfo,
		meta: {
			requiresAuth: true,
			title: "Account Information",
		},
	},

	{
		path: "/offers-listing",
		name: "OffersListing",
		component: OffersListing,
		meta: {
			requiresAuth: true,
			title: "Offers Listing",
		},
	},

	{
		path: "/offer-details/:id",
		name: "OfferDetails",
		component: OfferDetails,
		meta: {
			requiresAuth: true,
		},
	},

	{
		path: "/stats",
		name: "Stats",
		component: Stats,
		meta: {
			requiresAuth: true,
			title: "statistics",
		},
	},
];

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes,
});

router.beforeEach((to, from, next) => {
	if (to.matched.some((record) => record.meta.requiresAuth)) {
		if (!store.getters.isLoggedIn) {
			next({ name: "Login" });
		} else {
			next();
		}
	} else {
		if (!store.getters.isLoggedIn) {
			next();
		} else {
			return;
		}
	}

	document.title = to.meta.title || "MouradCPA";
});

export default router;
