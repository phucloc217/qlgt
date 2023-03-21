<template>
  <CRow>
    <CCol :md="6" class="mb-4">
      <CCard>
        <CCardHeader>Số thành viên theo giáo họ</CCardHeader>
        <CCardBody>
          <GiaoHoPieChart />
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
 import GiaoHoPieChart from './charts/GiaoHoPieChart.vue'

export default {

  name: 'Dashboard',
  components: {
    GiaoHoPieChart,
  },
  data() {

  },
  setup() {


  },
}
</script>
