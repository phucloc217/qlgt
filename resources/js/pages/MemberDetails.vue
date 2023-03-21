<template>
  
  <div>

    <CForm class="row g-3 needs-validation" novalidate @submit.prevent="submitForm" method="post">
      <input type="hidden" name="_token" :value="csrf">
      <CCol :md="3">
        <CFormLabel for="tenthanh">Tên thánh</CFormLabel>
        <CFormInput id="tenthanh" type="text" name="tenthanh" v-model="form.tenthanh" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="hoten">Họ và tên</CFormLabel>
        <CFormInput id="hoten" name="hoten" type="text" v-model="form.hoten" feedbackInvalid="Vui lòng nhập họ tên"
          required />
      </CCol>
      <CCol :md="3">
        <CFormLabel for="ngaysinh">Ngày sinh</CFormLabel>
        <CFormInput id="ngaysinh" name="ngaysinh" type="date" v-model="form.ngaysinh"
          feedbackInvalid="Vui lòng nhập ngày sinh" required />
      </CCol>

      <CCol :md="6">
        <CFormLabel for="hotencha">Tên thánh, họ tên cha</CFormLabel>
        <CFormInput id="hotencha" name="hotencha" type="text" v-model="form.hotencha" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="hotenme">Tên thánh, họ tên mẹ</CFormLabel>
        <CFormInput id="hotenme" name="hotenme" type="text" v-model="form.hotenme" />
      </CCol>

      <CCol :md="4">
        <CFormLabel for="sdt">Số điện thoại</CFormLabel>
        <CFormInput id="sdt" name="sdt" placeholder="Số điện thoại" type="tel" v-model="form.sdt" />
      </CCol>
      <CCol :md="4">
        <CFormLabel for="giaoho">Giáo họ</CFormLabel>
        <CFormSelect id="giaoho" name="giaoho" v-model="form.giaoho" required>
          <option v-for="giaoho in listgiaoho" :value="giaoho.id">
            {{ giaoho.tengiaoho }}
          </option>
        </CFormSelect>
      </CCol>
      <CCol :md="4">
        <CFormLabel for="trangthai">Trạng thái</CFormLabel>
        <CFormSelect id="trangthai" name="trangthai" v-model="form.trangthai" required>
          <option value="1">Bình thường</option>
          <option value="2">Tạm hoãn</option>
          <option value="3">Vắng nhiều</option>
          <option value="4">Đã nghỉ</option>
        </CFormSelect>
      </CCol>
      <CCol :xs="12">
        <CFormLabel for="diachi">Địa chỉ</CFormLabel>
        <CFormInput id="diachi" name="diachi" placeholder="Địa chỉ" v-model="form.diachi" />
      </CCol>
      <CCol :md="12">
        <CFormLabel for="ghichu">Ghi chú</CFormLabel>
        <CFormTextarea id="ghichu" name="ghichu" placeholder="Ghi chú" v-model="form.ghichu" />
      </CCol>
      <CCol :xs="12">
        <CFormCheck id="giaoly" name="giaoly" type="checkbox" label="Đã học xong GL Hồng Ân" v-model="form.giaoly" />
      </CCol>
      <CCol :xs="12">
        <CButton type="submit" color="primary">Lưu</CButton>
      </CCol>

    </CForm>
  </div>
</template>
  
<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import moment from 'moment'
import LoadingScreen from '../components/LoadingScreen.vue'
export default {
  name: 'MemberDetails',
  computed: {
    csrf() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
  },
  components:{
    LoadingScreen
  },
  data() {
    return {
      listgiaoho: null,
      thanhvien: null,
      loading: false,
      id: null,
      form: {
        tenthanh: '',
        hoten: '',
        ngaysinh: '',
        hotencha: '',
        hotenme: '',
        diachi: '',
        ghichu: '',
        giaoho: 3,
        sdt: '',
        giaoly: 1,
        trangthai: 1,
      }
    }
  },
  setup() {

    return {};
  },
  methods: {
    format_date(value) {
      if (value) {
        return moment(String(value)).format('YYYY-MM-DD')
      }
    },
    submitForm(event) {
      if (this.form.hoten == '' || this.form.ngaysinh == '') return;
      axios.patch(this.API_URL + '/thanhvien/' + this.id, this.form).then((res) => {
        console.log(res);
        toast.success('Cập nhật thành công!');
      })
        .catch((error) => {
          console.log(error)
          toast.error(error.response.data.message);
        }).finally(() => {

        });

    },
    async getThongTin() {
      this.id = this.$router.currentRoute._value.params.id
      await axios.get(this.API_URL + '/thanhvien/' + this.id)
        .then(data => this.thanhvien = data.data)
        .catch(function (response) {
          toast.error(response, {
            autoClose: 1000,
          });
          console.log(response);
        });
      ;
      this.form.hoten = this.thanhvien[0].hoten;
      this.form.tenthanh = this.thanhvien[0].tenthanh;
      this.form.ngaysinh = this.format_date(this.thanhvien[0].ngaysinh);
      this.form.hotencha = this.thanhvien[0].hotencha;
      this.form.hotenme = this.thanhvien[0].hotenme;
      this.form.diachi = this.thanhvien[0].diachi;
      this.form.ghichu = this.thanhvien[0].ghichu;
      this.form.giaoho = this.thanhvien[0].giaoho;
      this.form.sdt = this.thanhvien[0].sdt;
      this.form.giaoly = this.thanhvien[0].giaoly;
      this.form.trangthai = this.thanhvien[0].trangthai;
    },

    async getGiaoHo() {
      await axios.get(this.API_URL + '/giaoho')
        .then(data => this.listgiaoho = data.data)
        .catch(response => console.log(response));
      (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(form => {
            form.addEventListener('submit', event => {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }

              form.classList.add('was-validated')
            }, false)
          })
      })()
    }
  },
  created() {
    //this.loading=true;
    this.getGiaoHo();
    this.getThongTin();
  },
  mounted() {

  }

}

</script>
    

  