@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin-agenda.html">Pengaturan Akses</a></li>
                <li class="breadcrumb-item">Hak Akses</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Atur Hak Akses ke Peran </h1>

            {{-- can --}}
            {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fas fa-plus"></i> Tambah Peran
            </button> --}}
        </div> 
        @if (session('success'))
            <x-alert type="success" /> 
        @endif
        <form action="#" method="GET">
            <div class="form-group mt-2">
                <ul class="nav">
                    <li>
                        <h4 data-toggle="tab">Peran</h4>
                    </li>
                </ul>
                <div class="input-group">
                    <select id="role-selectRole" name="role" class="form-control">
                        <option value="" >--Pilih Peran--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ ($getrole == $role) ? 'selected' : '' }} {{ $getrole }}>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                    @if (!empty($getrole))
                        @if(\Auth::user()->can('edit_menu_admin'))
                            <a  href="{{ route('admin.setting.menu.index', $getRole->id) }}" class="btn btn-success ml-2">Manage Menu</a>
                        @endif
                    @endif
                </div>
            </div>
        </form>
        

        <form action="{{ route('users.setRolePermission', request()->get('role') ?? ''  ) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li>
                            <h4 data-toggle="tab">Hak Akses</h4>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <ul class="permissions checkbox mt-4">
                            @foreach($permission as $table => $permission)
                                <li>
                                    <input type="checkbox" id="" class="permission-group">
                                    <label for=""><strong>{{ ucfirst($table) }}</strong></label>
                                    <ul>
                                        @foreach ($permission as $item)
                                            <li>
                                                {{-- key {{ $perm->key }} --}}
                                                <div class="tab-pane active" id="tab_1">
                                                    <input type="checkbox" name="permission[]" class="the-permission minimal-red" value="{{ $item->name }}" {{ in_array($item->name, $hasPermission) ? 'checked':'' }}> <label for="permission-">{{ Str::title(str_replace('_', ' ', $item->name)) }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="pull-right">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-send"></i> Set Permission
                </button>
            </div>
        </form>
    </div>
</div>
<style>
    ul li {
        list-style-type: none;
    }
</style>

@endsection