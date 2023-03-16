<template>
  <div>
    <table id="table" class="table table-secondary table-striped display nowrap mt-2 shadow mb-5 bg-body rounded">
      <thead>
        <tr>
          <th class="export-col">Mã</th>
          <th class="export-col">Tên thánh</th>
          <th class="export-col">Họ</th>
          <th class="export-col">Tên</th>
          <th class="export-col">Ngày sinh</th>
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
          <td class="export-col">{{ thanhvien.sdt }}</td>
          <td class="export-col">{{ thanhvien.tengiaoho }}</td>
          <td class="export-col" v-if="thanhvien.trangthai == 1">Bình thường</td>
          <td class="export-col" v-else-if="thanhvien.trangthai == 2">Tạm hoãn</td>
          <td class="export-col" v-else-if="thanhvien.trangthai == 3">Vắng nhiều</td>
          <td class="export-col" v-else="thanhvien.trangthai==4">Đã nghỉ</td>
          <td>
            <div class="col-2">
              <button @click="showDeleteAlert(index, thanhvien.ma)" class="btn btn-danger btn-sm m-1">
                <CIcon icon="cilTrash" size="md" />
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
import("datatables.net-buttons/js/dataTables.buttons");
import("datatables.net-buttons-bs5/js/buttons.bootstrap5");
import("datatables.net-buttons/js/buttons.html5");
import("datatables.net-buttons/js/buttons.print");
import("datatables.net-buttons/js/buttons.colVis");
import("datatables.net-responsive-bs5");
import("datatables.net-searchpanes-bs5");
import moment from 'moment'
import { toast } from 'vue3-toastify';

export default {
  data() {
    return {
      listthanhvien: null,
      host: this.API_URL,
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
        .catch(response => console.log(response));
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
          if (this.deleteThanhVien(id))
            document.getElementById("table").deleteRow(x + 1);
        }
      });
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
<style scoped>
.dropdown-toggle::after {
  content: none !important;
}
</style>
    

  