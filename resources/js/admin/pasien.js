import $ from "jquery";
// import 'popper.js';
import "bootstrap";
import "datatables.net-buttons-bs4";
import "datatables.net-responsive-bs4";
import Swal from "sweetalert2";

const periksaTable = $("#periksa-table");
const route = periksaTable.data("route");

var dt = $("#periksa-table")
.DataTable({
    processing: true,
    serverSide: true,
    ajax: route, // memanggil route yang menampilkan data json
    columns: [
        {
            data: 'patient_name',
            name: 'patient_name'
        },
        {
            data: 'queue_number',
            name: 'queue_number'
        },
        {
            data: 'complaints',
            name: 'complaints'
        },
        {
            data: "id",
            name: "id",
            render: function (data, type, row) {
                // Customize the content of the 'id' column
                return (
                    `
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item edit-button"  data-bs-toggle="modal" data-bs-target="#periksa_pasien" data-route="` +
                    data +
                    `">Periksa</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#riwayat_pasien" data-id="` +
                    data +
                    `" href="#">Riwayat</a>
                        </div>
                    </div>
                `
                );
            },
        },
    ],
    responsive: true,
    lengthChange: false,
    autoWidth: false,
    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
})
.buttons()
.container()
.appendTo("#periksa-table_wrapper .col-md-6:eq(0)");
// Event delegation for the "Hapus" button
