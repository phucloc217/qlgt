<template>
  <div>
    <table id="table" class="table table-secondary table-striped display nowrap p-3 mt-2 shadow p-3 mb-5 bg-body rounded">
      <thead>
        <tr>
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
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2302201</td>
          <td>Đaminh</td>
          <td>Nguyễn Phúc</td>
          <td>Lộc</td>
          <td>21/07/2001</td>
          <td>038.473.1507</td>
          <td>Mẹ Thiên Chúa</td>
          <td>Bình thường</td>
          <td></td>
          <td>
            <CDropdown>
              <CDropdownToggle>
                <CIcon icon="cilOptions" size="md" />
              </CDropdownToggle>
              <CDropdownMenu>
                <CDropdownItem href="#">Chỉnh sửa</CDropdownItem>
                <CDropdownItem href="#">Xóa</CDropdownItem>
              </CDropdownMenu>
            </CDropdown>

          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
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
        </tr>
      </tfoot>
    </table>
  </div>
</template>
  
<script>
import $ from "jquery";
import jsZip from "jszip";
import("pdfmake");
import DataTable from "datatables.net-bs5";
import("datatables.net-buttons-bs5");
import("datatables.net-buttons/js/buttons.html5.js");
import("datatables.net-buttons/js/buttons.print.js");
import("datatables.net-responsive-bs5");
import("datatables.net-searchpanes-bs5");
export default {

  setup() {

  },
  mounted() {
    window.JSZip = jsZip;
    $("#table").DataTable({
      "dom": 'Bfrtip',
      "paging": true,
      "searching": true,
      "responsive": true,
      "language": {
        "paginate": {
          "previous": "Trang trước",
          "next": "Trang sau",
        },
        "search": "Tìm kiếm",
        "lengthMenu": "Hiển thị _MENU_ mục",
        "info": "",
        "infoEmpty": "Không có kết quả để hiển thị",
        "zeroRecords": "Không có kết quả để hiển thị",
      },
      buttons: [
        'excel'
      ],
    });
  },
};
</script>
    

  