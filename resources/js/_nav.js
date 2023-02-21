export default [
  {
    component: 'CNavLink',
    name: 'Thống kê',
    to: '/thongke',
    icon: 'cil-speedometer',
  },
  {
    component: 'CNavTitle',
    name: 'Thành viên',
  },
  {
    component: 'CNavLink',
    name: 'Danh sách thành viên',
    to: '/thanhvien',
    icon: 'cil-notes',
  },
  {
    component: 'CNavLink',
    name: 'Thêm thành viên',
    to: '/themthanhvien',
    icon: 'cil-plus',
  },
  {
    component: 'CNavTitle',
    name: 'Điểm danh',
  },
  {
    component: 'CNavItem',
    name: 'Quản lý điểm danh',
    to: '/diemdanh/quanly',
    icon: 'cil-calendar',
  },
  {
    component: 'CNavItem',
    name: 'Điểm danh',
    to: '/diemdanh',
    icon: 'cil-calendar-check',
  },
  {
    component: 'CNavTitle',
    name: 'Tài khoản',
  },
  {
    component: 'CNavItem',
    name: 'Quản lý tài khoản',
    to: '/taikhoan/quanly',
    icon: 'cil-user',
  },
  {
    component: 'CNavItem',
    name: 'Thông tin cá nhân',
    to: '/taikhoan',
    icon: 'cil-info',
  },
  {
    component: 'CNavItem',
    name: 'Mã QR',
    to: '/maQR',
    icon: 'cil-qr-code',
  },
]
