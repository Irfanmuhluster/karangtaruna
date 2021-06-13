@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin-agenda.html">Pengaturan Akses</a></li>
                <li class="breadcrumb-item">Pengguna</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Pengguna </h1>
            <a href="{{ route('admin.settingaccess.user.tambah') }}" class="btn ml-4 mt-1 mb-4 min-w-auto btn-success">
                <i class="fas fa-plus"></i> Tambah Pengguna
            </a>
        </div> 
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        
        <form id="search" action="{{ route('admin.settingaccess.user.index') }}" method="GET">
            <div class="input-group mb-3">
                    @foreach (request()->only(['role']) as $q_key => $q_val)
                    <input type="hidden" name="{{ $q_key }}" value="{{ $q_val }}">
                    @endforeach
                    <input type="text" class="form-control" name="search" placeholder="Cari Pengguna" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <button type="submit" class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></button>
                    </div>
            </div>
        </form>
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col"><span class="d-none d-md-block">Nama</span></th>
                    <th scope="col"><span class="d-none d-md-block">Email</span></th>
                    <th scope="col"><span class="d-none d-md-block">Peran</span></th>
                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datauser as $index => $user)
            
                <tr>
                    <td scope="row">
                        {{ $rank++ }}
                    </td>
                    <td>
                        {{ ucfirst($user->name) }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ ucfirst($user->getRoleNames()->first()) }}
                    </td>
                    <td>
                    <a href="{{ route('admin.settingaccess.user.edit',$user->id) }}" title="Ubah" class="btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.settingaccess.user.changepassword', $user->id) }}" title="Ubah Pasword" class="btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-key"></i>
                    </a>
                    <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{ $index }}" data-id="2">
                        <i class="fas fa-trash-alt"></i>
                    </div>

                    <div class="modal fade scale" id="deleteMenu-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Hapus User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">    
                                    <form id="role-menu-form-delete" action="{{ route('admin.settingaccess.user.delete', ['user' => $user->id]) }}" spellcheck="false"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus user ini ?</div>
                                        <div id="role-menu-form-delete-errors"></div>
                                        <button type="submit" class="btn btn-danger mb-2">Hapus</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center my-4">
                {{  $datauser->links() }}
        </div>
    </div>
</div>

<div class="modal fade scale" id="addAccess" tabindex="-1" role="dialog" aria-labelledby="addAccessTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" title="Close">×</button>
            <div class="modal-body">
                <h5 class="modal-title" id="addAccessTitle">Tambah Peran Baru</h5>
                <form spellcheck="false" action="http://demo.produk1.test/admin/permission/store" id="role-form">
                    <div class="form-group">
                        <label for="accessTitle"><strong>Nama Peran <span class="text-danger">*</span></strong></label>
                        <div class="form-group">
                            <input type="text" name="role_name" class="form-control">
                        </div>
                    </div>
                    <div id="role-form-errors"></div>
                    <button type="submit" class="btn btn-primary mb-2">Tambah Peran</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection