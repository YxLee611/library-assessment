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
                    <p>User Name</p>
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
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Books</a></li>
                        <li><a href="#">Users</a></li>
                        <li><a href="#">Resources</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Settings</a></li>
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
import { useAuthStore } from '@/stores/authStore';
import { useRouter } from 'vue-router';

export default {
    name: 'DefaultLayout',

    setup() {
        const authStore = useAuthStore();
        const router = useRouter();

        const handleLogout = () => {
            authStore.logout();
            router.push('/');
        };

        return {
            handleLogout
        };
    }
}
</script>