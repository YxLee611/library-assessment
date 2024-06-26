import { defineStore } from 'pinia';
import axios from 'axios';
import { jwtDecode } from "jwt-decode";
import apiClient from '@/api/apiClient';

export const useAuthStore = defineStore('auth', {
	state: () => ({
		user: null,
		token: localStorage.getItem('auth_token') || null,
		alertType: '',
		alertMessage: '',
	}),

	actions: {
		async login(email, password) {
			try {
				const response = await apiClient.post('/api/login', { email, password });
				const { access_token, user } = response.data;

				this.user = user;
				this.token = access_token;

				// Save token using a dedicated method
				localStorage.setItem('auth_token', access_token);

				return true;
			} catch (error) {
				console.error('Login failed:', error);
				this.setAlertType('error');
				this.setAlertMessage(error.response.data.error);
				return false;
			}
		},

		logout() {
			this.user = null;
			this.token = null;
			localStorage.removeItem('auth_token');
		},

		setAlertType(type) {
			this.alertType = type;
		},

		setAlertMessage(message) {
			this.alertMessage = message;
		},

		handleTokenExpiration() {
            this.logout();
            this.setAlertType('error');
            this.setAlertMessage('Your session has expired. Please log in again.');
        },

		isTokenExpired() {
            if (!this.token) {
				console.log('test1');
                return true;
            }
            try {
                const decoded = jwtDecode(this.token);
                return decoded.exp < Date.now() / 1000;
            } catch (error) {
                return true;
            }
        },
	},
});
