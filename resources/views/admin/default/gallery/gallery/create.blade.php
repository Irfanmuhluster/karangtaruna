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
                    <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
                    <li class="breadcrumb-item">Tambah Galery</li>
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
            <form action="{{ route('admin.gallery.store') }}" id="user-form" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="position" value="{{ request()->position }}"> --}}
                <div class="form-group">
                    <label for="category"><strong>Kategori</strong>  <span class="text-danger">*</span></label>
                    <select name="category" id="category" class="form-control custom-select @error('category') is-invalid @enderror" /> 
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach ($getcategory as $category)
                            <option {{ (old('category') == $category->id || request()->cat == $category->id)  ? "selected" : "" }}  value="{{ $category->id }}"> {{ ucfirst($category->categoryname) }}</option>
                        @endforeach 
                    </select>
                </div>
                <div class="form-group" >
                    <label for="message"><strong>Gambar</strong> <span class="text-danger">*</span></label>
                    <div class="card-body">
                        <div class="file-uploader" id="file-uploader">
                            {{-- <img src="{{ $welcome->image  ? url("storage/media/{$welcome->image}") : url("images/logo-berita.png") }}" id="image-preview" class="img-fluid d-block mb-3" data-url="welcome_bbb7bff8-99c9-453e-bc42-7b61a4cebcd6.png" data-source="db"> --}}
                        </div>
                        <div id="preview-img">

                        </div>
                        <br>
                        <input type="file" name="image" id="exampleFormControlFile1" class="form-control  @error('image') is-invalid @enderror" value="">
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                         <input type="hidden" name="file_path" id="file_path" value="">
                    </div>
                </div>

                <div class="form-group ">
                    <label for="title"><strong>Caption</strong> <span class="text-danger">*</span></label>
                    <textarea type="text" name="caption" id="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption') }}" placeholder="Caption">{{ old('caption') }}</textarea>
                    {{-- <input type="text" name="caption" id="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption') }}" placeholder="Caption" />  --}}
                    @error('caption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Publish ?</strong> <span class="text-danger">*</span></label> <br>
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