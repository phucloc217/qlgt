<template>
  <div class="container d-flex align-items-center justify-content-center p-5">
    <div class="p-3 mb-2 bg-white m-auto w-auto shadow mb-5 bg-body rounded">
      <div>
        <qrcode-vue :value="value" :size="size" level="H" class="m-auto"/>
      </div>
      <div class="row mt-3 m-auto w-100">
        <CButton type="submit" color="primary"><CIcon icon="cilDataTransferDown" size="md"/> Tải về</CButton>
      </div>
     
    </div>
   
  </div>
</template>
  
<script>
import QrcodeVue from 'qrcode.vue'
export default {
  data() {
    return {
      value: '12354',
      size: 300,
    }
  },
  components: {
    QrcodeVue,
  },
  setup() {

  },
  mounted() {

  },
};
</script>
    

  