@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Halaman</a></li>
                <li class="breadcrumb-item">Semua Halaman</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body p-3">
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100 py-3">
            <h1> Pengaturan Halaman Depan </h1>
        </div>
        <form action="{{ route('admin.setting.templateUpdate') }}" method="post"> 
            @csrf
            @method('PUT')

            @foreach ($config['fields'] as $key => $d)
            <div class="row">
                <div class="col-md-8">
                    @if ($d['type'] == 'select')
                        <div class="form-group">
                            <label for="{{ $key }}"><strong>{{ $d['label']  }}</strong>  </label>
                            <select name="{{ $key }}" id="{{ $key }}" class="form-control custom-select ">
                                @foreach ($d['options'] as $item_key => $item)
                               
                                    <option value="{{ $item_key }}" {{ $item_key == theme_field_value($key) ? 'selected' : ' ' }}> {{ $item }} </option>
                                     
                                @endforeach
                            </select>
                            <small class="form-text text-muted"></small>
                            
                        </div>
                    @endif
                </div>
            </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
<script>

</script>
@endsection