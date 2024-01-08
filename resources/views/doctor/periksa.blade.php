@extends('adminlte-layout.layout')

@section('title')
    Pasien
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="periksa-table" data-riwayat="{{route('doktor.riwayat-pasien', '')}}" data-route={{ route('doktor.periksa') }}
                                class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Pasien</th>
                                        <th>No. Urut</th>
                                        <th>Keluhan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="periksa_pasien" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Periksa Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('dokter.finishPeriksa', '2') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="patient_name">Nama</label>
                            <input type="name" class="form-control" id="patient_name" placeholder="Nama" disabled>
                        </div>
                        <div class="form-group">
                            <label for="complaints">Keluhan</label>
                            <input type="name" class="form-control" id="complaints" placeholder="Complaints" disabled>
                        </div>
                        <div class="form-group">
                            <label>Obat</label>
                            <select name="medicines[]" multiple class="form-control medicines">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notes">Catatan</label>
                            <input type="name" name="notes" class="form-control" id="complaints"
                                placeholder="Complaints">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="riwayat_pasien" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Riwayat Pasien </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <table id="riwayat-table"  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal Periksa</th>
                                <th>Catatan</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add this script to your HTML file -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.querySelector('.medicines'); // Change the selector accordingly

            // Make an AJAX request to the specified URL
            fetch('{!! route('patient.getMedicine') !!}')
                .then(response => response.json())
                .then(data => {
                    // Clear existing options in the select element
                    selectElement.innerHTML = '';

                    // Populate the select element with options from the API response
                    data.forEach(function(medicine) {
                        var option = document.createElement('option');
                        option.value = medicine.id; // Set the value of the option
                        option.text = medicine.name; // Set the text content of the option
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection

@vite('resources/js/admin/pasien.js')
