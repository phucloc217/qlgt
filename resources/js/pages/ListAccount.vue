<template>
  <div>
    <table id="table" class="table table-secondary table-striped display nowrap mt-2 shadow mb-5 bg-body rounded">
      <thead>
        <tr>
          <th class="export-col">STT</th>
          <th class="export-col">Tên đăng nhập</th>
          <th class="export-col">Người dùng</th>
          <th class="export-col">Tên</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="thanhvien in listthanhvien">

          <td>

            <CDropdown>
              <CDropdownToggle>
                <CIcon icon="cilOptions" size="md" />
              </CDropdownToggle>
              <CDropdownMenu>
                <CDropdownItem href="#">Chỉnh sửa</CDropdownItem>
                <CDropdownItem href="#">Xóa</CDropdownItem>
              </CDropdownMenu>
            </CDropdown>

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
export default {
  data() {
    return {
      listusers: null,
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
  },
  mounted() {
    axios.get('http://127.0.0.1:8000/api/user')
      .then(data => this.listusers = data.data)
      .catch(response => console.log(response));
    window.JSZip = jsZip;
    setTimeout(function () {
      $("#table").DataTable({
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
    }, 1000);

  },
};
</script>
<style scoped>
.dropdown-toggle::after {
  content: none !important;
}
</style>
    

  