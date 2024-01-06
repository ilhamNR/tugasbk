import $ from "jquery";
// import 'popper.js';
import 'bootstrap';
import 'datatables.net-buttons-bs4';
import 'datatables.net-responsive-bs4';
import Swal from 'sweetalert2'

$(function () {
    $("#obat-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#obat-table_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
