import $ from "jquery";
// import 'popper.js';
import "bootstrap";
import "datatables.net-buttons-bs4";
import "datatables.net-responsive-bs4";
import Swal from "sweetalert2";

var dt = $("#obat-table")
.DataTable({
    processing: true,
    serverSide: true,
    ajax: route, // memanggil route yang menampilkan data json
    columns: [
        {
            data: "name",
            name: "name",
            searchable: "true",
        },
        {
            data: "unit",
            name: "unit",
            searchable: "false",
        },
        {
            data: "price",
            name: "price",
            searchable: "false",
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
                            <a class="dropdown-item edit-button"  data-bs-toggle="modal" data-bs-target="#update-obat" data-route="` +
                    edit +
                    "/" +
                    data +
                    `">Edit</a>
                            <a class="dropdown-item delete-button" data-id="` +
                    data +
                    `" href="#">Hapus</a>
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
.appendTo("#obat-table_wrapper .col-md-6:eq(0)");
// Event delegation for the "Hapus" button
