@extends('admin::layout')

@section('content')
    
    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.newscategory.index') }}">Kategori</a></li>
                    <li class="breadcrumb-item">Tambah Kategori</li>
                </ol>
            </nav>
        </div>
    </div>

    
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Tambah Kategori Galeri </h1>
        </div> 
        <div class="col-xl-10 col-md-10 col-sm-12">
            <form spellcheck="false" action="{{ route('admin.newscategory.store') }}" id="role-form"  method="POST">
                <div class="modal-body">
                    <div class="modal-body">
                        
                        @csrf
                        <input type="hidden" name="slug" value="">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            <div class="form-group ">
                                <label for="name"><strong>Kategori</strong> <span class="text-danger">*</span></label>
                                <input type="text" name="category_name" id="name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" placeholder="Nama Kategori" /> 
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <div class="form-group ">
                                <label for="description"><strong>Keterangan</strong></label>
                                <textarea name="description" id="description" class="form-control  texteditor  @error('description') is-invalid @enderror " rows=" 5 " placeholder="">  </textarea>
                                
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="role-form-errors"></div>
                            <button type="submit" class="btn btn-primary mb-2">Tambah Kategori</button>
                            {{-- <div id="role-form-errors"></div> --}}
                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection