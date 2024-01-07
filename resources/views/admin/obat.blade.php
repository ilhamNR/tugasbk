@extends('adminlte-layout.layout')
@section('title')
    Obat
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Obat</h3>
                        </div>
                        <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambah-obat">Tambah Data</button>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="obat-table" data-update={{ route('doktor.obat.update', '') }} data-edit={{ route('doktor.obat.edit','') }} data-route={{ route('doktor.obat') }}
                                class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
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

    <div class="modal fade" data-bs-backdrop="static" id="tambah-obat">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Obat</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('doktor.obat.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="obatName">Nama obat</label>
                            <input type="name" class="form-control" name="name" id="obatName" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="obatUnit">Satuan Obat</label>
                            <input type="name" class="form-control" name="unit" id="obatName" placeholder="Satuan">
                        </div>
                        <div class="form-group">
                            <label for="obatPrice">Harga (Rp)</label>
                            <input type="number" class="form-control" name="price" id="obatPrice" placeholder="Harga">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" data-bs-backdrop="static" id="update-obat">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Obat</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-data-form" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="obatName">Nama obat</label>
                            <input type="name" class="form-control" name="name" id="obatNameEdit" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="obatUnit">Satuan Obat</label>
                            <input type="name" class="form-control" name="unit" id="obatUnitEdit" placeholder="Satuan">
                        </div>
                        <div class="form-group">
                            <label for="obatPrice">Harga (Rp)</label>
                            <input type="number" class="form-control" name="price" id="obatPriceEdit" placeholder="Harga">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@vite('resources/js/admin/obat.js')
