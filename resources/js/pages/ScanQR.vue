<template>
  <div class="container d-flex align-items-center justify-content-center">
    <div class="p-3 mb-2 bg-white m-auto w-auto shadow mb-5 bg-body rounded">
      <div>
        <qr-stream @decode="onDecode" class="mb">
          <div style="color: red;" class="frame"></div>
        </qr-stream>
      </div>
    </div>

  </div>
  <div class="row result">
    <div>
      <CCard class="mb-4">
        <CCardHeader>
          <strong>Tìm kiếm</strong>
        </CCardHeader>
        <CCardBody>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <CInputGroup class="mb-3">
                <CFormInput placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="button-addon2" id="searchInput"
                  v-model="keyword" />
                <CButton type="button" color="primary" variant="outline" id="searchBtn" @click="search()">
                  <CIcon icon="cilSearch" size="sm" />
                </CButton>
              </CInputGroup>
            </div>

          </div>
          <table id="table" class="table table-secondary table-striped display nowrap mt-2 shadow mb-5 bg-body rounded"
            style="width:100%">
            <thead>
              <tr>
                <th class="export-col">Mã</th>
                <th class="export-col">Tên thánh</th>
                <th class="export-col">Họ</th>
                <th class="export-col">Tên</th>
                <th class="export-col">Ngày sinh</th>
                <th class="export-col">Giáo họ</th>
                <th class="export-col">Thao tác</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th>Mã</th>
                <th>Tên thánh</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Giáo họ</th>
                <th>Thao tác</th>
              </tr>
            </tfoot>
          </table>
        </CCardBody>
      </CCard>
    </div>
  </div>
  <div class="row result">
    <div>
      <CCard class="mb-4">
        <CCardHeader>
          <strong>Đã điểm danh</strong>
        </CCardHeader>
        <CCardBody>

          <table id="table1" class="table table-secondary table-striped display nowrap mt-2 shadow mb-5 bg-body rounded"
            style="width:100%">
            <thead>
              <tr>
                <th class="export-col">Mã</th>
                <th class="export-col">Tên thánh</th>
                <th class="export-col">Họ</th>
                <th class="export-col">Tên</th>
                <th class="export-col">Ngày sinh</th>
                <th class="export-col">Giáo họ</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th class="export-col">Mã</th>
                <th class="export-col">Tên thánh</th>
                <th class="export-col">Họ</th>
                <th class="export-col">Tên</th>
                <th class="export-col">Ngày sinh</th>
                <th class="export-col">Giáo họ</th>
              </tr>
            </tfoot>
          </table>
        </CCardBody>
      </CCard>
    </div>
  </div>
</template>

<script>
import { QrStream } from 'vue3-qr-reader';

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
import axios from 'axios';
export default {
  components: {
    QrStream,
  },
  setup() {
    // return {
    //   onDecode
    // }
  },
  data() {
    let validId = null
    let thanhvien = null
    let table1 = null
    let table2 = null
    let keyword = ''
    return {
      validId,
      thanhvien,
      form: {
        madiemdanh: '',
        mathanhvien: '',
      },
      table2,
      table1,
      keyword,
    }
  },

  methods: {
    onDecode(data) {
      this.checkThanhVienIsValid(data);
    },
    async checkValidID() {
      let id = this.$router.currentRoute._value.params.id
      await axios.get(this.API_URL + '/diemdanh/' + id)
        .then(data => this.validId = data.data)
        .catch(response => console.log(response));
      if (this.validId == null) this.$router.push({ path: '/404' })
    },
    async checkThanhVienIsValid(id) {
      await axios.get(this.API_URL + '/thanhvien/' + id)
        .then(data => this.thanhvien = data.data[0])
        .catch(response => console.log(response));
      if (this.thanhvien == null) {
        this.$swal({
          title: 'Thành viên không tồn tại',
          icon: 'error',
        }, 'error')
      }
      else {
        if (this.diemDanh(id)) {
          let cell1 = this.thanhvien.ma;
          let cell2 = this.thanhvien.tenthanh;
          let cell3 = this.thanhvien.hoten.split(' ').slice(0, -1).join(' ');;
          let cell4 = this.thanhvien.hoten.split(' ').slice(-1).join(' ');;
          let cell5 = moment(this.thanhvien.ngaysinh).format('DD/MM/yyyy');
          let cell6 = this.thanhvien.tengiaoho;
          this.table1.row.add(
            {
              0: cell1,
              1: cell2,
              2: cell3,
              3: cell4,
              4: cell5,
              5: cell6,
            }
          ).draw();
          this.thanhvien = null
          this.$swal({
            title: 'Điểm danh thành công',
            icon: 'success',
          }, 'success')
        }
        else {
          this.$swal({
            title: 'Điểm danh không thành công',
            icon: 'error',
          }, 'error')
        }
      }
    },
    async diemDanh(idthanhvien) {
      this.form.madiemdanh = this.$router.currentRoute._value.params.id[0];
      this.form.mathanhvien = idthanhvien;
      await axios.post(this.API_URL + '/diemdanhqr', this.form)
        .then(function (res) {
          return 1;
        })
        .catch(response => console.log(response));
    },
    createTable() {
      this.table2 = $("#table").DataTable({
        "paging": true,
        "searching": false,
        "responsive": true,
        "language": {
          "paginate": {
            "previous": "Trang trước",
            "next": "Trang sau",
          },
          "search": "Tìm kiếm",
          "lengthMenu": "Hiển thị _MENU_ mục",
          "info": "",
          "infoEmpty": " ",
          "zeroRecords": " ",
        },
      });
      this.table1 = $("#table1").DataTable({
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
          "infoEmpty": " ",
          "zeroRecords": " ",
        },
      });
    },
    /////

    async search() {
      this.table2.rows().clear().draw();
      let keyword = this.keyword
      let list = []
      await axios.get(this.API_URL + '/thanhvien/search', {
        params: { keyword: keyword }
      })
        .then(function (res) {
          list = res.data
        })
      console.log(list)
      list.forEach(element => {
        let cell1 = element.ma;
        let cell2 = element.tenthanh;
        let cell3 = element.hoten.split(' ').slice(0, -1).join(' ');;
        let cell4 = element.hoten.split(' ').slice(-1).join(' ');;
        let cell5 = moment(element.ngaysinh).format('DD/MM/yyyy');
        let cell6 = element.tengiaoho;
        let cell7 = element.tengiaoho;
        this.table2.row.add(
          {
            0: cell1,
            1: cell2,
            2: cell3,
            3: cell4,
            4: cell5,
            5: cell6,
            6: cell7,
          }
        ).draw();
      });

    },


    //////
  },


  created() {
    this.checkValidID();
  },
  mounted() {
    this.createTable();
  }

}
</script>
<style scoped>
.stream {
  max-height: 500px;
  max-width: 500px;
  margin: auto;
}

.frame {
  border-style: solid;
  border-width: 2px;
  border-color: red;
  height: 200px;
  width: 200px;
  position: absolute;
  top: 0px;
  bottom: 0px;
  right: 0px;
  left: 0px;
  margin: auto;
}
</style>