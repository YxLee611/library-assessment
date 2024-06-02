<template>
    <Alert v-if="alertMessage && showAlert" :type="alertType" :message="alertMessage" />
    <div class="form-wrapper">
        <form @submit.prevent="handleLogin">
            <h1>Login</h1>
            <div>
                <label>Email</label>
                <input type="email" v-model="formData.email" placeholder="Email" required/>
                <span v-if="errors.email" class="error">{{ errors.email }}</span>
            </div>

            <div>
                <label>Password</label>
                <input type="password" v-model="formData.password" placeholder="Password" required/>
                <span v-if="errors.password" class="error">{{ errors.password }}</span>
            </div>

            <button type="submit">
                Login
            </button>
        </form>
    </div>
</template>

<script>
import { reactive, computed, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/authStore';
import Alert from '@/components/Alert.vue'; 

export default {
    components: {
        Alert
    },
    setup() {
        const formData = reactive({
            email: '',
            password: '',
        });

        const errors = reactive({
            email: '',
            password: '',
        });

        const authStore = useAuthStore();
        const router = useRouter();
        const showAlert = ref(false);

        const handleLogin = async () => {
            errors.email = '';
            errors.password = '';

            if (!formData.email) {
                errors.email = 'Email is required';
            } else if (!isValidEmail(formData.email)) {
                errors.email = 'Invalid email format';
            }

            if (!formData.password) {
                errors.password = 'Password is required';
            } else if (formData.password.length < 6) {
                errors.password = 'Password must be at least 6 characters long';
            }

            if (!errors.email && !errors.password) {
                const success = await authStore.login(formData.email, formData.password);
                if (success) {
                    router.push('/dashboard');
                } else {
                    showAlert.value = true;
                    setTimeout(() => {
                        showAlert.value = false;
                    }, 5000);
                }
            }
        };

        const isValidEmail = (email) => {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        };

        const alertType = computed(() => authStore.alertType);
        const alertMessage = computed(() => authStore.alertMessage);

        return {
            formData,
            errors,
            handleLogin,
            showAlert,
            alertType,
            alertMessage
        };
    },
};
</script>

<style lang="scss" scoped>
.form-wrapper {
    height: 100%;
    display: flex;
    align-items: center;
    background: var(--grey1);

    form {
        max-width: 380px;
        padding: 40px 35px;
        margin: 0 auto;
        background-color: var(--white);
        border: 1px solid var(--black1);
        width: 100%;

        h1 {
            margin-bottom: 36px;
        }

        div {
            margin-bottom: 28px;
            
            label {
                display: block;
                margin-bottom: 8px;
            }

            input {
                font-size: 16px;
                height: auto;
                padding: 10px;
                width: 100%;
            }

            span {
                color: var(--red3);
                font-size: 12px;
                padding-top: 8px;
                display: block;
            }
        }

        button {
            background-color: var(--blue1);
            color: var(--white);
            width: 100%;
            padding: 14px;
            border-radius: 30px;
            border: none;
            font-size: 16px;
        }
    }
}
</style>
