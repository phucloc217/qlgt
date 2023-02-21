<template>
  <div>
    <table id="table" class="table table-info table-striped display nowrap p-3 mt-2 shadow p-3 mb-5 bg-body rounded">
      <thead >
        <th>Mã</th>
        <th>Tên thánh</th>
        <th>Họ</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Số điện thoại</th>
        <th>Giáo họ</th>
        <th>Trạng thái</th>
        <th>Ghi chú</th>
        <th>Thao tác</th>
      </thead>
      <tbody>
        <tr>
          <td>2302201</td>
          <td>Đaminh</td>
          <td>Nguyễn Phúc Lộc</td>
          <td>21/07/2001</td>
          <td>038.473.1507</td>
          <td>Mẹ Thiên Chúa</td>
          <td>Bình thường</td>
          <td></td>
          <td></td>
          <td>d</td>
        </tr>
      </tbody>
      <tfoot>
        <thead>
          <th>Mã</th>
          <th>Tên thánh</th>
          <th>Họ</th>
          <th>Tên</th>
          <th>Ngày sinh</th>
          <th>Số điện thoại</th>
          <th>Giáo họ</th>
          <th>Trạng thái</th>
          <th>Ghi chú</th>
          <th>Thao tác</th>
        </thead>
      </tfoot>
    </table>
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
    window.JSZip = jsZip;
    $("#table").DataTable({
    dom: "Bfrtip",
    buttons: ["excel", "pdf", "print"],
    paging: true,
    language: {
      "paginate": {
        "previous": "Trang trước",
        "next": "Trang sau",
        
      },
      search: "Tìm kiếm",
  }
  });
  },
};
</script>
    

  