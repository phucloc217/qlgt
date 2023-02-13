import './bootstrap';
import {createApp} from 'vue'
import {createRouter, createWebHistory} from 'vue-router';
import App from './App.vue'
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/home',
            component: () => import('./pages/index.vue')
        },
       
    ],
})

createApp(App).use(router).mount("#app")