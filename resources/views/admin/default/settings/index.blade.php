@extends('admin::layout')

@section('content')
@push('css')
    
@endpush
    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Pengaturan Umum</li>
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
            <form action="{{ route('admin.setting.update') }}" id="user-form" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- 'title' => 'Title Website',
                'name' => 'Nama Website',
                'email' => 'website@domain.com',
                'url' => 'https://website.com',
                'favicon' => '',
                'logo' => '' ,
                'footer' => 'Copyright © 2020' ,
                'keyword_meta_search' => '' ,
                'keyword_description' => '', --}}
                @csrf
                <div class="form-group ">
                    <label for="title"><strong>Judul Situs</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', @$setting->title) }}" placeholder="Title" /> 
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="email"><strong>Deskripsi Situs</strong> </label>
                    <textarea name="tagline" id="tagline" class="form-control  texteditor  @error('message') is-invalid @enderror " cols="30" rows="10">{!! @$setting->tagline !!} 
                    </textarea>
                    @error('tagline')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="email"><strong>Email</strong> </label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', @$setting->email) }}" placeholder="Email" /> 
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group ">
                    <label for="phone"><strong>No Telp</strong> </label>
                    <input type="phone" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', @$setting->phone) }}" placeholder="Notelp" /> 
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="address"><strong>Alamat</strong> </label>
                    <input type="address" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', @$setting->address) }}" placeholder="Alamat" /> 
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="footer"><strong>Footer</strong> </label>
                    <input type="footer" name="footer" id="footer" class="form-control @error('footer') is-invalid @enderror" value="{{ old('footer', @$setting->footer) }}" placeholder="Footer" /> 
                    @error('footer')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="keyword_meta_search"><strong>Keyword Meta Search</strong> </label>
                    <textarea name="keyword_meta_search" id="keyword_meta_search" class="form-control  texteditor  @error('keyword_meta_search') is-invalid @enderror " cols="30" rows="10">{!! old('keyword_meta_search',@$setting->keyword_meta_search) !!} </textarea>
                    @error('keyword_meta_search')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="keyword_meta_description"><strong>Keyword Meta Description</strong> </label>
                    <textarea name="keyword_meta_description" id="keyword_meta_description" class="form-control  texteditor  @error('keyword_meta_description') is-invalid @enderror " cols="30" rows="10">{!! old('keyword_meta_description',@$setting->keyword_meta_description) !!} </textarea>
                    @error('keyword_meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="favicon"><strong>Favicon</strong> </label>
                    <div class="card-body">
                        <div class="file-uploader" id="file-uploader">
                            <img src="{{ $setting->favicon  ? url("storage/{$setting->favicon}") : "" }}" id="image-preview" class="img-fluid d-block mb-3" data-url="{{ $setting->favicon }}" data-source="db">
                        </div>
                        <div id="preview-img">

                        </div>
                        <br>
                        <input type="file" name="favicon" id="exampleFormControlFile1" class="form-control  @error('favicon') is-invalid @enderror" value="">
                        @error('favicon')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="file_path" id="file_path" value="">
                    </div>
                </div>

                <div class="form-group" >
                    <label for="logo"><strong>Logo</strong></label>
                    <div class="card-body">
                        <div class="file-uploader" id="file-uploader">
                            <img src="{{ $setting->logo  ? url("storage/{$setting->logo}") : "" }}" id="image-preview" class="img-fluid d-block mb-3" data-url="welcome_bbb7bff8-99c9-453e-bc42-7b61a4cebcd6.png" data-source="db">
                        </div>
                        <div id="preview-img">

                        </div>
                        <br>
                        <input type="file" name="logo" id="exampleFormControlFile1" class="form-control  @error('logo') is-invalid @enderror" value="">
                        @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="file_path" id="file_path" value="">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script>
const fileSelect = document.getElementById("exampleFormControlFile1");
const fileList = document.getElementById("preview-img");

fileSelect.addEventListener("change", handleFiles);

function handleFiles() {
if (!this.files.length) {
     fileList.innerHTML = "<p>No files selected!</p>";
} else {
     fileList.innerHTML = "";
     const list = document.createElement("ul");
     list.style.listStyle = "none";
     fileList.appendChild(list);
     for (let i = 0; i < this.files.length; i++) {
          const li = document.createElement("li");
          list.appendChild(li);
                        
          const img = document.createElement("img");
          img.classList.add("img-thumbnail");
          img.src = URL.createObjectURL(this.files[i]);
          img.width = 600;
          img.onload = function() {
          URL.revokeObjectURL(this.src);
     }
     li.appendChild(img);                      
    }
  }
}
</script>
@push('js')
    @include('backend::texteditor')
@endpush
@endsection

