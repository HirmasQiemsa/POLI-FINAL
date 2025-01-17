{{-- ada dua cara extend --}}
@extends('components.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Obat</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ '/kelola/obat' }}">Kelola Obat</a></li>
                            <li class="breadcrumb-item active">Edit Obat</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <form action="{{ route('update-obat',['id'=>$data->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Obat</h3>
                            </div>
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputObat1">Nama Obat</label>
                                        <input type="text" name="nama_obat" class="form-control" id="exampleInputObat1" value="{{ $data->nama_obat }}"
                                            placeholder="Nama Obat">
                                            @error('nama_obat')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputKemasan1">Kemasan</label>
                                        <input type="text" name="kemasan"  class="form-control" id="exampleInputKemasan1" value="{{ $data->kemasan }}"
                                            placeholder="Jenis Kemasan">
                                            @error('kemasan')
                                            <small> {{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputHarga1">Harga</label>
                                        <input type="number" name="harga"  class="form-control" id="exampleInputHarga1" value="{{ $data->harga }}"
                                            placeholder="Harga Obat">
                                            @error('harga')
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
