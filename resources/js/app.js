import "./bootstrap";
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '../scss/colors.scss';
import '../scss/main.scss';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';

const app = createApp(App);

const pinia = createPinia();

app.use(pinia);
app.use(router);
app.mount('#app');
