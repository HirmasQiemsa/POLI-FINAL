{{-- ada dua cara extend --}}
@extends('components.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Dokter</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ '/kelola/dokter' }}">Kelola Dokter</a></li>
                            <li class="breadcrumb-item active">Tambah Dokter</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <form action="{{ route('add-dokter') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Dokter</h3>
                            </div>
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputDokter1">Nama Dokter</label>
                                        <input type="text" name="nama" class="form-control" id="exampleInputDokter1"
                                            placeholder="Nama Dokter">
                                            @error('nama')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAlamat1">Alamat</label>
                                        <input type="text" name="alamat"  class="form-control" id="exampleInputAlamat1"
                                            placeholder="Alamat">
                                            @error('alamat')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNoHp1">No Handphone</label>
                                        <input type="text" name="no_hp"  class="form-control" id="exampleInputNoHp1"
                                            placeholder="Nomor Hp">
                                            @error('no_hp')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password"  class="form-control" id="exampleInputPassword1"
                                            placeholder="Password">
                                            @error('password')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputRuangPoli">Ruang Poli</label>
                                        <select id="exampleInputRuangPoli" name="id_poli" style="width: 100%;" required>
                                            @foreach ($poli as $ruangPoli)
                                            <option value="{{ $ruangPoli->id }}">{{ $ruangPoli->nama_poli }} </option>
                                            @endforeach
                                        </select>
                                        @error('id_poli')
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
