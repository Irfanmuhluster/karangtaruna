@extends('admin::layout')

@section('content')
@push('css')
    
@endpush
    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="admin-agenda.html">Setting</a></li>
                    <li class="breadcrumb-item"><a href="admin-agenda.html">Email Template</a></li>
                    <li class="breadcrumb-item">Edit Email Template</li>
                </ol>
            </nav>
        </div>
    </div>

    
<div class="card">
    <div class="card-body">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <form action="#" id="user-form" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                    <label for="title"><strong>Subjek Email</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject', $dataemailtemplate->subject) }}" placeholder="Title" /> 
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="message"><strong>Dari Nama</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="from_name" id="from_name" class="form-control @error('from_name') is-invalid @enderror" value="{{ old('from_name', $dataemailtemplate->from_name) }}" placeholder="Dari Nama" /> 
                    @error('from_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="message"><strong>Email Dari</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="from_email" id="from_name" class="form-control @error('from_email') is-invalid @enderror" value="{{ old('from_email', $dataemailtemplate->from_email) }}" placeholder="Dari Nama" /> 
                    @error('from_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="message"><strong>Nama Email</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="template_name" id="template_name" class="form-control @error('template_name') is-invalid @enderror" value="{{ old('template_name', $dataemailtemplate->template_name) }}" placeholder="Nama Email" disabled /> 
                    @error('template_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="message"><strong>Konten</strong> <span class="text-danger">*</span></label>
                    <textarea name="content" id="message" class="form-control  texteditor  @error('content') is-invalid @enderror " rows=" 5 " placeholder="" style="visibility: hidden; display: none;"> {!! $dataemailtemplate->content !!} </textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script>

</script>
@push('js')
    @include('backend::texteditor')
@endpush
@endsection

