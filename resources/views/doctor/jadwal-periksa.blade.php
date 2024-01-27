@extends('adminlte-layout.layout')

@section('title')
    Jadwal Periksa
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Jadwal Periksa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">

                                </div>
                                <div class="col-md-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#tambah-jadwal"
                                        class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah Jadwal
                                        Periksa</button>

                                </div>
                            </div>
                            <table id="jadwal-periksa-table" data-route={{ route('doktor.jadwal-periksa', '') }}
                                class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Dokter</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Status</th>
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
    <!-- Modal -->
    <div class="modal fade" id="tambah-jadwal" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Periksa</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('doktor.jadwal-periksa') }}" method="POST" id="jadwalForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="day">Hari</label>
                            <select name="day" id="day" class="form-control" required>
                                <option value="" disabled selected>--Pilih Hari--</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="start_time">Jam Mulai:</label>
                                <input type="text" name="start_time" id="start_time" class="form-control" required>
                            </div>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="end_time">Jam Selesai:</label>
                                <input type="text" name="end_time" id="end_time" class="form-control" required>
                            </div>
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
<div class="modal fade" id="edit-jadwal" data-editRoute="{{route('doktor.update-jadwal-periksa','')}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Jadwal Periksa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doktor.update-jadwal-periksa','') }}" method="POST" id="editJadwalForm">
                @csrf
                @method('PUT') <!-- Add this line for a PUT request -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="day">Hari</label>
                        <select name="day" id="dayEdit" class="form-control" required disabled>
                            <option value="" disabled selected>--Pilih Hari--</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>

                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label for="start_time">Jam Mulai:</label>
                            <input disabled type="text" name="start_time" id="start_timeEdit" class="form-control" required>
                        </div>
                    </div>

                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label for="end_time">Jam Selesai:</label>
                            <input disabled type="text" name="end_time" id="end_timeEdit" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" value="1" >
                            <label class="form-check-label">Aktif</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="is_active" checked>
                            <label class="form-check-label">Tidak Aktif</label>
                          </div>
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

@endsection




@vite(['resources/js/doktor/jadwal-periksa.js'])
