{{-- ada dua cara extend --}}
@extends('components.pasien')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Poli</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ '/daftar/poli' }}">Menu Pasien</a></li>
                            <li class="breadcrumb-item active">Daftar Poli</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('add-daftar-poli') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Poli</h3>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputNoRM1">No. Rekam Medis</label>
                                            <input type="text" name="no_rm" class="form-control" id="exampleInputNoRM1"
                                                placeholder="No. Rekam Medis" disabled value="{{ $pasien->no_rm }}">
                                            @error('no_rm')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputRuangPoli">Ruang Poli</label>
                                            <select id="exampleInputRuangPoli" name="id_poli" style="width: 100%;" required>
                                                @foreach ($jadwal->unique('dokter.ruangPoli.id') as $p)
                                                    @if ($p->dokter && $p->dokter->ruangPoli)
                                                        <option value="{{ $p->dokter->ruangPoli->id }}">
                                                            {{ $p->dokter->ruangPoli->nama_poli }}
                                                        </option>
                                                    @else
                                                        <option value="">Dokter atau Ruang Poli tidak ditemukan
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('id_poli')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPilihJadwal">Pilih Jadwal</label>
                                            <select id="exampleInputPilihJadwal" name="id_jadwal" style="width: 100%;"
                                                required>
                                                @foreach ($jadwal as $j)
                                                    @if ($j->dokter)
                                                        <option value="{{ $j->id }}"
                                                            data-poli-id="{{ $j->dokter->ruangPoli->id }}">
                                                            Dokter {{ $j->dokter->nama }} | Hari {{ $j->hari }} |
                                                            {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} -
                                                            {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }} WIB
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('id_jadwal')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputKeluhan1">Keluhan</label>
                                            <textarea type="text" name="keluhan" class="form-control" id="exampleInputKeluhan1"
                                                placeholder="Keluhan Yang Dirasakan"></textarea>
                                            @error('keluhan')
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

        {{-- Setup Option  --}}
        <script>
            document.getElementById('exampleInputRuangPoli').addEventListener('change', function () {
            var poliId = this.value;
            var jadwalSelect = document.getElementById('exampleInputPilihJadwal');
            var jadwalOptions = jadwalSelect.getElementsByTagName('option');

            // Reset pilihan jadwal
            jadwalSelect.value = '';

            // Tampilkan atau sembunyikan opsi berdasarkan poliId
            for (var i = 0; i < jadwalOptions.length; i++) {
                var option = jadwalOptions[i];
                if (option.getAttribute('data-poli-id') == poliId) {
                    option.style.display = ''; // Tampilkan opsi
                    option.disabled = false; // Pastikan opsi tidak disabled
                } else {
                    option.style.display = 'none'; // Sembunyikan opsi
                    option.disabled = true; // Disable opsi
                }
            }

            // Pilih opsi pertama yang relevan secara otomatis
            for (var i = 0; i < jadwalOptions.length; i++) {
                if (jadwalOptions[i].style.display !== 'none') {
                    jadwalOptions[i].selected = true;
                    break;
                }
            }
            });

            // Penanganan saat halaman pertama kali dimuat
            window.addEventListener('load', function () {
                var initialPoliId = document.getElementById('exampleInputRuangPoli').value;
                var jadwalSelect = document.getElementById('exampleInputPilihJadwal');
                var jadwalOptions = jadwalSelect.getElementsByTagName('option');

                for (var i = 0; i < jadwalOptions.length; i++) {
                    var option = jadwalOptions[i];
                    if (option.getAttribute('data-poli-id') == initialPoliId) {
                        option.style.display = ''; // Tampilkan opsi
                        option.disabled = false; // Pastikan opsi tidak disabled
                    } else {
                        option.style.display = 'none'; // Sembunyikan opsi
                        option.disabled = true; // Disable opsi
                    }
                }

                // Pilih opsi pertama yang relevan secara otomatis
                for (var i = 0; i < jadwalOptions.length; i++) {
                    if (jadwalOptions[i].style.display !== 'none') {
                        jadwalOptions[i].selected = true;
                        break;
                    }
                }
            });
        </script>
    </div>
@endsection
