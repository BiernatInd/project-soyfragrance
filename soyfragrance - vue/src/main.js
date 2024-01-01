import { createApp } from 'vue';
import App from './App.vue';
import router from './router/router';
import store from '../vuex/vuex-functions'; // Import the Vuex store

createApp(App).use(router).use(store).mount('#app');
