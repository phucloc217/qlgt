<template>
  <CRow>
    <CCol>
      <CCard class="mb-4">
        <CCardHeader>
          <strong>Danh mục điểm danh</strong>
        </CCardHeader>
        <CCardBody>
          <CRow>
            <CCol :xs="3" v-for="diemdanh, index  in listdiemdanh">
              <router-link :to="'/diemdanh/'+diemdanh.id" class="text-decoration-none">
                <CWidgetStatsB class="mb-3" color="success" inverse :progress="{ value: 100 }" text="" title=""
                :value="diemdanh.tendiemdanh" />
              </router-link>
            </CCol>
          </CRow>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import { getStyle } from '@coreui/utils'
export default {
  name: 'Attendance',
  components: {

  },
  data(){
      return{
        listdiemdanh:null,
      }
  },
  setup() {
    return {
      getStyle,
      widgetProgressIconItems: [
        { color: 'primary', icon: 'cil-puzzle' },
        { color: 'success', icon: 'cil-speedometer' },
        { color: 'danger', icon: 'cil-cursor' },
        { color: 'info', icon: 'cil-drop' },
        { color: 'secondary', icon: 'cil-pencil' },
      ],
    }
  },
  methods:
  {
    async getDiemDanh() {
      await axios.get(this.API_URL + '/dsdiemdanh')
        .then(data => this.listdiemdanh = data.data)
        .catch(response => console.log(response));
    }
    
  },
  created()
  {
      this.getDiemDanh();
  }
}
</script>
