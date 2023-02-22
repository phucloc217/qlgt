<template>
  <div>
    <table id="table" class="table table-secondary table-striped display nowrap mt-2 shadow mb-5 bg-body rounded">
      <thead>
        <tr>
          <th class="export-col">Mã</th>
          <th class="export-col">Tên thánh</th>
          <th class="export-col">Họ</th>
          <th class="export-col">Tên</th>
          <th class="export-col">Ngày sinh</th>
          <th class="export-col">Số điện thoại</th>
          <th class="export-col">Giáo họ</th>
          <th class="export-col">Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="export-col">2302201</td>
          <td class="export-col">Đaminh</td>
          <td class="export-col">Nguyễn Phúc</td>
          <td class="export-col">Lộc</td>
          <td class="export-col">21/07/2001</td>
          <td class="export-col">038.473.1507</td>
          <td class="export-col">Mẹ Thiên Chúa</td>
          <td class="export-col">Bình thường</td>
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
        <tr>
          <td class="export-col">123123123</td>
          <td class="export-col">Đaminh</td>
          <td class="export-col">Nguyễn Phúc</td>
          <td class="export-col">Lộc</td>
          <td class="export-col">21/07/2001</td>
          <td class="export-col">038.473.1507</td>
          <td class="export-col">Mẹ Thiên Chúa</td>
          <td class="export-col">Bình thường</td>
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
import 'datatables.net/js/jquery.dataTables'
import DataTable from "datatables.net-bs5/js/dataTables.bootstrap5";
import("datatables.net-buttons/js/dataTables.buttons");
import("datatables.net-buttons-bs5/js/buttons.bootstrap5");
import("datatables.net-buttons/js/buttons.html5");
import("datatables.net-buttons/js/buttons.print");
import("datatables.net-buttons/js/buttons.colVis");
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
      "buttons": [
        {
          extend: 'excel',
          exportOptions: {
            columns: '.export-col'
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: '.export-col'
          }
        },
        'colvis'
      ],
    });
  },
};
</script>
<style scoped>
.dropdown-toggle::after {
  content: none !important;
}
</style>
    

  