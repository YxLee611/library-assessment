import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null
    }),

    actions: {
        async fetchUserData() {
            try {
                const response = await axios.get('/api/user');
                this.user = response.data.user;
            } catch (error) {
                console.error('Failed to fetch user data:', error);
            }
        }
    }
});
