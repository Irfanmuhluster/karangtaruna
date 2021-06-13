@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin.html">Pengaturan</a></li>
                <li class="breadcrumb-item">Manajemen Menu</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Manajemen Menu </h1>

            {{-- can --}}
            <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#modal-default">
                <i class="fas fa-plus"></i> Tambah Menu
            </button>
        </div> 
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        {{-- @foreach ($menus as $item) --}}
        @foreach ($menus as $mk => $menu)

        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="{{ $menu->icon_class }} font-md"></i>
                        <span class="ml-2">{{ $menu->title }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <form class="form-row" method="post" action="{{ route('admin.setting.menu.orderupdate') }}" enctype="multipart/form-data" name="update">
                            @csrf
                            <input type="hidden" name="parent_id" value="">
                            <button type="submit" name="user_menu_orderby[up]" value="{{ $menu->id }}" class="role-menu-order-btn border rounded px-2 py-1 ml-1">
                                <i class="fas fa-arrow-up"></i>
                            </button>
                            <button type="submit" name="user_menu_orderby[down]" value="{{ $menu->id }}" class="role-menu-order-btn border rounded px-2 py-1 ml-1 mr-1">
                                <i class="fas fa-arrow-down"></i>
                            </button>
                        </form>
                        <a data-icon="{{ $menu->icon_class }}" data-route-edit="{{ route('admin.setting.menu.update', $menu->id) }}" data-routeindex="{{ $menu->url }}"  data-label="{{ $menu->title }}" data-key="{{ $mk }}" id="menu-edit-btn" class="role-menu-edit-btn border rounded px-2 py-1 ml-1 text-black" data-toggle="modal" data-target="#editMenu">
                            <i class="far fa-edit"></i>
                        </a>
                        <a data-key="{{ $mk }}" class="role-menu-delete-btn border rounded px-2 py-1 ml-1 text-black" data-toggle="modal" data-target="#deleteMenu-{{ $mk }}">
                            <i class="far fa-trash-alt"></i>
                        </a>
                        <div class="modal fade scale" id="deleteMenu-{{ $mk }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Hapus Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">    
                                        <form id="role-menu-form-delete" action="{{ route('admin.setting.menu.destroy', ['menuadmin' => $menu->id]) }}" spellcheck="false"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus menu ini ?</div>
                                            <div id="role-menu-form-delete-errors"></div>
                                            <button type="submit" class="btn btn-danger mb-2">Hapus</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach ($menu->children as $ck => $child)  
                <li class="d-flex align-items-center justify-content-between border rounded p-3 my-3">
                    <div class="d-flex align-items-center">
                        {{ $child->title }}
                        {{-- <span class="font-sm opacity-5 ml-2"><i>backend.news.base.index</i></span> --}}
                    </div>
                    <div class="d-flex align-items-center">
                        <form class="form-row" method="post" action="{{ route('admin.setting.menu.orderupdate') }}" enctype="multipart/form-data" name="update">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $child->parent_id }}">
                            <button type="submit" name="user_menu_orderby[up]" value="{{ $child->id }}" class="role-menu-order-btn border rounded px-2 py-1 ml-1">
                                <i class="fas fa-arrow-up"></i>
                            </button>
                            <button type="submit" name="user_menu_orderby[down]" value="{{ $child->id }}" class="role-menu-order-btn border rounded px-2 py-1 ml-1 mr-1">
                                <i class="fas fa-arrow-down"></i>
                            </button>
                        </form>
                        <a data-icon="{{ $child->icon_class }}" data-route-edit="{{ route('admin.setting.menu.update', $child->id) }}" data-routeindex="{{ $child->url }}"  data-label="{{ $child->title }}" data-key="{{ $ck }}" id="menu-edit-btn" class="role-menu-edit-btn border rounded px-2 py-1 ml-1" data-toggle="modal" data-target="#editMenu">
                            <i class="far fa-edit"></i>
                        </a>
                        <a data-key="2.0" class="role-menu-delete-btn border rounded px-2 py-1 ml-1" data-toggle="modal" data-target="#deleteMenu-{{ $mk }}-{{ $ck }}">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                    <div class="modal fade scale" id="deleteMenu-{{ $mk }}-{{ $ck }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Hapus Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">    
                                    <form id="role-menu-form-delete" action="{{ route('admin.setting.menu.destroy', ["menuadmin" => $child->id]) }}" spellcheck="false"  method="POST">
                                        
                                        @csrf
                                        @method('delete')
                                        <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus menu ini ?</div>
                                        <div id="role-menu-form-delete-errors"></div>
                                        <button type="submit" class="btn btn-danger mb-2">Hapus</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </div>
        </div> 
        @endforeach
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form spellcheck="false" action="{{ route('admin.setting.menu.store') }}" id="role-form"  method="POST">
            <div class="modal-body">
                <div class="modal-body">                   
                        @csrf
                        <div class="form-group">
                            <label for="accessTitle"><strong>Menu Utama</strong></label>
                            {{-- @dd(request()->route()) --}}
                            <input type="hidden" name="role_id" value="{{ request()->route('menuadmin') }}">
                            <div class="form-group">
                                <select name="parent_id" id="parent_id" class="form-control custom-select @error('role') is-invalid @enderror" /> 
                                    <option value="" selected>Menu Utama</option>
                                    @foreach ($menus as $item)
                                        <option value="{{ $item->id }}" >{{ $item->title }}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>Nama Menu</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Nama menu" /> 
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>URL/Route</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" placeholder="Url/route" /> 
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>Icon</strong></label>
                            <input type="text" name="icon_class" id="url" class="form-control @error('icon_class') is-invalid @enderror" value="{{ old('icon_class') }}" placeholder="Icon" /> 
                            <small class="form-text text-muted">Klik <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">DISINI</a> untuk melihat daftar Icon</small>
                            @error('icon_class')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div id="role-form-errors"></div> --}}
                
                </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal fade scale"  id="editMenu" tabindex="-1" role="dialog" aria-labelledby="editMenuTitle" aria-hidden="true">
   
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form id="menu-form-edit" action="" spellcheck="false" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body"> 
                            <div class="form-group">
                                <label for="menuLabelId"><strong>Nama Menu<span class="text-danger">*</span></strong></label>
                                <input type="text" name="menu_label" class="form-control @error('menu_label') is-invalid @enderror" value="{{ old('menu_label') }}">
                                @error('menu_label')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="menuIcon"><strong>Icon</strong></label>
                                <input type="text" name="menu_icon" class="form-control" value="{{ old('menu_icon') }}">
                                @error('menu_icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="menuRoute"><strong>URL/Route <span class="text-danger">*</span></strong></label>
                                <input type="text" name="menu_route_index" class="form-control @error('menu_route_index') is-invalid @enderror" value="{{ old('menu_route_index') }}">
                                @error('menu_route_index')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    <div id="role-menu-form-edit-errors"></div>
                    <button type="submit" class="btn btn-primary mb-2 ml-4">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    ul li {
        list-style-type: none;
    }
    [data-toggle="collapse"], [data-toggle="modal"] {
        cursor: pointer;
    }
</style>
<script>
        $(function () {
            @error('form_active')
               @if($message == 'store')
               	 $('#modal-default').modal('show')
               @endif
            @enderror

            @if ($errors->has('menu_label') || $errors->has('menu_route_index'))
                $('#editMenu').modal('show')
            @endif
        });
</script>
@endsection