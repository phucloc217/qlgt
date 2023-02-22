<template>
  <div class="container d-flex align-items-center justify-content-center p-5">
    <div class="p-3 mb-2 bg-white m-auto w-auto shadow mb-5 bg-body rounded">
      <div>
        <qrcode-vue :value="value" :size="size" level="H" margin="2" class="m-auto" id="qrcode" />
      </div>
      <div class="row mt-3 m-auto w-100">
        <CButton type="submit" color="primary"  @click="download" >
          <CIcon icon="cilDataTransferDown" size="md"/> Tải về
        </CButton>
      </div>

    </div>

  </div>
</template>
  
<script>
import QrcodeVue from 'qrcode.vue'
export default {
  data() {
    return {
      value: '12354-Nguyễn Văn A - Mẹ Thiên Chúa',
      size: 300,
    }
  },
  methods: {
    download(event) {
      var canvas = document.getElementById("qrcode");
      let image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
      var link = document.createElement('a');
      link.download = "qrcode.png";
      link.href = image;
      link.click();
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
    

  