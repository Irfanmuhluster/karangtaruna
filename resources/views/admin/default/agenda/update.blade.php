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
                <li class="breadcrumb-item"><a href="{{ route('admin.agenda.index') }}">Agenda</a></li>
                <li class="breadcrumb-item">Ubah Agenda</li>
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
            <form action="{{ route('admin.agenda.update', $agenda->id) }}" id="user-form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group ">
                    <label for="title"><strong>Judul Agenda</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $agenda->title) }}" placeholder="Judul Berita" /> 
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="agendatype" value="{{ request()->agendatype }}">
                @if (request()->agendatype == '0')
                <div class="form-group ">
                    <label for="title"><strong>Tanggal Pelaksanaan</strong> <span class="text-danger">*</span></label>
                    <div class="input-group"  data-target-input="nearest">
                        <input type="text" name="event_date" id="event_date" class="form-control datetimepicker-input @error('event_date') is-invalid @enderror" data-toggle="datetimepicker" data-target="#event_date" value="{{ old('event_date', showDateTime($agenda->event_date, 'd-m-Y')) }}"  placeholder="Tanggal Pelaksanaan"/>
                        <div class="input-group-append" data-target="#event_date" data-toggle="datetimepicker">
                            <div class="input-group-addon d-flex align-items-center justify-content-center border"><i class="far fa-clock"></i></div>
                        </div>
                        @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                </div>
                {{-- <div class="form-group ">
                    <label for="title"><strong>Waktu Pelaksanaan</strong> <span class="text-danger">*</span></label>
                    <div class="input-group"  data-target-input="nearest">
                        <input type="time"  name="event_time" id="event_time" class="form-control datetimepicker-input @error('event_time') is-invalid @enderror" value="{{ old('event_time') }}"  placeholder="Waktu Pelaksanaan"/>
                       
                        @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                </div> --}}
                @else
                <div class="form-group ">
                    <label for="every"><strong>Hari Pelaksanaan</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="every" id="title" class="form-control @error('every') is-invalid @enderror" value="{{ old('every', $agenda->every) }}" placeholder="Setiap" /> 
                    @error('every')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif

                <div class="form-group ">
                    <label for="content"><strong>Deskripsi Kegiatan</strong> <span class="text-danger">*</span></label>
                    <textarea name="content" id="message" class="form-control  texteditor  @error('content') is-invalid @enderror " rows=" 5 " placeholder="" style="visibility: hidden; display: none;"> {{ old('content', $agenda->content) }} </textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" >
                    <label for="message"><strong>Publish ?</strong> <span class="text-danger">*</span></label> <br>
                    <div class="icheck-primary">
                        <input type="hidden" name="publish" value="0" />
                        <input type="checkbox" name="publish" id="checkboxPrimary1" {{ ($agenda->publish == 1) ? 'checked=""' : '' }}  value="1">
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ theme_asset('backend::default', 'vendor/datetimepicker/moment.min.js') }}"></script>
    @include('backend::texteditor')
    <script type="text/javascript">    
		$(document).ready(function () {
			$('#event_date').datepicker({ dateFormat: 'dd-mm-yy' }).val();
        });
    </script>
@endpush
@endsection