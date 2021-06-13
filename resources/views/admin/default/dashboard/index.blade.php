@extends('admin::layout')

@section('content')

<div class="row my-1 min-h-title">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-6">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1>Welcome !</h1>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <p>Selamat Datang Kembali <strong>{{ config('username') }}</strong>, Anda Login Sebagai <strong>{{ Auth::user()->roles->pluck('name')[0] }} </strong></p>
        <p>Visit your site here <a class="btn btn-primary ml-1 visit-site" href="{{ url('/') }}" target="_blank">Visit Site</a></p>
    </div>
</div>

@endsection