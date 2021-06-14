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
                    <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Berita</a></li>
                    <li class="breadcrumb-item">Edit Berita</li>
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
            <form action="{{ route('admin.news.update', $news->id) }}" id="user-form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group ">
                    <label for="title"><strong>Judul Berita</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $news->title) }}" placeholder="Judul Berita" /> 
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category"><strong>Kategori</strong>  <span class="text-danger">*</span></label>
                    <select name="category" id="category" class="form-control custom-select @error('category') is-invalid @enderror" /> 
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach ($getcategory as $category)
                            <option {{ old('category', $news->category_id) == $category->id  ? "selected" : "" }}  value="{{ $category->id }}"> {{ ucfirst($category->category_name) }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="form-group ">
                    <label for="content"><strong>Isi Berita</strong> <span class="text-danger">*</span></label>
                    <textarea name="content" id="message" class="form-control  texteditor  @error('content') is-invalid @enderror " rows=" 5 " placeholder="" style="visibility: hidden; display: none;">{{ old('content', $news->content) }}  </textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Gambar</strong> <span class="text-danger">*</span></label>
                    <div class="card-body">
                        <div class="file-uploader" id="file-uploader">
                                <img src="{{ $news->image  ? url("storage/news-{$news->image}") : '' }}" id="image-preview" class="img-fluid d-block mb-3" data-url="{{ old('image', $news->image) }}" data-source="db">
                        </div>
                        <div id="preview-img">

                        </div>
                        <br>
                        <input type="file" name="image" id="image" class="form-control  @error('image') is-invalid @enderror" value="">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                         <input type="hidden" name="file_path" id="file_path" value="">
                    </div>
                </div>

                <div class="form-group ">
                    <label for="title"><strong>Keyword</strong> <span class="text-danger"></span></label>
                    <input type="text" name="keywords" id="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords', $news->tags) }}" placeholder="keyord 1, keyword 2 " /> 
                    @error('keyword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Publish ?</strong> <span class="text-danger">*</span></label> <br>
                    <div class="icheck-primary">
                        <input type="hidden" name="publish" value="0" />
                        <input type="checkbox" name="publish" id="checkboxPrimary1" {{ ($news->publish == 1) ? 'checked=""' : '' }} value="{{ old('publish', $news->publish) }}">
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