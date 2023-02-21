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
              <CCol :xs="12">
                <CFormLabel for="inputAddress2">Address 2</CFormLabel>
                <CFormInput
                  id="inputAddress2"
                  placeholder="Apartment, studio, or floor"
                />
              </CCol>
              <CCol :md="6">
                <CFormLabel for="inputCity">City</CFormLabel>
                <CFormInput id="inputCity" />
              </CCol>
              <CCol :md="4">
                <CFormLabel for="inputState">Giáo họ</CFormLabel>
                <CFormSelect id="inputState">
                  <option>Mẹ Thiên Chúa.</option>
                  <option>Fatima</option>
                  <option>Vô Nhiễm</option>
                  <option>Truyền Tin</option>
                </CFormSelect>
              </CCol>
              <CCol :md="2">
                <CFormLabel for="inputZip">Zip</CFormLabel>
                <CFormInput id="inputZip" />
              </CCol>
              <CCol :xs="12">
                <CFormCheck
                  id="gridCheck"
                  type="checkbox"
                  label="Check me out"
                />
              </CCol>
              <CCol :xs="12">
                <CButton type="submit" color="primary">Lưu</CButton>
              </CCol>
            </CForm>
  </div>
</template>
  
<script>
import $ from "jquery";
import jsZip from"jszip";
import("pdfmake");
import DataTable from "datatables.net-bs5";
import("datatables.net-buttons-bs5");
import("datatables.net-buttons/js/buttons.html5.js");
import("datatables.net-buttons/js/buttons.print.js");
import("datatables.net-responsive-bs5");
import("datatables.net-searchpanes-bs5");

export default {
  mounted() {
   
  },
};
</script>
    

  