<template>
  <div class="container d-flex align-items-center justify-content-center">
    <div class="p-3 mb-2 bg-white m-auto w-auto shadow mb-5 bg-body rounded">
      <div>
        <qr-stream @decode="onDecode" class="mb">
          <div style="color: red;" class="frame"></div>
        </qr-stream>
      </div>
    </div>

  </div>
  <div class="row result">
    Đã điểm danh: {{ data }}
  </div>
</template>

<script>
import { QrStream } from 'vue3-qr-reader';
export default {

  components: {
    QrStream,
  },
  setup() {


    // return {
    //   onDecode
    // }
  },
  data() {
    
    let data = []


    return {
      
      data,

    }
  },

  methods: {
    onDecode(data) {
      this.data = data
      this.$swal("Điểm danh thành công!", data,'success');
    }
  }

}
</script>
<style scoped>
.stream {
  max-height: 500px;
  max-width: 500px;
  margin: auto;
}

.frame {
  border-style: solid;
  border-width: 2px;
  border-color: red;
  height: 200px;
  width: 200px;
  position: absolute;
  top: 0px;
  bottom: 0px;
  right: 0px;
  left: 0px;
  margin: auto;
}
</style>