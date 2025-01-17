{{-- ada dua cara extend --}}
@extends('components.dokter')
@section('content')
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Riwayat</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('list-riwayat-periksa') }}">Riwayat Periksa</a></li>
                            <li class="breadcrumb-item active">Detail Riwayat</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- card.body --}}
                {{-- <div class="card-header bg-success"></div> --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <button type="button" class="btn btn-success btn-lg btn-block" style="height: 40px;" disabled></button>
                        <thead>
                            <tr>
                                <th>No. Antrian </th>
                                <td style="text-align:center;">{{ $data->periksa->daftarPoli->no_antrian }}</td>
                            </tr>
                            <tr>
                                <th>Ruang Poli</th>
                                <td style="text-align:center;">
                                    {{ $data->periksa->daftarPoli->jadwalPeriksa->dokter->ruangPoli->nama_poli }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pasien</th>
                                <td style="text-align:center;">{{ $data->periksa->daftarPoli->pasien->nama }}
                                </td>
                            </tr>
                            <tr>
                                <th>Hari Praktek</th>
                                <td style="text-align:center;">{{ $data->periksa->daftarPoli->jadwalPeriksa->hari }}</td>
                            </tr>
                            <tr>
                                <th>Jam Pelayanan</th>
                                <td style="text-align:center;">
                                    {{ \Carbon\Carbon::parse($data->periksa->daftarPoli->jadwalPeriksa->jam_mulai)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($data->periksa->daftarPoli->jadwalPeriksa->jam_selesai)->format('H:i') }}
                                    WIB
                                </td>
                            </tr>
                            <tr>
                                <th colspan="9" style="height: 40px;"></th> <!-- Baris kosong -->
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>Catatan Dokter</th>
                                <td style="text-align:center;">{{ $data->periksa->catatan }}</td>
                            </tr>
                            <tr>
                                <th>Obat diresepkan </th>
                                <td style="text-align:center;">
                                    <div style="display: inline-block; text-align: left;">
                                        @foreach ($obat->obat as $o)
                                            {{ $loop->iteration }}. {{ $o->nama_obat }}<br>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal diperiksa </th>
                                <td style="text-align:center;">{{ \Carbon\Carbon::parse($data->periksa->tgl_periksa)->translatedFormat('d-F-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Total </th>
                                <td style="text-align:center;" class="btn-outline-danger">Rp{{ number_format($data->periksa->biaya_periksa, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a onclick="window.print()" class="btn btn-primary btn-block no-print" style="color: white">Cetak</a>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    {{-- script --}}
@endsection
