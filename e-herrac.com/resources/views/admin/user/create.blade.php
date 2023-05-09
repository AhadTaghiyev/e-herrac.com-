@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users - Add new</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Əsas səhifə</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">Add new</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.users.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input value="{{ old('username') }}" type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                id="username" name="username" autocomplete="off">
                                            @error('username')
                                            <span id="username-error"
                                                class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input value="{{ old('email') }}" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" autocomplete="off">
                                            @error('email')
                                            <span id="email-error"
                                                class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input value="{{ old('password') }}" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" autocomplete="off">
                                            @error('password')
                                            <span id="password-error"
                                                class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">Password confirmation</label>
                                            <input value="{{ old('password_confirmation') }}" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" name="password_confirmation" autocomplete="off">
                                            @error('password_confirmation')
                                            <span id="password_confirmation-error"
                                                class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first_name">First name</label>
                                            <input value="{{ old('first_name') }}" type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                id="first_name" name="first_name" placeholder="">
                                            @error('first_name')
                                            <span id="first_name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input value="{{ old('last_name') }}" type="text"
                                                class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                                name="last_name" placeholder="">
                                            @error('last_name')
                                            <span id="last_name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-3">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="is_active">Status</label>
                                            <select name="is_active" id="is_active"
                                                class="form-control @error('is_active') is-invalid @enderror">
                                                <option value="1" @if (old('is_active', '1') === '1') selected @endif>Active</option>
                                                <option value="0" @if (old('is_active') === '0') selected @endif
                                                    >Passive</option>
                                            </select>
                                            @error('is_active')
                                            <span id="is_active-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select name="role" id="role"
                                                class="form-control @error('role') is-invalid @enderror">
                                                <option value="" @if (old('role') === '') selected @endif>Select role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" @if (old('role') === $role->id) selected
                                                @endif>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <span id="role-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <div class="form-group">
                                                <input data-fileuploader="single" type="file" name="photo">
                                            </div>
                                            @error('photo')
                                            <span id="photo-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
            </form>
        </div>

    </section>
@endsection

@push('css-libs')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <!-- Jquery fileuploader -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/jquery.fileuploader.min.css') }}">
@endpush

@push('js-libs')
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Jquery fileuploader -->
    <script src="{{ asset('assets/admin/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
@endpush

@push('js-inline')
    <script>
        $(function() {
            $('select').select2({
                minimumResultsForSearch: -1,
                placeholder: 'Select an option'
            }).on('select2:select', function (e) {
                let name = $(e.target).attr('name');
                let value = $(e.target).val();
                switch (name) {
                    case 'status':
                        console.log(name, value);
                        break;

                    default:
                        break;
                }
            });

        });

    </script>
@endpush
