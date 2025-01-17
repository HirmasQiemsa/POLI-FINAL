<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Pasien</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('img/logo_udinus_circle.png') }}" alt="AdminLTELogo"
            height="120" width="120">
    </div>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ '/login/pasien' }}" class="h1"><b>UDINUS</b> Poli Klinik</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register Pasien</p>

                <form action="{{ route('register-proses') }}" method="post">
                    @csrf
                    {{-- <div class="input-group mb-3">
                        <select name="role_levels" class="form-control">
                            <option>Pasien</option>
                        </select>
                        <div class="input-group-text">
                            <span class="fas fa-user-plus"></span>
                        </div>
                    </div> --}}

                    <div class="input-group mb-3">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Username (Nama KTP)" value="{{ old('nama') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Alamat KTP" value="{{ old('alamat') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-home"></span>
                            </div>
                        </div>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror"
                            placeholder="Nomor KTP" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('no_ktp')
                            <div class=invalid-feedback>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                            placeholder="Nomor HP (08 diawal)" value="{{ old('no_hp') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-mobile"></span>
                            </div>
                        </div>
                        @error('no_hp')
                            <div class=invalid-feedback>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="input-group mb-3">
                        <input disabled type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Nomor RM : " value="{{ old('no_rm') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('no_rm')
                            <div class=invalid-feedback>{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
    {{-- aler2 --}}
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- @if ($message = Session::get('succes'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif
    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif --}}
</body>

</html>
