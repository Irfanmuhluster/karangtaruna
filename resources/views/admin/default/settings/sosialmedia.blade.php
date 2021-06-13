@extends('admin::layout')

@section('content')

    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Pengaturan Website</a></li>
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
            <form action="{{ route('admin.setting.sosial_media.update') }}" id="user-form" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group ">
                    <label for="message"><strong>Link Facebook</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="link_fb" id="title" class="form-control @error('link_fb') is-invalid @enderror" value="{{ old('link_fb', @$sosial_media->link_fb) }}" placeholder="Link Facebook" /> 
                    @error('link_facebook')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

                <div class="form-group ">
                    <label for="message"><strong>Link Twitter</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="link_twitter" id="title" class="form-control @error('link_twitter') is-invalid @enderror" value="{{ old('link_twitter', @$sosial_media->link_twitter) }}" placeholder="Link Twitter" /> 
                    @error('link_twitter')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group ">
                    <label for="message"><strong>Nomer Whatsapp</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="link_wa" id="title" class="form-control @error('link_wa') is-invalid @enderror" value="{{ old('link_wa', @$sosial_media->link_wa) }}" placeholder="Nomer Whatapps" /> 
                    @error('link_wa')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group ">
                    <label for="message"><strong>Link Youtube</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="link_yt" id="title" class="form-control @error('link_yt') is-invalid @enderror" value="{{ old('link_yt', @$sosial_media->link_yt) }}" placeholder="Link Youtube" /> 
                    @error('link_yt')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="message"><strong>Link Instagram</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="link_instagram" id="title" class="form-control @error('link_instagram') is-invalid @enderror" value="{{ old('link_instagram', @$sosial_media->link_instagram) }}" placeholder="Link Instagram" /> 
                    @error('link_instagram')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection

