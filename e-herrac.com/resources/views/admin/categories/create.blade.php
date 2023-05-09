@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories - Add new</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
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
            <form action="{{ route('admin.categories.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                        id="name" value="{{ old('name') }}" name="name"/>
                                    @error('name')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="is_active">Status</label>
                                            <select name="is_active" id="is_active"
                                                class="form-control @error('is_active') is-invalid @enderror">
                                                <option value="1" @if (old('is_active', '1') === '1') selected @endif>Active</option>
                                                <option value="0" @if (old('is_active') === '0') selected @endif>Passive</option>
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
                                            <label for="parent_id">Parent</label>
                                            <select name="parent_id" id="parent_id" data-allow-clear="true" class="form-control @error('parent_id') is-invalid @enderror">
                                                <option value="" @if (old('parent_id') === '') selected @endif>Select parent</option>
                                                {!! $traverse($parents) !!}
                                            </select>
                                            @error('parent_id')
                                                <span id="parent_id-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
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
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/dist/font//font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/dist/jquery.fileuploader.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@push('js-libs')
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Jquery fileuploader -->
    <script src="{{ asset('assets/admin/plugins/fileuploader/dist/jquery.fileuploader.min.js') }}"></script>
    <!-- Ckeditor -->
    <script src="{{ asset('assets/admin/plugins/ckeditor4/ckeditor.js') }}"></script>
@endpush

@push('css-inline')
    <style>

    </style>
@endpush

@push('js-inline')
    <script>
        $(function() {

            $('select').selectInput().on('select2:select', function (e) {
                let name = $(e.target).attr('name');
                let value = $(e.target).val();
                switch (name) {
                    case 'status':
                        break;

                    default:
                        break;
                }
            });


        });
    </script>
@endpush
