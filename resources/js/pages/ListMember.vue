<template>
   <router-view name="content"></router-view>

</template>
  
<script>
import MemberTable from '../components/MemberTable.vue'
export default {
  components: {
    MemberTable
  },
}
</script>
<style scoped>
.dropdown-toggle::after {
  content: none !important;
}
</style>
    

  