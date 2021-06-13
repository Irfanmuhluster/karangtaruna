@extends('admin::layout')

@section('content')
    
    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="admin-agenda.html">Pengaturan Akses</a></li>
                    <li class="breadcrumb-item"><a href="admin-agenda.html">Peran</a></li>
                    <li class="breadcrumb-item">Edit Peran</li>
                </ol>
            </nav>
        </div>
    </div>

    
<div class="card">
    <div class="card-body">
        <div class="col-xl-6 col-md-8 col-sm-12">
            <form action="{{ route('admin.settingaccess.role.update', $role->id) }}" id="user-form" method="POST">
                @method('put')
                @csrf
                <div class="form-group ">
                    <label for="name"><strong>Nama Peran</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" placeholder="Nama" /> 
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection