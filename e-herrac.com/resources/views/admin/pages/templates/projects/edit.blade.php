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
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $language)
                                        <li class="nav-item">
                                            <a class="nav-link @if(config('app.locale') === $language) active @endif" id="tab_{{$language}}" data-toggle="pill" href="#tab_content_{{$language}}" role="tab" aria-controls="tab_content_{{$language}}" aria-selected="true">{{strtoupper($language)}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $language)
                                        <div class="tab-pane fade show @if(config('app.locale') === $language) active @endif" id="tab_content_{{$language}}" role="tabpanel" aria-labelledby="tab_{{$language}}">
                                            <div class="form-group">
                                                <label for="name_{{$language}}">Name</label>
                                                <input class="form-control @error('name.' . $language) is-invalid @enderror"
                                                    id="name_{{$language}}" value="{{ old('name.'.$language, $page->getTranslation('name', $language)) }}" name="name[{{$language}}]"/>
                                                @error('name.'.$language)
                                                <span id="name_{{$language}}-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description_{{$language}}">Description</label>
                                                <textarea class="form-control @error('description.' . $language) is-invalid @enderror"
                                                    id="description_{{$language}}" name="description[{{$language}}]">{{ old('description.' . $language, $page->getTranslation('description', $language)) }}</textarea>
                                                @error('description.' . $language)
                                                    <span id="description_{{$language}}-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="content_{{$language}}">Content</label>
                                                <textarea class="form-control @error('content.' . $language) is-invalid @enderror"
                                                    id="content_{{$language}}" name="content[{{$language}}]">{{ old('content.' . $language, $page->getTranslation('content', $language)) }}</textarea>
                                                @error('content.' . $language)
                                                <span id="content_{{$language}}-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="title_for_home_{{$language}}">Title for home</label>
                                                <input class="form-control @error('title_for_home.' . $language) is-invalid @enderror"
                                                    id="title_for_home_{{$language}}" value="{{ old('title_for_home.'.$language, optional($page->getMeta('title_for_home'))[$language]) }}" name="meta[title_for_home][{{$language}}]"/>
                                                @error('title_for_home.'.$language)
                                                <span id="title_for_home_{{$language}}-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description_for_home_{{$language}}">Description for home</label>
                                                <textarea class="form-control @error('description_for_home.' . $language) is-invalid @enderror"
                                                    id="description_for_home_{{$language}}" name="meta[description_for_home][{{$language}}]">{{ old('description_for_home.' . $language, optional($page->getMeta('description_for_home'))[$language]) }}</textarea>
                                                @error('description_for_home.' . $language)
                                                    <span id="description_for_home_{{$language}}-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
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
                                            <select name="template" id="template"
                                                class="form-control @error('template') is-invalid @enderror">
                                                @foreach(\App\Models\Page::$templates as $key => $name)
                                                <option value="{{$key}}" @if ($template === $key) selected @endif>{{$name}}</option>
                                            @endforeach
                                            </select>
                                            @error('template')
                                            <span id="template-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cover_image">Cover image</label>
                                            <div class="form-group">
                                                <input data-fileuploader="single" data-fileuploader-files="{{$page->getPreloadedMedia('cover_image')}}" type="file" name="cover_image">
                                            </div>
                                            @error('cover_image')
                                            <span id="cover_image-error" class="error invalid-feedback">{{ $message }}</span>
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

            @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $language)
                CKEDITOR.replace( 'content[{{$language}}]', {
                    filebrowserBrowseUrl: `{{route('elfinder.tinymce4')}}`,
                } );
            @endforeach


        });
    </script>
@endpush
