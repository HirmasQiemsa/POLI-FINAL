{{-- ada dua cara extend --}}
@extends('components.dokter')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pemeriksaan Pasien</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-dokter') }}">Dokter</a></li>
                            <li class="breadcrumb-item active">Pemeriksaan Pasien</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.List History Obat -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List Pemeriksaan Pasien</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Antrian</th>
                                            <th>Nama Pasien</th>
                                            <th>Keluhan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $d->no_antrian }}</td>
                                                <td>{{ $d->pasien->nama ?? 'Pasien tidak ditemukan'  }}</td>
                                                <td>{{ $d->keluhan }}</td>
                                                <td>
                                                    @php
                                                        $showEdit = $d->periksa
                                                            ->pluck('detailPeriksa')
                                                            ->flatten()
                                                            ->isNotEmpty();
                                                    @endphp

                                                    @if ($showEdit)
                                                        <a href="{{ route('edit-periksa', $d->periksa->first()->id) }}"
                                                            class="btn btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        {{-- <a href="#"
                                                            class="btn btn-success">
                                                            <i class="fas fa-archive"></i> Riwayat
                                                        </a> --}}
                                                    @else
                                                        <a href="{{ route('periksa', $d->id) }}">
                                                            <i class="fas fa-stethoscope"></i> Periksa
                                                        </a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
