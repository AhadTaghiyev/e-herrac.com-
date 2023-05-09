<ol class="dd-list">
    @foreach ($items as $item)
        <li class="dd-item" data-id="{{ $item->id }}">
            <div class="dd-handle">
                <span class="drag-indicator"></span>
                <span>{{ $item->label }}</span>
                {{-- <div class="dd-nodrag btn-group ml-auto">
                  <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                </div> --}}
              </div>
            @if(!$item->childs->isEmpty())
                @include('admin.menu.treeView', ['items' => $item->childs])
            @endif
        </li>
    @endforeach
    </ol>
