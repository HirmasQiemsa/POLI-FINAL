{{-- ada dua cara extend --}}
@extends('components.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Pasien</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ '/kelola/pasien' }}">Kelola Pasien</a></li>
                            <li class="breadcrumb-item active">Edit Pasien</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <form action="{{ route('update-pasien',['id'=>$data->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Pasien</h3>
                            </div>
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputPasien1">Nama Pasien</label>
                                        <input type="text" name="nama" class="form-control" id="exampleInputPasien1" value="{{ $data->nama }}"
                                            placeholder="Nama Pasien">
                                            @error('nama')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAlamat1">Alamat</label>
                                        <input type="text" name="alamat"  class="form-control" id="exampleInputAlamat1" value="{{ $data->alamat }}"
                                            placeholder="Alamat">
                                            @error('alamat')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNoKTP1">Nomor KTP</label>
                                        <input type="number" name="no_ktp"  class="form-control" id="exampleInputNoKTP1" value="{{ $data->no_ktp }}"
                                            placeholder="Nomor KTP">
                                            @error('no_ktp')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNoHP1">Nomor HP</label>
                                        <input type="number" name="no_hp"  class="form-control" id="exampleInputNoHP1" value="{{ $data->no_hp }}"
                                            placeholder="Nomor HP">
                                            @error('no_hp')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNoRM1">Nomor RM</label>
                                        <input disabled type="text" name="no_rm"  class="form-control" id="exampleInputNoRM1" value="{{ $data->no_rm }}"
                                            placeholder="Nomor RM">
                                            @error('no_rm')
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
