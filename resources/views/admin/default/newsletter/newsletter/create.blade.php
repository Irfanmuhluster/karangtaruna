@extends('admin::layout')

@section('content')
@push('style')
<link rel="stylesheet" href="{{ theme_asset('backend::default', 'css/icheck-bootstrap.min.css') }}">
@endpush
<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.newsletter.index') }}">Newsletter</a></li>
                <li class="breadcrumb-item">Tambah Newsletter</li>
            </ol>
        </nav>
    </div>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    
<div class="card">
    <div class="card-body">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <form action="{{ route('admin.newsletter.store') }}" id="user-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                    <label for="title"><strong>Judul Newsletter</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Judul Newsletter" /> 
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="content"><strong>Isi Newsletter</strong> <span class="text-danger">*</span></label>
                    <textarea name="content" id="message" class="form-control  texteditor  @error('content') is-invalid @enderror " rows=" 5 " placeholder="" style="visibility: hidden; display: none;">  </textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="title"><strong>Nama Pengirim</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="from_name" id="from_name" class="form-control @error('from_name') is-invalid @enderror" value="{{ old('from_name') }}" placeholder="Nama Pengirim" /> 
                    @error('from_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="title"><strong>Email Pengirim</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="from_email" id="from_email" class="form-control @error('from_email') is-invalid @enderror" value="{{ old('from_email') }}" placeholder="Email Pengirim" /> 
                    @error('from_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="" class="text-secondary text-sm">Dikirim ke  {{ $member }} Anggota</label>
                </div>
                <div class="form-group"> 
                   
                    <label for="message"><strong>Kirim ?</strong> <span class="text-danger">*</span></label> <br>
                    <div class="icheck-primary">
                        <input type="hidden" name="publish" value="0" />
                        <input type="checkbox" name="publish" id="checkboxPrimary1" checked="" value="1">
                        <label for="checkboxPrimary1">
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@push('js')
    @include('backend::texteditor')
@endpush
@endsection