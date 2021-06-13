@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin.html">Pengaturan</a></li>
                <li class="breadcrumb-item">Manajemen Menu Publik</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Manajemen Menu Publik </h1>

        </div> 
        
            {{-- can --}}
 
        <div class="row">
            @foreach ($menus as $item)
            <a href="{{ route('admin.setting.menupublic.show', ['menu' => $item->id]) }}" class="btn btn-success mb-2 ml-2 {{ request()->input("menu") == $item->id ? "active" : "" }}">
                {{ $item->name }}
           </a>
            @endforeach
        </div>

        <div class="card">
        @if(request()->has('menu')  && !empty(request()->input("menu")))
            {{-- @dd(request()->route('id')) --}}
            {!! Menu::render() !!}
        @endif
        </div>
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif

    </div>
</div>
<style>
    ul li {
        list-style-type: none;
    }
    [data-toggle="collapse"], [data-toggle="modal"] {
        cursor: pointer;
    }
</style>
@endsection
@push('scripts')
    {!! Menu::scripts() !!}
@endpush