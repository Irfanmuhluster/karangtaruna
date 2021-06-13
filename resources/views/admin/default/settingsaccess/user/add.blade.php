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
        <div class="col-xl-6 col-md-8 col-sm-12">
            <form action="{{ route('admin.settingaccess.user.store') }}" id="user-form" method="POST">
                @csrf
                <div class="form-group ">
                    <label for="name"><strong>Nama</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama" /> 
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="email"><strong>E-Mail</strong> <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" /> 
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="password"><strong>Kata Sandi</strong> <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" /> 
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="password_confirmation"><strong>Konfirmasi</strong> <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password') }}" placeholder="Ulangi password" /> 
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role"><strong>Peran</strong>  <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="form-control custom-select @error('role') is-invalid @enderror" /> 
                        <option value="" disabled>Pilih Peran</option>
                        @foreach ($roles as $roles)
                            <option {{ old('roles') == $roles  ? "selected" : "" }}  value="{{ $roles }}"> {{ ucfirst($roles) }}</option>
                        @endforeach 
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection

