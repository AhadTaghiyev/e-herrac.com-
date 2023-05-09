@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles - Add new</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
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
            <form action="{{ route('admin.roles.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="name">Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                id="name" value="{{ old('name') }}" name="name"/>
                                            @error('name')
                                            <span id="name-error"
                                                class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label @error('permissions') is-invalid @enderror" for="permissions">Permissions</label>
                                            @error('permissions')
                                            <span id="permissions-error"
                                                class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="row">
                                                @foreach ($permissions as $group => $chunk)
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                    <span class="form-check">{{ucfirst($group)}}</span>
                                                    @foreach ($chunk as $permission)
                                                        <div class="form-check">
                                                        <input value="{{$permission->getOriginal('name')}}" id="permission_{{$permission->id}}" name="permissions[]" class="form-check-input" type="checkbox">
                                                        <label for="permission_{{$permission->id}}" class="form-check-label">{{$permission->name}}</label>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                                </div>
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
                        <div class="card card-primary card-outline">
                            <div class="card-body">

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>

    </section>
@endsection

@push('css-libs')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Jquery fileuploader -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/jquery.fileuploader.min.css') }}">
@endpush

@push('js-libs')
    <!-- Moment.js -->
    <script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('assets/admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Jquery fileuploader -->
    <script src="{{ asset('assets/admin/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
@endpush

@push('js-inline')
    <script>
        $(function() {

        });

    </script>
@endpush
