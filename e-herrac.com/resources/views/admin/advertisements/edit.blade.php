@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Advertisements - Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.advertisements.index') }}">Advertisements</a></li>
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
            <form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $advertisement->name) }}" name="name"/>
                                    @error('name')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $advertisement->content) }}</textarea>
                                    @error('content')
                                        <span id="content-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ old('notes', $advertisement->notes) }}</textarea>
                                    @error('notes')
                                        <span id="notes-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label style="width:100%;text-align:center;" for="images">Images</label>
                                        <input data-fileuploader-files="{{$advertisement->getPreloadedMedia('images')}}" class="form-control @error('images') is-invalid @enderror" type="file" data-fileuploader="multiple" name="images">
                                    @error('images')
                                        <span id="images-error" class="error invalid-feedback">{{ $message }}</span>
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
                                                <option value="1" @if (old('is_active', (string)$advertisement->is_active) === '1') selected @endif>Active</option>
                                                <option value="0" @if (old('is_active', (string)$advertisement->is_active) === '0') selected @endif>Passive</option>
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
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price', $advertisement->price) }}" name="price"/>
                                                <div class="input-group-append">
                                                    <select name="currency" data-placeholder="Select currency" id="currency" class="form-control @error('currency') is-invalid @enderror">
                                                        @foreach(\App\Models\Advertisement::$currencies as $key => $value)
                                                            <option value="{{$key}}" @if(old('currency', (string)$advertisement->currency) === (string)$key) selected @endif>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @error('price')
                                                <span id="price-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input value="1" name="is_featured" type="checkbox" class="custom-control-input" id="is_featured" @if(old('is_featured', $advertisement->is_featured)){{'checked'}}@endif>
                                                <label class="custom-control-label" for="is_featured">Is featured?</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="auction_id">Auction</label>
                                            <select name="auction_id" data-placeholder="Select auction" id="auction_id" class="form-control @error('auction_id') is-invalid @enderror">
                                                <option></option>
                                                @foreach ($auctions as $auction)
                                                    <option value="{{$auction->id}}" @if(old('auction_id', (string)$advertisement->auction_id) === (string)$auction->id) selected @endif>{{$auction->date->format('d.m.Y')}}</option>
                                                @endforeach
                                            </select>
                                            @error('auction_id')
                                                <span id="auction_id-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="region_id">Region</label>
                                            <select name="region_id" data-placeholder="Select region" id="region_id" class="form-control @error('region_id') is-invalid @enderror">
                                                <option></option>
                                                @foreach ($regions as $region)
                                                    <option value="{{$region->id}}" @if(old('region_id', (string)$advertisement->region_id) === (string)$region->id) selected @endif>{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('region_id')
                                                <span id="region_id-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id" data-placeholder="Select category" class="form-control @error('category_id') is-invalid @enderror">
                                                <option value=""></option>
                                                {!! $traverse($categories, '', old('category_id', (string)$advertisement->category_id)) !!}
                                            </select>
                                            @error('category_id')
                                                <span id="category_id-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <div class="form-group">
                                                <input data-fileuploader="single" data-fileuploader-files="{{$advertisement->getPreloadedMedia('image')}}" type="file" name="image">
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
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <!-- Jquery fileuploader -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/dist/font/font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fileuploader/dist/jquery.fileuploader.min.css') }}">
@endpush

@push('js-libs')
    <!-- Moment.js -->
    <script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
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
