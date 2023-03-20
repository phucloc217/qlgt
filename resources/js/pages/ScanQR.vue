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
    let validId = null
    let thanhvien = null
    return {
      data,
      validId,
      thanhvien,
      form: {
        madiemdanh: '',
        mathanhvien: '',
      }
    }
  },

  methods: {
    onDecode(data) {
      this.checkThanhVienIsValid(data);             
    },
    async checkValidID() {
      let id = this.$router.currentRoute._value.params.id
      await axios.get(this.API_URL + '/diemdanh/' + id)
        .then(data => this.validId = data.data)
        .catch(response => console.log(response));
      if (this.validId == null) this.$router.push({ path: '/404' })
    },    
    async checkThanhVienIsValid(id) {
      await axios.get(this.API_URL + '/thanhvien/' + id)
        .then(data => this.thanhvien = data.data)
        .catch(response => console.log(response));
      if (this.thanhvien == null) {
        this.$swal({
          title: 'Thành viên không tồn tại',
          icon: 'error',
        }, 'error')
      }
      else {
        if (this.diemDanh(id)) {
          this.data.push(this.thanhvien)
          this.thanhvien=null
          this.$swal({
            title: 'Điểm danh thành công',
            icon: 'success',
          }, 'success')
        }
        else
        {
          this.$swal({
            title: 'Điểm danh không thành công',
            icon: 'error',
          }, 'error')
        }
      }
    },
    async diemDanh(idthanhvien) {
      this.form.madiemdanh = this.$router.currentRoute._value.params.id[0];
      this.form.mathanhvien = idthanhvien;
      await axios.post(this.API_URL + '/diemdanhqr', this.form)
        .then(function (res) {
          return 1;
        })
        .catch(response => console.log(response));
    }

  },
  created() {
    this.checkValidID();
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