import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from '@/stores/authStore';
import DefaultLayout from './layouts/default.vue';
import Login from './page/Login.vue';
import Dashboard from './page/Dashboard.vue';
import Users from './page/Users.vue';
import Books from './page/Books.vue';
import BorrowedBooks from './page/BorrowedBooks.vue';

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
    {
        path: '/books',
        component: Books,
        meta: { requiresAuth: true, layout: DefaultLayout },
    },
    {
        path: '/users',
        component: Users,
        meta: { requiresAuth: true, layout: DefaultLayout },
    },
    {
        path: '/borrowed-books',
        component: BorrowedBooks,
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
    
    // if (authStore.token) {
    //     if (authStore.isTokenExpired()) {
    //         authStore.handleTokenExpiration();
    //         next('/');
    //     } else if (to.path === '/') {
    //         next('/dashboard');
    //     } else {
    //         next();
    //     }
    // } else if (to.meta.requiresAuth) {
    //     next('/');
    // } else {
    //     next();
    // }
});


export default router;
