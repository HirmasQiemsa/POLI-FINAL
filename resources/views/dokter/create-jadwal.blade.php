{{-- ada dua cara extend --}}
@extends('components.dokter')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Jadwal</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ '/jadwal-dokter' }}">Jadwal Praktek</a></li>
                            <li class="breadcrumb-item active">Tambah Jadwal</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('add-jadwal') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah Jadwal</h3>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputNamaDokter1">Nama Dokter</label>
                                            <input type="text" style="width: 100%" id="dokter" name="dokter" value="{{ $dokter->nama }}" disabled>
                                            {{-- <select nama="id_dokter" id="id_dokter" required>
                                                @foreach ($dokter as $d)
                                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                @endforeach
                                            </select> --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputHari1">Hari</label>
                                            <input type="text" name="hari" class="form-control"
                                                id="exampleInputHari1" placeholder="Hari Praktek">
                                            @error('hari')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputJamMulai1">Jam Mulai</label>
                                            <input type="time" name="jam_mulai" class="form-control"
                                                id="exampleInputJamMulai1" placeholder="Jam Mulai Praktek">
                                            @error('jam_mulai')
                                                <small> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputJamSelesai1">Jam Selesai</label>
                                            <input type="time" name="jam_selesai" class="form-control"
                                                id="exampleInputJam Selesai1" placeholder="Jam Selesai Praktek">
                                            @error('jam_selesai')
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
@endsection
