import {
    createRouter,
    createWebHistory,
    createWebHashHistory,
    createMemoryHistory,
} from "vue-router";
import DefaultLayout from "../pages/index.vue";
import MemberTable from "../components/MemberTable.vue";
import MemberDetails from "../pages/MemberDetails.vue";
import Page404 from "../pages/Page404.vue";
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: "/",
            name: "Trang chủ",
            component: DefaultLayout,
            redirect: "/thongke",
            children: [
                {
                    path: "thongke",
                    name: "Thống kê",
                    component: () => import("../pages/Dashboard.vue"),
                },
                {
                    path: "thanhvien",
                    name: "Thành viên",
                    component: () => import("../pages/ListMember.vue"),
                    children: [
                        {
                            path: "",
                            name: "Danh sách thành viên",
                            components: {
                                content: MemberTable,
                            },
                        },
                        {
                            path: ":id(\\d+)+",
                            name: "Chi tiết",
                            components: {
                                content: MemberDetails,
                            },
                        },
                    ],
                },
                {
                    path: "themthanhvien",
                    name: "Thêm thành viên",
                    component: () => import("../pages/AddMember.vue"),
                },
                {
                    path: "maqr",
                    name: "Mã QR",
                    component: () => import("../pages/QRCode.vue"),
                },
                {
                    path: "diemdanh",
                    name: "Điểm Danh",
                    children: [
                        {
                            path: "",
                            name: "",
                            component: () =>
                                import("../pages/Attendance.vue"),
                        },
                        {
                            path: ":id(\\d+)+",
                            name: "",
                            component: () =>
                                import("../pages/ScanQR.vue"),
                        },
                    ],
                },
                {
                    path: "quanlytaikhoan",
                    name: "Quản lý tài khoản",
                    component: () => import("../pages/ListAccount.vue"),
                },
                {
                    path: "qldiemdanh",
                    name: "Quản lý điểm danh",
                    component: () => import("../pages/ListAttendance.vue"),
                },
                {
                    path: "qldiemdanh/chitiet/:id",
                    name: "Chi tiết điểm danh",
                    children: [
                        {
                            path: "",
                            name: "",
                            component: () =>
                                import("../pages/AttendanceDashboard.vue"),
                        },
                    ],
                },
            ],
        },
        {
            path: "/dangnhap",
            name: "Đăng nhập",
            component: () => import("../pages/login.vue"),
        },
        { 
            path: "/:pathMatch(.*)*", 
            component: Page404 
        },
    ],
});
export default router;
