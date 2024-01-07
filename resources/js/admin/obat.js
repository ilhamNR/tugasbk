import $ from "jquery";
// import 'popper.js';
import "bootstrap";
import "datatables.net-buttons-bs4";
import "datatables.net-responsive-bs4";
import Swal from "sweetalert2";

const obatTable = $("#obat-table");
const route = obatTable.data("route");
const edit = obatTable.data("edit");
const update = obatTable.data("update");

// Define the loadObatData function
export function loadObatData(element) {
    var route = $(element).data("route");

    // Make an AJAX request to the specified route
    $.ajax({
        url: route,
        type: "GET",
        dataType: "json",
        success: function (data) {
            // Populate the modal with the retrieved data
            $("#obatNameEdit").val(data.name);
            $("#obatUnitEdit").val(data.unit);
            $("#obatPriceEdit").val(data.price);
            $("#update-data-form").attr("action", update + `/` + data.id);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error if needed
        },
    });
}

$(function () {
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

    $("#obat-table").on("click", ".edit-button", function () {
        loadObatData(this);
    });

    $("#obat-table").on("click", ".delete-button", function () {
        // Get the value from the data-id attribute
        var id = $(this).data("id");
        Swal.fire({
            title: "Hapus data",
            text: "Apakah Anda yakin ingin menghapus Obat ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with the DELETE request
                fetch("http://tugasbk.test/obat/delete/" + id, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        // Add any additional headers if required
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        // Handle the response as needed (e.g., show a success message)
                        // console.log("API Response:", data.success);
                        Swal.fire("Deleted!", data.success, "success");
                        console.log(dt);
                        // Remove the row from DataTables
                        dt.row($(this).parents("tr")).remove().draw();
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        // Handle the error
                        Swal.fire("Error!", "An error occurred.", "error");
                    });
            }
        });
    });
});
