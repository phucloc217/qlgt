<template>
  <div>
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
        <CFormCheck id="giaoly" name="giaoly" type="checkbox" label="Đã học xong GL Hồng Ân" checked
          v-model="form.giaoly" />
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
    submitForm() {
      axios.post('http://127.0.0.1:8000/api/thanhvien', this.form).then((res) => {
          alert(res)
          this.$refs.form.reset();
        })
        .catch((error) => {
          console.log(error)
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
    

  