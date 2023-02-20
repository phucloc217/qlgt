import {createRouter, createWebHistory,createWebHashHistory,createMemoryHistory } from 'vue-router';
import DefaultLayout from '../pages/index.vue'
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            name: 'Trang chủ',
            component: DefaultLayout,
            redirect: '/thongke',
            children: [
              {
                path: 'thongke',
                name: 'Thống kê',
                component: () =>
                  import('../pages/Dashboard.vue'),
              },
              {
                path: 'thanhvien',
                name: 'Thành viên',
                component: () =>
                  import('../pages/ListMember.vue'),
              },
              {
                path: '/thanhvien/them',
                name: 'Thêm thành viên',
                component: () =>
                  import('../pages/AddMember.vue'),
              },

            ],
        },
        {
            path: '/dangnhap',
            component: () => import('../pages/login.vue')
        },
    ],
})
export default router