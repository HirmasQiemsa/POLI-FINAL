{{-- ada dua cara extend --}}
@extends('components.dokter')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Riwayat Pemeriksaan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-dokter') }}">Dokter</a></li>
                            <li class="breadcrumb-item active">Riwayat Pemeriksaan</li>
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
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="search" id="tableSearch" name="table_search" class="form-control float-right"
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
                                <table id="dataTable" class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pasien</th>
                                            <th>Alamat</th>
                                            <th style="text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            @php
                                                $showRiwayat = $d->periksa
                                                    ->pluck('detailPeriksa')
                                                    ->flatten()
                                                    ->isNotEmpty();
                                            @endphp

                                            @if ($showRiwayat)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $d->pasien->nama ?? 'Pasien tidak ditemukan' }}</td>
                                                    <td>{{ $d->pasien->alamat ?? 'Alamat tidak ditemukan' }}</td>
                                                    <td style="text-align: center">
                                                        <a href="{{ route('riwayat-periksa', $d->periksa->last()->id) }}"
                                                            class="btn btn-success">
                                                            <i class="fas fa-archive"></i> Riwayat
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
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
    {{-- Script --}}
    <script>
        document.getElementById('tableSearch').addEventListener('keyup', function () {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll('#dataTable tbody tr');

            rows.forEach(row => {
                let rowText = row.innerText.toLowerCase();
                row.style.display = rowText.includes(input) ? '' : 'none';
            });
        });
    </script>
@endsection
