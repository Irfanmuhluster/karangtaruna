@extends('admin::layout')

@section('content')
@push('css')
    
@endpush
    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="admin-agenda.html">Pengaturan Website</a></li>
                    <li class="breadcrumb-item">Pesan Selamat Datang</li>
                </ol>
            </nav>
        </div>
    </div>

    
<div class="card">
    <div class="card-body">
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        <div class="col-xl-12 col-md-12 col-sm-12">
            <form action="{{ route('admin.setting.welcome.store') }}" id="user-form" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                    <label for="title"><strong>Judul</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', @$welcome->title) }}" placeholder="Title" /> 
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="message"><strong>Pesan</strong> <span class="text-danger">*</span></label>
                    <textarea name="message" id="message" class="form-control  texteditor  @error('message') is-invalid @enderror " rows=" 5 " placeholder="" style="visibility: hidden; display: none;"> {!! @$welcome->message !!} </textarea>
                    @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Gambar</strong> <span class="text-danger">*</span></label>
                    <div class="card-body">
                        <div class="file-uploader" id="file-uploader">
                            <img src="{{ !empty($welcome->image)  ? url("storage/{$welcome->image}") : url("images/logo-berita.png") }}" id="image-preview" class="img-fluid d-block mb-3" data-url="welcome_bbb7bff8-99c9-453e-bc42-7b61a4cebcd6.png" data-source="db">
                        </div>
                        <div id="preview-img">

                        </div>
                        <br>
                        <input type="file" name="image" id="exampleFormControlFile1" class="form-control  @error('image') is-invalid @enderror" value="">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Gambar hanya tampil di tema yang memiliki fitur menampilkan gambar Welcome Message</small>
                        <input type="hidden" name="file_path" id="file_path" value="">
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

