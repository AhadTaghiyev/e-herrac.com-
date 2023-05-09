@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages - Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.pages.update', $page->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $page->name) }}" name="name"/>
                                        @error('name')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $page->description) }}</textarea>
                                        @error('description')
                                            <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $page->content) }}</textarea>
                                        @error('content')
                                            <span id="content-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input class="form-control @error('meta.address') is-invalid @enderror" id="address" value="{{ old('meta.address', $page->getMeta('address')) }}" name="meta[address]"/>
                                        @error('meta.address')
                                            <span id="address-error" class="error invalid-feedback">{{ $message }}</span>
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
                                            <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                                                <option value="1" @if (old('is_active', (string)$page->is_active) === '1') selected @endif>Active</option>
                                                <option value="0" @if (old('is_active', (string)$page->is_active) === '0') selected @endif>Passive</option>
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
                                            <label for="is_active">Template</label>
                                            <select name="template" id="template" class="form-control @error('template') is-invalid @enderror">
                                                @foreach(\App\Models\Page::$templates as $key => $name)
                                                    <option value="{{$key}}" @if ($template === $key) selected @endif>{{$name}}</option>
                                                @endforeach
                                            </select>
                                            @error('template')
                                                <span id="template-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input class="form-control @error('meta.phone') is-invalid @enderror" id="phone" value="{{ old('meta.phone', $page->getMeta('phone')) }}" name="meta[phone]"/>
                                            @error('meta.phone')
                                                <span id="phone-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('meta.email') is-invalid @enderror" id="email" value="{{ old('meta.email', $page->getMeta('email')) }}" name="meta[email]"/>
                                            @error('meta.email')
                                                <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="map_coordinates">Map coordinates (lat,long)</label>
                                            <input type="map_coordinates" class="form-control @error('meta.map_coordinates') is-invalid @enderror" id="map_coordinates" value="{{ old('meta.map_coordinates', $page->getMeta('map_coordinates')) }}" name="meta[map_coordinates]"/>
                                            @error('meta.map_coordinates')
                                                <span id="map_coordinates-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <div class="form-group">
                                                <input data-fileuploader="single" data-fileuploader-files="{{$page->getPreloadedMedia('image')}}" type="file" name="image">
                                            </div>
                                            @error('image')
                                                <span id="image-error" class="error invalid-feedback">{{ $message }}</span>
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
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/dist/font/font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/dist/jquery.fileuploader.min.css') }}">
    <!-- Tagify -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/dist/tagify.css') }}">
@endpush

@push('js-libs')
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Jquery fileuploader -->
    <script src="{{ asset('assets/admin/plugins/fileuploader/dist/jquery.fileuploader.min.js') }}"></script>
    <!-- Ckeditor -->
    <script src="{{ asset('assets/admin/plugins/ckeditor4/ckeditor.js') }}"></script>
    <!-- Tagify -->
    <script src="{{ asset('assets/admin/plugins/tagify/dist/jQuery.tagify.min.js') }}"></script>
@endpush

@push('css-inline')
    <style>

    </style>
@endpush

@push('js-inline')
    <script>
        $(function() {

            $("#template").change(function(e) {
                let select_template_confirmation = confirm("Are you sure you want to change the page template? You will lose any unsaved modifications for this page.");
                if (select_template_confirmation == true) {
                    window.location.href = `{{url()->current()}}?template=${$("#template").val()}`;
                }
            });

            $('select').select2({
                minimumResultsForSearch: -1,
                placeholder: 'Select an option'
            }).on('select2:select', function (e) {
                let name = $(e.target).attr('name');
                let value = $(e.target).val();
                switch (name) {
                    case 'status':
                        break;

                    default:
                        break;
                }
            });

            CKEDITOR.replace( 'content', {
                filebrowserBrowseUrl: `{{route('elfinder.tinymce4')}}`,
            } );

        });
    </script>
@endpush
