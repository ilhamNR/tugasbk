// import 'popper.js';
import * as $ from "jquery";
window.$ = window.jQuery = $;
import moment from 'moment';
// import 'admin-lte/plugins/moment/moment.min.js';
// import 'admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js';
import "bootstrap";
import "datatables.net-buttons-bs4";
import "datatables.net-responsive-bs4";
import Swal from "sweetalert2";
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

const periksaTable = $("#jadwal-periksa-table");
const route = periksaTable.data("route");
// const riwayatTable = $("riwayat-table");
const riwayatRoute = periksaTable.data('riwayat');
var dt = $("#jadwal-periksa-table")
    .DataTable({
        processing: true,
        serverSide: true,
        ajax: route, // memanggil route yang menampilkan data json
        columns: [
            {
                data: null,
                name: "number",
                render: function (data, type, row, meta) {
                    // Use meta.row to get the row index
                    return meta.row + 1;
                },
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "day",
                name: "day",
            },
            {
                data: "start_time",
                name: "start_time",
            },
            {
                data: "end_time",
                name: "end_time",
            },
            {
                data: "is_active",
                name: "is_active",
                render: function (data, type, row) {
                    // Customize the content of the 'is_active' column
                    return data == 1 ? 'Aktif' : 'Tidak Aktif';
                },
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
                            <a class="dropdown-item edit-button" data-bs-toggle="modal" data-bs-target="#edit-jadwal"
                                data-route="` + data + `" data-day="` + row.day + `" data-start-time="` + row.start_time + `" data-end-time="` + row.end_time + `">
                                Edit
                            </a>
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
    .appendTo("#jadwal-periksa-table_wrapper .col-md-6:eq(0)");

// Initialize Flatpickr with moment
flatpickr("#start_time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:mm",
    dateObj: true,
    // Use moment to parse and format dates
    parseDate: function (dateString) {
        return moment(dateString).toDate();
    },
    formatDate: function (date, formatString) {
        return moment(date).format(formatString);
    },
});

flatpickr("#end_time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:mm",
    dateObj: true,
    // Use moment to parse and format dates
    parseDate: function (dateString) {
        return moment(dateString).toDate();
    },
    formatDate: function (date, formatString) {
        return moment(date).format(formatString);
    },
});

// Initialize Flatpickr with moment
flatpickr("#start_timeEdit", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:mm",
    dateObj: true,
    // Use moment to parse and format dates
    parseDate: function (dateString) {
        return moment(dateString).toDate();
    },
    formatDate: function (date, formatString) {
        return moment(date).format(formatString);
    },
});

flatpickr("#end_timeEdit", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:mm",
    dateObj: true,
    // Use moment to parse and format dates
    parseDate: function (dateString) {
        return moment(dateString).toDate();
    },
    formatDate: function (date, formatString) {
        return moment(date).format(formatString);
    },
});

// Event listener for edit-button clicks
$('#jadwal-periksa-table').on('click', '.edit-button', function () {
    // Retrieve data attributes from the clicked button
    var route = $(this).data('route');
    var day = $(this).data('day');
    var startTime = $(this).data('start-time');
    var endTime = $(this).data('end-time');

    // Set the values in the modal
    $('#dayEdit').val(day);
    $('#start_timeEdit').val(startTime);
    $('#end_timeEdit').val(endTime);

    // Update the form action URL with the correct route
    $('#editJadwalForm').attr('action', route);
});

// Clear the modal values when the modal is hidden
$('#edit-jadwal').on('hidden.bs.modal', function () {
    $('#dayEdit').val('');
    $('#start_timeEdit').val('');
    $('#end_timeEdit').val('');
});


// Event listener for DataTable draw event
dt.on("draw.dt", function () {
    // Re-bind the event handler after each draw
    $("#jadwal-periksa-table")
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



