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
                    <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">Halaman</a></li>
                    <li class="breadcrumb-item">Edit Halaman</li>
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
            <form action="{{ route('admin.page.update', $page->id) }}" id="user-form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group ">
                    <label for="title"><strong>Judul Halaman</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $page->title) }}" placeholder="Judul Halaman" /> 
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="content"><strong>Konten</strong> <span class="text-danger">*</span></label>
                    <textarea name="content" id="message" class="form-control  texteditor  @error('content') is-invalid @enderror " rows=" 5 " placeholder="" style="visibility: hidden; display: none;"> {{ old('content', $page->content) }} </textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $content }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Gambar</strong> <span class="text-danger">*</span></label>
                    <div class="card-body">
                        <div class="file-uploader" id="file-uploader">
                            <img src="{{ $page->image  ? url("storage/{$page->image}") : url("images/logo-berita.png") }}" id="image-preview" class="img-fluid d-block mb-3" data-url="welcome_bbb7bff8-99c9-453e-bc42-7b61a4cebcd6.png" data-source="db">
                        </div>

                        <br>
                        <input type="file" name="image" id="exampleFormControlFile1" class="form-control  @error('image') is-invalid @enderror" value="">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                         <input type="hidden" name="file_path" id="file_path" value="">
                    </div>
                </div>

                <div class="form-group ">
                    <label for="title"><strong>Keyword</strong> <span class="text-danger"></span></label>
                    <input type="text" name="keyword" id="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords', $page->tags) }}" placeholder="keyword 1, keyword 2, keyword 3" /> 
                    @error('keyword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Publish ?</strong> <span class="text-danger">*</span></label> <br>
                    <div class="icheck-primary">
                        <input type="hidden" name="publish" value="0" />
                        <input type="checkbox" name="publish" id="checkboxPrimary1" {{ ($page->publish == 1) ? 'checked=""' : '' }} value="{{ old('publish', $page->published) }}">
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