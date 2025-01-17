{{-- ada dua cara extend --}}
@extends('components.dokter')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Pemeriksaan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ '/periksa-pasien' }}">Pemeriksaan Pasien</a></li>
                            <li class="breadcrumb-item active">Edit Pemeriksaan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('update-periksa', ['id' => $periksa->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Pemeriksaan</h3>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <input type="hidden" name="no_antrian"
                                            value="{{ $periksa->daftarPoli->no_antrian }}">
                                        <div class="form-group">
                                            <label for="exampleInputNama">Nama Pasien</label>
                                            <input type="text" name="nama" class="form-control" id="exampleInputNama"
                                                placeholder="Nama Pasien" disabled
                                                value="{{ $periksa->daftarPoli->pasien->nama }}">
                                            @error('nama')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTglPeriksa1">Tanggal Periksa</label>
                                            <input type="date" name="tgl_periksa" class="form-control"
                                                id="exampleInputTglPeriksa1" placeholder="Tanggal Periksa"
                                                value="{{ date('Y-m-d\TH:i', strtotime($periksa->tgl_periksa)) }}">
                                            @error('tgl_periksa')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCatatan">Catatan</label>
                                            <textarea type="text" name="catatan" class="form-control" id="exampleInputCatatan" placeholder="Catatan untuk Pasien"
                                                required>{{ $periksa->catatan }}</textarea>
                                            @error('catatan')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputObat">Resepkan Obat</label>
                                            <select id="exampleInputObat" name="id_poli[]" style="width: 100%;" multiple >
                                                @foreach ($poli as $ruangPoli)
                                                <option value="{{ $ruangPoli->id }}" {{ in_array($ruangPoli->id, $dokter->id_poli) ? 'selected' : '' }}>{{ $ruangPoli->nama_poli }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_poli')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputTotalHarga">Total Harga</label>
                                            <input type="text" name="biaya_periksa" class="form-control" id="exampleInputTotalHarga" placeholder="Total Harga Berobat" readonly>
                                            <input type="hidden" name="biaya_periksa" id="hiddenBiayaPeriksa" value="{{ $periksa->biaya_periksa }}">
                                            @error('biaya_periksa')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <!--/.col (left) -->
                    </div>
                </form>

            </div>
        </section>
        <!-- /.content -->
    </div>
    {{-- script --}}

@endsection
