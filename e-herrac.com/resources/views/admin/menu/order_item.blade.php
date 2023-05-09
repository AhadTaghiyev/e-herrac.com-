@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu ({{$menu->name}}) - Order item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.menus.index', $menu->id) }}">Menus</a></li>
                        <li class="breadcrumb-item active">Order item</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div id="nestable" class="dd">
                    @include('admin.menu.treeView', ['items' => $menu->parentItems])
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection


@push('css-libs')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
<!-- Jquery Nestable -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/jquery-nestable/jquery.nestable.min.css') }}">
@endpush


@push('js-libs')
<!-- Toastr -->
<script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
<!-- Jquery Nestable -->
<script src="{{ asset('assets/admin/plugins/jquery-nestable/jquery.nestable.min.js') }}"></script>
@endpush


@push('js-inline')
<script>
    $(function () {
        $('#nestable').nestable();
        $('.dd').on('change', function (e) {
        $.post('{{ route('admin.menus.save_order_item', ['menu' => $menu->id]) }}', {
                order: JSON.stringify($('.dd').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            }, function (data) {
                toastr.success("Successfully updated menu order.");
            });
        });
      @if (session('success'))
        toastr.success('{{session('success')}}');
      @endif
    });
  </script>
@endpush


@push('css-inline')
<style>

</style>
@endpush
