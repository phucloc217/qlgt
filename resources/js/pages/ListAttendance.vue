<template>
  <div>
    <table id="table" class="table table-secondary table-striped display nowrap mt-2 shadow mb-5 bg-body rounded">
      <thead>
        <tr>
          <th class="export-col">STT</th>
          <th class="export-col">Tên điểm danh</th>
          <th class="export-col">Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(diemdanh, index) in listdiemdanhs">
          <td class="export-col">{{ index + 1 }}</td>
          <td class="export-col">{{ diemdanh.tendiemdanh }}</td>
          <td class="export-col" v-if="diemdanh.trangthai == 1">Đang mở</td>
          <td class="export-col" v-else-if="diemdanh.trangthai == 0">Đã đóng</td>
          <td class="row me-0">
            <div class="col-2">
              <router-link v-bind:to="'chitiet/'+diemdanh.id"
                      class="btn btn-info btn-sm m-1"
                    >
                    <CIcon icon="cilGraph" size="md" /></router-link>
            </div>
            <div class="col-2">
              <a href="#" class="btn btn-warning btn-sm m-1">
                <CIcon icon="cilPencil" size="md" />
              </a>
            </div>
            <div class="col-2">
              <a href="#" class="btn btn-danger btn-sm m-1">
                <CIcon icon="cilTrash" size="md" />
              </a>
            </div>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th>STT</th>
          <th>Tên điểm danh</th>
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
      listdiemdanhs: null,
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

    async getDiemDanh() {
      await axios.get(this.API_URL + '/diemdanh')
        .then(data => this.listdiemdanhs = data.data)
        .catch(response => console.log(response));
      window.JSZip = jsZip;
      $("#table").DataTable({

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
      });
    }
  },
  mounted() {
    this.getDiemDanh();

  },
};
</script>
<style scoped>
.dropdown-toggle::after {
  content: none !important;
}
</style>
    

  