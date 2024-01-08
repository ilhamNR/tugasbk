import $ from "jquery";
// import 'popper.js';
import "bootstrap";
import "datatables.net-buttons-bs4";
import "datatables.net-responsive-bs4";
import Swal from "sweetalert2";

const periksaTable = $("#periksa-table");
const route = periksaTable.data("route");
// const riwayatTable = $("riwayat-table");
const riwayatRoute = periksaTable.data('riwayat');
var dt = $("#periksa-table")
    .DataTable({
        processing: true,
        serverSide: true,
        ajax: route, // memanggil route yang menampilkan data json
        columns: [
            {
                data: "patient_name",
                name: "patient_name",
            },
            {
                data: "queue_number",
                name: "queue_number",
            },
            {
                data: "complaints",
                name: "complaints",
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
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#riwayat_pasien" data-id="`+ riwayatRoute + `/` +
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

// Event handler for the "Riwayat" link
function handleRiwayatLinkClick(dataId) {
    // Replace this with your logic to handle the data-id
    // console.log('Data ID:', dataId);
    $("#riwayat-table")
        .DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: dataId,
            columns:[
                {
                    data: 'checkup_date',
                    name: 'checkup_date'
                },
                {
                    data: 'details',
                    name: 'details'
                },
                {
                    data: 'cost',
                    name: 'cost'
                },
            ],
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#riwayat-table_wrapper .col-md-6:eq(0)");
    // You can fetch data or perform other actions here
}

// Event delegation for the "Riwayat" link
$("#periksa-table").on(
    "click",
    '.dropdown-item[data-bs-target="#riwayat_pasien"]',
    function (event) {
        event.preventDefault();
        var dataId = $(this).data("id");
        handleRiwayatLinkClick(dataId);
    }
);

// Event listener for DataTable draw event
dt.on("draw.dt", function () {
    // Re-bind the event handler after each draw
    $("#periksa-table")
        .off("click", '.dropdown-item[data-bs-target="#riwayat_pasien"]')
        .on(
            "click",
            '.dropdown-item[data-bs-target="#riwayat_pasien"]',
            function (event) {
                event.preventDefault();
                var dataId = $(this).data("id");
                handleRiwayatLinkClick(dataId);
            }
        );
});
