import { createRouter, createWebHistory } from "vue-router";

import Login from "@/views/Login.vue";
import Dashboard from "@/views/Dashboard.vue";
import Settings from "@/views/Settings.vue";

import Users from "@/views/user/Users.vue";
import Offers from "@/views/offer/Offers.vue";
import User from "@/views/user/User.vue";
import Offer from "@/views/offer/Offer.vue";

const routes = [
	{
		path: "/",
		name: "Login",
		component: Login,
	},

	{
		path: "/dashboard",
		name: "Dashboard",
		component: Dashboard,
	},

	{
		path: "/users",
		name: "Users",
		component: Users,
	},

	{
		path: "/offers",
		name: "Offers",
		component: Offers,
	},

	{
		path: "/settings",
		name: "Settings",
		component: Settings,
	},

	{
		path: "/offer/:id",
		name: "Offer",
		component: Offer,
	},

	{
		path: "/user/:id",
		name: "User",
		component: User,
	},
];

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes,
});

export default router;
