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
                        <div class="col-md-12">
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
                                            <label for="exampleInputTglPeriksa">Tanggal Periksa</label>
                                            <input type="date" name="tgl_periksa" class="form-control" id="exampleInputTglPeriksa"
                                                placeholder="Tanggal Periksa" value="{{ $periksa->tgl_periksa }}">
                                            @error('tgl_periksa')
                                                <small>{{ $message }}</small>
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
                                            <label for="exampleInputObat">Obat</label>
                                            <select id="exampleInputObat" name="obat_ids[]" style="width: 100%;" multiple>
                                                @foreach ($obat as $o)
                                                <option value="{{ $o->id }}" {{ in_array($o->id, $periksa->obat_ids ?? []) ? 'selected' : '' }} data-harga="{{ $o->harga }}">{{ $o->nama_obat }} || {{ $o->kemasan }} || Rp.{{ $o->harga }},00</option>
                                                @endforeach
                                            </select>
                                            @error('obat_ids')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div id="selectedObat" class="form-group">
                                            <label>Obat yang Dipilih: </label>
                                            <div id="obatList">
                                                @foreach ($periksa->obat as $o)
                                                    <div>{{ $o->nama_obat }} - Rp.{{ $o->harga }},00</div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputTotalHarga">Total Harga</label>
                                            <input type="text" name="biaya_periksa" class="form-control"
                                                id="exampleInputTotalHarga" placeholder="Total Harga Berobat" readonly>
                                            <input type="hidden" name="biaya_periksa" id="hiddenBiayaPeriksa"
                                                value="{{ $periksa->biaya_periksa }}">
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
    <script>
        document.getElementById('exampleInputObat').addEventListener('change', function() {
            var selectedObat = Array.from(this.selectedOptions);
            var obatList = selectedObat.map(option => option.text).join('<br>');
            document.getElementById('obatList').innerHTML = obatList;

            var totalHarga = 150000; // Harga dasar
            selectedObat.forEach(option => {
                var harga = parseInt(option.getAttribute('data-harga'));
                if (!isNaN(harga)) {
                    totalHarga += harga;
                }
            });
            document.getElementById('exampleInputTotalHarga').value = 'Rp.' + totalHarga + ',00';
            document.getElementById('hiddenBiayaPeriksa').value = totalHarga;
        });

        window.addEventListener('load', function() {
            document.getElementById('exampleInputObat').dispatchEvent(new Event('change'));
        });
    </script>

@endsection
