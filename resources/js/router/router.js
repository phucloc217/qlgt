import {createRouter, createWebHistory} from 'vue-router';
import DefaultLayout from '../pages/index.vue'
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: DefaultLayout,
            redirect: '/thongke',
            children: [
              {
                path: '/thongke',
                name: 'Thongke',
                component: () =>
                  import('../pages/Dashboard.vue'),
              }],
        },
        {
            path: '/login',
            component: () => import('../pages/login.vue')
        },
    ],
})
export default router