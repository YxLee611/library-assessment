import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from '@/stores/authStore';
import DefaultLayout from './layouts/default.vue';
import Login from './page/Login.vue';
import Dashboard from './page/Dashboard.vue';

const routes = [
    {
        path: "/",
        component: Login,
    },
    {
        path: '/dashboard',
        component: Dashboard,
        meta: { requiresAuth: true, layout: DefaultLayout },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    
    if (to.meta.requiresAuth && !authStore.token) {
        next('/');
    } 
    else if (to.path === '/' && authStore.token) {
        next('/dashboard');
    }
    else {
        next();
    }
});


export default router;
