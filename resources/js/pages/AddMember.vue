<template>
  <div>
    <CForm class="row g-3">
      <CCol :md="3">
        <CFormLabel for="tenthanh">Tên thánh</CFormLabel>
        <CFormInput id="tenthanh" type="text" />
      </CCol>
      <CCol :md="9">
        <CFormLabel for="hoten">Họ và tên</CFormLabel>
        <CFormInput id="hoten" type="text" />
      </CCol>

      <CCol :md="6">
        <CFormLabel for="tencha">Tên thánh, họ tên cha</CFormLabel>
        <CFormInput id="tencha" type="text" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="tenme">Tên thánh, họ tên mẹ</CFormLabel>
        <CFormInput id="tenme" type="text" />
      </CCol>

      <CCol :xs="12">
        <CFormLabel for="inputAddress">Địa chỉ</CFormLabel>
        <CFormInput id="inputAddress" placeholder="Địa chỉ" />
      </CCol>
      <CCol :md="12">
        <CFormLabel for="ghichu">Ghi chú</CFormLabel>
        <CFormTextarea id="ghichu" placeholder="Ghi chú" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="sdt">Số điện thoại</CFormLabel>
        <CFormInput id="sdt" placeholder="Số điện thoại" type="tel" />
      </CCol>
      <CCol :md="6">
        <CFormLabel for="inputState">Giáo họ</CFormLabel>
        <CFormSelect id="inputState">
          <option v-for="giaoho in listgiaoho" :value="giaoho.id">
            {{ giaoho.tengiaoho }}
          </option>
        </CFormSelect>
      </CCol>
      <CCol :xs="12">
        <CFormCheck id="gridCheck" type="checkbox" label="Đã học xong GL Hồng Ân" checked />
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
  data () {
    return {
      listgiaoho: null
    }
  },
  setup() {

    return {
      
    }
  },
  mounted() {
    axios.get('http://127.0.0.1:8000/api/giaoho')
      .then(data =>this.listgiaoho=data.data)
      .catch(response => console.log(response));

  }
}

</script>
    

  