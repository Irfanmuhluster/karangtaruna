@extends('admin::layout')

@section('content')
@push('style')
<link rel="stylesheet" href="{{ theme_asset('backend::default', 'css/icheck-bootstrap.min.css') }}">
@endpush
    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Banner</a></li>
                    <li class="breadcrumb-item">Edit Banner</li>
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
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        <div class="col-xl-12 col-md-12 col-sm-12">
            <form action="{{ route('admin.banner.update', $banner->id) }}" id="user-form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="position" value="{{ request()->position }}">
                <div class="form-group ">
                    <label for="title"><strong>Judul Banner</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $banner->title) }}" placeholder="Judul Halaman" /> 
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="title"><strong>Sub Judul Banner</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $banner->subtitle) }}" placeholder="Judul Halaman" /> 
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="title"><strong>URL</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="urllink" id="urllink" class="form-control @error('urllink') is-invalid @enderror" value="{{ old('urllink', $banner->urllink) }}" placeholder="Judul Halaman" /> 
                    @error('urllink')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Gambar</strong> <span class="text-danger">*</span></label>
                    <div class="card-body">
                        <div class="file-uploader" id="file-uploader">
                            <img src="{{ $banner->images  ? url("storage/{$banner->images}") : url("images/logo-berita.png") }}" id="image-preview" class="img-fluid d-block mb-3" data-url="welcome_bbb7bff8-99c9-453e-bc42-7b61a4cebcd6.png" data-source="db">
                        </div>
                        <div id="preview-img">

                        </div>
                        <br>
                        <input type="file" name="image" id="exampleFormControlFile1" class="form-control  @error('images') is-invalid @enderror" value="">
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                         <input type="hidden" name="file_path" id="file_path" value="">
                    </div>
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Publish ?</strong> <span class="text-danger">*</span></label> <br>
                    <div class="icheck-primary">
                        <input type="hidden" name="publish" value="0" />
                        <input type="checkbox" name="publish" id="checkboxPrimary1" {{ ($banner->publish == 1) ? 'checked=""' : '' }} value="1">
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