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
                        {{ auth()->user() }}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="obat-table" data-update={{ route('doktor.obat.update', '') }} data-edit={{ route('doktor.obat.edit','') }} data-route={{ route('doktor.obat') }}
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


@endsection
