<template>
  <CChartPie :data="defaultData" />
</template>

<script>
import { CChartPie } from '@coreui/vue-chartjs'
export default {
  name: 'GiaoHoPieChart',
  components: { CChartPie },
  methods:{
    async getSoLuongThanhVien()
    {

    }
  },
  computed: {
    defaultData() {
      return {
        labels: ['Mẹ Thiên Chúa', 'Fatima', 'Vô Nhiễm', 'Truyền Tin'],
        datasets: [
          {
            backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
            data: [40, 20, 80, 10],
          },
        ],
      }
    },
  },
}
</script>
