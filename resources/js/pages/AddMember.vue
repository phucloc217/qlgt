<template>
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
      </symbol>
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
      </symbol>
    </svg>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert"
      v-if="this.msgtype == 1">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill" />
      </svg>
      <div>
        {{ this.message }}
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert"
      v-if="this.msgtype == 2">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <div>
        {{ this.message }}
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <CForm class="row g-3" ref="form" v-on:submit.prevent="submitForm">
      <CCol :md="3">
        <CFormLabel for="tenthanh">Tên thánh</CFormLabel>
        <CFormInput id="tenthanh" type="text" name="tenthanh" v-model="form.tenthanh" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="hoten">Họ và tên</CFormLabel>
        <CFormInput id="hoten" name="hoten" type="text" v-model="form.hoten" />
      </CCol>
      <CCol :md="3">
        <CFormLabel for="ngaysinh">Ngày sinh</CFormLabel>
        <CFormInput id="ngaysinh" name="ngaysinh" type="date" v-model="form.ngaysinh" />
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
        <CFormSelect id="giaoho" name="giaoho" v-model="form.giaoho">
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

export default {
  data() {
    return {
      listgiaoho: null,
      message: '',
      msgtype: '',
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

    return {

    }
  },
  methods: {
    submitForm(event) {
      axios.post('http://127.0.0.1:8000/api/thanhvien', this.form).then((res) => {
        this.msgtype = 1
        this.message = "Thêm thành công!"
        event.target.reset();
        this.form.giaoho = 3;
        document.getElementById('giaoly').checked = true;
        this.form.tenthanh= '';
        this.form.hoten= '';
        this.form.ngaysinh= '';
        this.form.tencha= '';
        this.form.tenme= '';
        this.form.diachi= '';
        this.form.ghichu= '';
        this.form.giaoho= 3;
        this.form.sdt= '';
        this.form.giaoly= 1;
      })
        .catch((error) => {
          console.log(error)
          this.msgtype = 2;
          this.message = error
        }).finally(() => {

        });
    }
  },
  mounted() {
    axios.get('http://127.0.0.1:8000/api/giaoho')
      .then(data => this.listgiaoho = data.data)
      .catch(response => console.log(response));

  }
}

</script>
    

  