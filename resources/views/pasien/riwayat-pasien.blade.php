{{-- ada dua cara extend --}}
@extends('components.pasien')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Riwayat Periksa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-pasien') }}">Pasien</a></li>
                            <li class="breadcrumb-item active">Riwayat Periksa</li>
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
                            {{-- card.header --}}
                            <div class="card-header">
                                <h3 class="card-title btn-outline-dark">Daftar Riwayat</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="search" name="table_search" class="form-control float-right"
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
                            {{-- card.body --}}
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Dokter</th>
                                            <th>Keluhan</th>
                                            <th>Antrian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->jadwalPeriksa->dokter->nama }}</td>
                                                <td>{{ $d->keluhan }}</td>
                                                <td>{{ $d->no_antrian }}</td>
                                                <td>
                                                    @php
                                                        $showRiwayat = $d->periksa
                                                            ->pluck('detailPeriksa')
                                                            ->flatten()
                                                            ->isNotEmpty();
                                                    @endphp

                                                    @if ($showRiwayat)
                                                        <a href="{{ route('riwayat', $d->periksa->last()->id) }}"
                                                            class="btn btn-success">
                                                            <i class="fas fa-archive"></i> Riwayat
                                                        </a>
                                                    @else
                                                        <a class="btn btn-warning">
                                                        <i class="fas fa-spinner"></i> Belum di periksa
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
