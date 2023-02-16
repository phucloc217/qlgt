import './bootstrap';
import {createApp} from 'vue'
import {createRouter, createWebHistory} from 'vue-router';
import App from './App.vue'
import './js/config'
import './bootstrap5';
import './helpers';
import './menu';
import './js/main';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/home',
            component: () => import('./pages/index.vue')
        },{
            path: '/login',
            component: () => import('./pages/login.vue')
        },
       
    ],
})

createApp(App).use(router).mount("#app")