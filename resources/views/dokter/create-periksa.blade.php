{{-- ada dua cara extend --}}
@extends('components.dokter')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Periksa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ '/periksa-pasien' }}">Pemeriksaan Pasien</a></li>
                            <li class="breadcrumb-item active">Periksa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('add-periksa') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Pasien </h3>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <input type="hidden" name="no_antrian" value="{{ $periksa->no_antrian }}">
                                        <div class="form-group">
                                            <label for="exampleInputNama">Nama Pasien</label>
                                            <input type="text" name="nama" class="form-control" id="exampleInputNama"
                                                placeholder="Nama Pasien" disabled value="{{ $periksa->pasien->nama }}">
                                            @error('nama')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTglPeriksa1">Tanggal Periksa</label>
                                            <input type="date" name="tgl_periksa" class="form-control"
                                                id="exampleInputTglPeriksa1" placeholder="Tanggal Periksa">
                                            @error('tgl_periksa')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCatatan">Catatan</label>
                                            <textarea type="text" name="catatan" class="form-control" id="exampleInputCatatan" placeholder="Catatan untuk Pasien"
                                                required></textarea>
                                            @error('catatan')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputRuangPoli">Obat</label>
                                            <select id="exampleInputRuangPoli" name="obat_ids[]" style="width: 100%;" multiple>
                                                @foreach ($obat as $o)
                                                    <option value="{{ $o->id }}" data-harga="{{ $o->harga }}">{{ $o->nama_obat }} || {{ $o->kemasan }} || Rp.{{ $o->harga }},00</option>
                                                @endforeach
                                            </select>
                                            @error('id_poli')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div id="selectedObat" class="form-group">
                                            <label>Obat yang Dipilih: </label>
                                            <div id="obatList"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTotalHarga">Total Harga</label>
                                            <input type="text" name="biaya_periksa" class="form-control" id="exampleInputTotalHarga" placeholder="Total Harga Berobat" value="Rp.{{ number_format($periksa->biaya_periksa, 0, ',', '.') }},00" disabled>
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
    <script>
        function updateTotalHarga() {
            var selectedObat = Array.from(document.getElementById('exampleInputRuangPoli').selectedOptions);
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
        }

        // Set initial value for total price
        document.getElementById('exampleInputTotalHarga').value = 'Rp. 150000,00';
        document.getElementById('hiddenBiayaPeriksa').value = 150000;

        // Trigger change event to ensure database updates
        document.getElementById('exampleInputRuangPoli').addEventListener('change', updateTotalHarga);
        document.dispatchEvent(new Event('change'));
    </script>



@endsection
