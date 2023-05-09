@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if(auth()->user()->can('page-list') || auth()->user()->can('page-create') || auth()->user()->can('page-edit') || auth()->user()->can('page-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.pages.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning"><i class="fas fa-file"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pages</span>
                                    <span class="info-box-number">{{$counts['page']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('advertisement-list') || auth()->user()->can('advertisement-create') || auth()->user()->can('advertisement-edit') || auth()->user()->can('advertisement-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.advertisements.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-primary"><i class="fas fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Advertisements</span>
                                    <span class="info-box-number">{{$counts['advertisement']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('auction-list') || auth()->user()->can('auction-create') || auth()->user()->can('auction-edit') || auth()->user()->can('auction-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.auctions.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-fuchsia"><i class="fas fa-user-shield"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Auctions</span>
                                    <span class="info-box-number">{{$counts['auction']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('category-list') || auth()->user()->can('category-create') || auth()->user()->can('category-edit') || auth()->user()->can('category-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.categories.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger"><i class="fas fa-list"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Categories</span>
                                    <span class="info-box-number">{{$counts['category']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('region-list') || auth()->user()->can('region-create') || auth()->user()->can('region-edit') || auth()->user()->can('region-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.regions.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success"><i class="fas fa-map-marker"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Regions</span>
                                    <span class="info-box-number">{{$counts['region']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('slide-list') || auth()->user()->can('slide-create') || auth()->user()->can('slide-edit') || auth()->user()->can('slide-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.slides.index')}}">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-sliders-h"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Slides</span>
                                    <span class="info-box-number">{{$counts['slide']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('menu-list') || auth()->user()->can('menu-create') || auth()->user()->can('menu-edit') || auth()->user()->can('menu-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.menus.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-primary"><i class="fas fa-list"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Menus</span>
                                    <span class="info-box-number">{{$counts['menu']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('role-list') || auth()->user()->can('role-create') || auth()->user()->can('role-edit') || auth()->user()->can('role-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.roles.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-fuchsia"><i class="fas fa-user-shield"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Roles</span>
                                    <span class="info-box-number">{{$counts['role']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('permission-list') || auth()->user()->can('permission-create') || auth()->user()->can('permission-edit') || auth()->user()->can('permission-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.permissions.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-olive"><i class="fas fa-shield-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Permissions</span>
                                    <span class="info-box-number">{{$counts['permission']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('user-list') || auth()->user()->can('user-create') || auth()->user()->can('user-edit') || auth()->user()->can('user-delete'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="link-info-box" href="{{route('admin.users.index')}}">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-indigo"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Users</span>
                                    <span class="info-box-number">{{$counts['user']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection


@push('css-libs')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush

@push('css-inline')
    <style>
        .card {
            box-shadow: none;
            border: 1px solid rgba(0, 0, 0, .125);
        }

        .link-info-box {
            color: #000;
        }

    </style>
@endpush

@push('js-libs')

@endpush
