<template>
    <div class="form-wrapper">
        <form @submit.prevent="login">
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
import { reactive } from 'vue';

export default {
    setup() {
        const formData = reactive({
            email: '',
            password: ''
        });

        const errors = reactive({
            email: '',
            password: ''
        });

        const login = () => {
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
                console.log('Success');
            }
        };

        const isValidEmail = (email) => {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        };

        return {
            formData,
            errors,
            login
        };
    }
};
</script>

<style lang="scss" scoped>
.form-wrapper {
    height: 100%;
    display: flex;
    align-items: center;
    background: #eee;

    form {
        max-width: 380px;
        padding: 40px 35px;
        margin: 0 auto;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,0.1); 
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
                color: red;
                font-size: 12px;
                padding-top: 8px;
                display: block;
            }
        }

        button {
            background-color: #428BCA;
            color: white;
            width: 100%;
            padding: 14px;
            border-radius: 30px;
            border: none;
            font-size: 16px;
        }
    }
}
</style>
