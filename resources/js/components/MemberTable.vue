<template>
    <div>
        <table id="table" class="table table-secondary table-striped display nowrap mt-2 shadow mb-5 bg-body rounded"
            style="width:100%">
            <thead>
                <tr>
                    <th class="export-col">Mã</th>
                    <th class="export-col">Tên thánh</th>
                    <th class="export-col">Họ</th>
                    <th class="export-col">Tên</th>
                    <th class="export-col">Ngày sinh</th>
                    <th class="export-col">Họ tên cha</th>
                    <th class="export-col">Họ tên mẹ</th>
                    <th class="export-col">Số điện thoại</th>
                    <th class="export-col">Giáo họ</th>
                    <th class="export-col">Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="thanhvien, index  in listthanhvien">
                    <td class="export-col">{{ thanhvien.ma }}</td>
                    <td class="export-col">{{ thanhvien.tenthanh }}</td>
                    <td class="export-col">{{ thanhvien.hoten.split(' ').slice(0, -1).join(' ') }}</td>
                    <td class="export-col">{{ thanhvien.hoten.split(' ').slice(-1).join(' ') }}</td>
                    <td class="export-col">{{ format_date(thanhvien.ngaysinh) }}</td>
                    <td class="export-col">{{ thanhvien.hotencha }}</td>
                    <td class="export-col">{{ thanhvien.hotenme }}</td>
                    <td class="export-col">{{ thanhvien.sdt }}</td>
                    <td class="export-col">{{ thanhvien.tengiaoho }}</td>
                    <td class="export-col" v-if="thanhvien.trangthai == 1">Bình thường</td>
                    <td class="export-col" v-else-if="thanhvien.trangthai == 2">Tạm hoãn</td>
                    <td class="export-col" v-else-if="thanhvien.trangthai == 3">Vắng nhiều</td>
                    <td class="export-col" v-else="thanhvien.trangthai==4">Đã nghỉ</td>
                    <td class="row p-0 me-0">
                        <div class="col-2 m-1 ">
                            <router-link v-bind:to="'thanhvien/' + thanhvien.ma"
                                class="btn btn-warning btn-sm m-1 text-light">
                                <CIcon icon="cilPencil" size="sm" />
                            </router-link>
                        </div>
                        <div class="col-2 m-1">
                            <button @click="showModalUpdatePassword(thanhvien.ma)"
                                class="btn btn-info btn-sm m-1 text-light">
                                <CIcon icon="cilLockLocked" size="sm" />
                            </button>
                        </div>
                        <div class="col-2 m-1">
                            <button @click="showDeleteAlert(index, thanhvien.ma)"
                                class="btn btn-danger btn-sm m-1 text-light">
                                <CIcon icon="cilTrash" size="sm" />
                            </button>
                        </div>

                    </td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <th>Mã</th>
                    <th>Tên thánh</th>
                    <th>Họ</th>
                    <th>Tên</th>
                    <th>Ngày sinh</th>
                    <th>Họ tên cha</th>
                    <th>Họ tên mẹ</th>
                    <th>Số điện thoại</th>
                    <th>Giáo họ</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </tfoot>
        </table>
    </div>
</template>
<script>
import $ from "jquery";
import jsZip from "jszip";
import("pdfmake");
import 'datatables.net/js/jquery.dataTables'
import DataTable from "datatables.net-bs5/js/dataTables.bootstrap5";
import("datatables.net-bs5/css/dataTables.bootstrap5.min.css");
import("datatables.net-buttons/js/dataTables.buttons");
import("datatables.net-buttons-bs5/js/buttons.bootstrap5");
import("datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css");
import("datatables.net-buttons/js/buttons.html5");
import("datatables.net-buttons/js/buttons.print");
import("datatables.net-buttons/js/buttons.colVis");
import("datatables.net-responsive-bs5");
import("datatables.net-searchpanes-bs5");
import moment from 'moment'
import { toast } from 'vue3-toastify';
export default {
    name: 'MemberTable',
    data() {
        return {
            listthanhvien: null,
            table: null,

        }
    },
    created() {

    },
    watch: {
        list(val) {
            this.dt.destroy();
            this.$nextTick(() => {

                this.dt = $("#table").DataTable();

            })

        }

    },
    setup() {

    },
    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD/MM/YYYY')
            }
        },
        async deleteThanhVien(id) {
            await axios.delete(this.API_URL + '/thanhvien/' + id)
                .then(function (data) {
                    toast.success("Xóa thành công", {
                        autoClose: 1000,
                    });
                    return 1;
                })
                .catch(function (response) {
                    toast.error(response, {
                        autoClose: 1000,
                    });
                    return 0;
                });
        },
        showDeleteAlert(x, id) {
            this.$swal({
                title: 'Bạn có chắc muốn xóa thành viên ' + id + ' không?',
                icon: 'warning',
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                showCancelButton: true
            }, 'success').then((result) => {
                if (result['isConfirmed']) {
                    if (this.deleteThanhVien(id) == 0) return;
                    document.getElementById("table").deleteRow(x + 1);

                }
            });
        },
        async showModalUpdatePassword(id) {
            const { value: matkhau } = await this.$swal({
                title: 'Thay đổi mật khẩu',
                input: 'password',
                inputPlaceholder: 'Nhập mật khẩu mới',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Bạn cần nhập mật khẩu mới!'
                    }
                },
                inputAttributes: {
                    maxlength: 16,
                    autocapitalize: 'off',
                    autocorrect: 'off',
                    autocomplete: 'new-password'
                }
            })
            if (matkhau) {
               
                await axios.patch(this.API_URL + '/thanhvien/matkhau/' + id,matkhau)
                .then(function (data) {
                    toast.success("Đổi mật khẩu thành công", {
                        autoClose: 1000,
                    });
                })
                .catch(function (response) {
                    toast.error(response.data, {
                        autoClose: 1000,
                    });
                });
            }
        },

        async getThanhVien() {
            await axios.get(this.API_URL + '/thanhvien')
                .then(data => this.listthanhvien = data.data)
                .catch(response => console.log(response));
            window.JSZip = jsZip;
            this.table = $("#table").DataTable({
                "dom": 'Bfrtip',
                "paging": true,
                "searching": true,
                "responsive": true,
                "language": {
                    "paginate": {
                        "previous": "Trang trước",
                        "next": "Trang sau",
                    },
                    "search": "Tìm kiếm",
                    "lengthMenu": "Hiển thị _MENU_ mục",
                    "info": "",
                    "infoEmpty": "Không có kết quả để hiển thị",
                    "zeroRecords": "Không có kết quả để hiển thị",
                },
                columnDefs: [
                    {
                        targets: [5, 6, 7], visible: false

                    },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: 2 },
                    { responsivePriority: 3, targets: 3 },
                ],
                "buttons": [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: '.export-col'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: '.export-col'
                        }
                    },
                    'colvis'
                ],
            });
        },


    },
    mounted() {
        this.getThanhVien();

    },
};
</script>
<style scoped></style>