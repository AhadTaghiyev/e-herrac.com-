@extends('admin.layouts.auth')

@section('title')
    Sistemə daxil ol
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{route('admin.login')}}"><b>E-herrac</b>.com</a>
        </div>
        <!-- /.login-logo -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Login to dashboard</h3>
            </div>
            <!-- /.login-card-header -->
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="card-body login-card-body">
                    {{-- <p class="login-box-msg">Daxil olmaq üçün istifadəçi adınızı və şifrənizi daxil edin</p> --}}
                    <div class="input-group mb-3">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.login-card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-block">Submit</button>
                </div>
                <!-- /.login-card-footer -->
            </form>
        </div>
    </div>
    <!-- /.login-box -->
@endsection

@push('css-libs')
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
@endpush

@push('css-inline')
<style>
</style>
@endpush

@push('js-libs')
    <!-- Toastr -->
    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
@endpush

@push('js-inline')
    <script>
        @error('auth')
            toastr.error('{{ $message }}');
        @enderror
    </script>
@endpush
