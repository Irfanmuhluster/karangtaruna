@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin-agenda.html">Pengaturan Akses</a></li>
                <li class="breadcrumb-item">Peran</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Peran </h1>

            {{-- can --}}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fas fa-plus"></i> Tambah Peran
            </button>
        </div> 
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        
        <form id="search" action="{{ route('admin.settingaccess.role.index') }}" method="GET">
            <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari Peran" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></button>
                    </div>
            </div>
        </form>
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col"><span class="d-none d-md-block">Peran</span></th>
                    <th scope="col"><span class="d-none d-md-block">Tanggal dibuat</span></th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $index => $role)
                <tr>
                    <td scope="row">
                        {{ $rank++ }}
                    </td>
                    <td>
                        {{ $role->name }}
                    </td>
                    <td>
                        {{ showDateTime($role->created_at) }}
                    </td>
                    <td>
                        <a href="{{ route('admin.settingaccess.role.edit', $role->id) }}" title="Ubah" class="btn btn-sm btn-primary pull-right edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{ $index }}" data-id="2">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                        <div class="modal fade scale" id="deleteMenu-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Hapus Peran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">    
                                        <form id="role-menu-form-delete" action="{{ route('admin.settingaccess.role.delete', ['role' => $role->id]) }}" spellcheck="false"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus peran ini ?</div>
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
            {{  $roles->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Peran Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form spellcheck="false" action="{{ route('admin.settingaccess.role.store') }}" id="role-form"  method="POST">
            <div class="modal-body">
                <div class="modal-body">
                    
                        @csrf
                        <div class="form-group">
                            <label for="accessTitle"><strong>Nama Peran <span class="text-danger">*</span></strong></label>
                            <div class="form-group">
                                <input type="text" name="role_name" class="form-control @error('role_name') is-invalid @enderror" value="{{ old('role_name') }}">
                                @error('role_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
<style>

</style>
<script>
        $(function () {
            @error('form_active')
               @if($message == 'store')
               	 $('#modal-default').modal('show')
               @else
                 $('#updateNew').modal('show')
               @endif
            @enderror
        });
</script>
@endsection