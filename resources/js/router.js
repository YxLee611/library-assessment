import { createRouter, createWebHistory } from "vue-router";
import DefaultLayout from './layouts/default.vue';

const routes = [
    {
        path: "/",
        component: () => import("./page/Login.vue"),
    },
    {
        path: "/dashboard",
        component: () => import("./page/Dashboard.vue"),
        meta: { layout: DefaultLayout },
    },
    {
        path: "/test",
        component: () => import("./page/TestRoute.vue"),
        meta: { layout: DefaultLayout },
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
