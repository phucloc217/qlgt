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
        <CFormLabel for="tencha">Tên thánh, họ tên cha</CFormLabel>
        <CFormInput id="tencha" name="tencha" type="text" v-model="form.tencha" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="tenme">Tên thánh, họ tên mẹ</CFormLabel>
        <CFormInput id="tenme" name="tenme" type="text" v-model="form.tenme" />
      </CCol>

      <CCol :md="6">
        <CFormLabel for="sdt">Số điện thoại</CFormLabel>
        <CFormInput id="sdt" name="sdt" placeholder="Số điện thoại" type="tel" v-model="form.sdt" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="giaoho">Giáo họ</CFormLabel>
        <CFormSelect id="giaoho" name="giaoho" v-model="form.giaoho" required>
          <option v-for="giaoho in listgiaoho" :value="giaoho.id">
            {{ giaoho.tengiaoho }}
          </option>
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

export default {
  computed: {
    csrf() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
  },
  data() {
    return {
      listgiaoho: null,
      form: {
        tenthanh: '',
        hoten: '',
        ngaysinh: '',
        tencha: '',
        tenme: '',
        diachi: '',
        ghichu: '',
        giaoho: 3,
        sdt: '',
        giaoly: 1,
      }
    }
  },
  setup() {

    return {};
  },
  methods: {
    submitForm(event) {
      if (this.form.hoten == '' || this.form.ngaysinh == '') return;
      axios.post(this.API_URL + '/thanhvien', this.form).then((res) => {
        event.target.reset();
        this.form.giaoho = 3;
        document.getElementById('giaoly').checked = true;
        this.form.tenthanh = '';
        this.form.hoten = '';
        this.form.ngaysinh = '';
        this.form.tencha = '';
        this.form.tenme = '';
        this.form.diachi = '';
        this.form.ghichu = '';
        this.form.giaoho = 3;
        this.form.sdt = '';
        this.form.giaoly = 1;
        console.log(res);
        toast.success('Thêm thành công!');
      })
        .catch((error) => {
          console.log(error)
          toast.error(error.response.data.message);
        }).finally(() => {

        });

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
  mounted() {
      this.getGiaoHo();
  }

}

</script>
    

  