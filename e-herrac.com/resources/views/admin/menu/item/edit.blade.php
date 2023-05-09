@extends('admin.layouts.app')

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menus ({{$menu->name}}) - Menu items - Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.menus.index') }}">Menus</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.menus.items.index', $menu->id) }}">Menu items</a></li>
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
            <form action="{{ route('admin.menus.items.update', [$menu->id, $item->id]) }}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="relation_type">Relation type</label>
                                            <select name="relation_type" id="relation_type" class="form-control @error('relation_type') is-invalid @enderror">
                                                <option value="home" @if (old('relation_type', $item->relation_type) === 'home') selected @endif>Home page</option>
                                                <option value="page" @if (old('relation_type', $item->relation_type) === 'page') selected @endif>Page</option>
                                                <option value="category" @if (old('relation_type', $item->relation_type) === 'category') selected @endif>Category</option>
                                                <option value="external_url" @if (old('relation_type', $item->relation_type) === 'external_url') selected @endif>External url</option>
                                            </select>
                                            @error('relation_type')
                                                <span id="relation_type-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="relation_object">Relation object</label>
                                            <select value="{{$item->relation_object}}" data-ajax="list" data-rel_from="#relation_type" name="relation_object" id="relation_object" class="form-control @error('relation_object') is-invalid @enderror" disabled>
                                            </select>
                                            @error('relation_object')
                                                <span id="relation_object-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="parent_id">Parent</label>
                                            <select name="parent_id" id="parent_id"
                                                class="form-control @error('parent_id') is-invalid @enderror">
                                                <option></option>
                                                @foreach ($parents as $parent)
                                                    <option value="{{ $parent->id }}" @if (old('parent_id', (string)$item->parent_id) === (string) $parent->id) selected @endif>{{ $parent->text }}</option>
                                                @endforeach
                                            </select>
                                            @error('parent_id')
                                            <span id="parent_id-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="label">Label</label>
                                            <input class="form-control @error('label') is-invalid @enderror" id="label" value="{{ old('label', $item->label) }}" name="label"/>
                                            @error('label')
                                            <span id="label-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="url">Url</label>
                                            <input class="form-control @error('url') is-invalid @enderror" id="url" type="url" value="{{ old('url', $item->url) }}" name="url" @if(old('relation_type', $item->relation_type) !== 'external_url') disabled @endif/>
                                            @error('url')
                                            <span id="url-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="class">CSS class</label>
                                            <input class="form-control @error('class') is-invalid @enderror" id="class" value="{{ old('class', $item->class) }}" name="class" />
                                            @error('class')
                                            <span id="class-error" class="error invalid-feedback">{{ $message }}</span>
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
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="is_active">Status</label>
                                            <select name="is_active" id="is_active"
                                                class="form-control @error('is_active') is-invalid @enderror">
                                                <option value="1" @if (old('is_active', $item->is_active) === '1') selected @endif>Active</option>
                                                <option value="0" @if (old('is_active', $item->is_active) === '0') selected @endif
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
                        <!-- Default box -->
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="target">Target</label>
                                            <select name="target" id="target" class="form-control @error('target') is-invalid @enderror">
                                                <option value="_self" @if (old('target', $item->target) === '_self') selected @endif>Self</option>
                                                <option value="_blank" @if (old('target', $item->target) === '_blank') selected @endif>Blank</option>
                                            </select>
                                            @error('target')
                                            <span id="target-error" class="error invalid-feedback">{{ $message }}</span>
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

@push('js-inline')
    <script>
        $(function() {
            $('select').selectInput().on('select2:select', function (e) {
                let name = $(e.target).attr('name');
                let value = $(e.target).val();
                switch (name) {
                    case 'relation_type':
                        let relation_object_element = $('select#relation_object');
                        let label_input = $('input#label');
                        let url_input = $('input#url');
                        if(value === 'home') {
                            url_input.attr('disabled', true).val('');
                            label_input.attr('disabled', true);
                            relation_object_element.attr('disabled', true);
                        } else if(value === 'page') {
                            label_input.val('');
                            url_input.val('').attr('disabled', true);
                            relation_object_element.removeAttr('disabled');
                        } else if(value === 'category') {
                            label_input.val('');
                            url_input.val('').attr('disabled', true);
                            relation_object_element.removeAttr('disabled');
                        } else if(value === 'external_url') {
                            label_input.val('').attr('disabled', true);
                            relation_object_element.attr('disabled', true);
                            url_input.val('').removeAttr('disabled');
                        }
                        relation_object_element.selectInput().val(null).trigger('change');
                        break;
                    default:
                        break;
                }
            });

        });

    </script>
@endpush
