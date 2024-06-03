<template>
    <div>
        <header>
            <nav class="navbar">
                <div class="library-name">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <p>Library Test</p>
                </div>

                <div class="user-name">
                    <p>{{ userName }}</p>
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <nav class="sidebar">
                 <div class="sidebar-content">
                    <ul class="sidebar-menu">
                        <template v-for="item in sidebarMenu" :key="item.id">
                            <a :href="item.link">
                                <li>{{ item.label }}</li>
                            </a>
                        </template>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    <p class="logout" @click="handleLogout">Logout</p>
                </div>
            </nav>
            <div class="dashboard-container">
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script>
import { useUserStore } from '@/stores/userStore';
import { useAuthStore } from '@/stores/authStore';
import { useRouter } from 'vue-router';
import { onMounted, computed } from 'vue';

export default {
    name: 'DefaultLayout',

    setup() {
        const userStore = useUserStore();
        const authStore = useAuthStore();
        const router = useRouter();

        onMounted(async () => {
            await userStore.fetchUserData();
        });

        const adminSidebarMenu = [
            { id: 1, label: 'Dashboard', link: '/dashboard' },
            { id: 2, label: 'Books', link: '/books' },
            { id: 3, label: 'Users', link: '/users' },
        ];

        const userSidebarMenu = [
            { id: 1, label: 'Dashboard', link: '/dashboard' },
            { id: 2, label: 'Books', link: '/books' },
            { id: 3, label: 'Borrowed Books', link: '/borrowed-books' },
        ];

        const isAdmin = computed(() => userStore.user?.role_id === 1);
        const sidebarMenu = computed(() => {
            return isAdmin.value ? adminSidebarMenu : userSidebarMenu;
        });

        const handleLogout = () => {
            authStore.logout();
            router.push('/');
        };

        const userName = computed(() => userStore.user?.name);

        return {
            sidebarMenu,
            userName,
            handleLogout
        };
    }
};
</script>