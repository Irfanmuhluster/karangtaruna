@extends('public::layout')

@section('title', "Agenda")
@section('meta_description',  "Agenda Terjadwal")

@section('content')

<section class="row py-5 bg-lightgreen">
    <div class="col-lg-9 col-md-12">
        <div class="row align-items-center justify-content-md-center">
            <div class="col-lg-9  ">
                <div class=" pr-md-5 mt-3 my-4">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb p-0 bg-transparent small d-print-none">
                            <li class="breadcrumb-item"><a class="text-primary text-decoration-none"
                                    href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Agenda</li>
                        </ol>
                    </nav>

                    <h1 class="font-weight-bold h3">Semua Agenda Terjadwal</h1>

                </div>
            </div>
        </div>
    </div>

</section>
<section>
    <div class="container my-1">
      <div class="row ">
        <div class="col-md-10 col-sm-12 p-3">
          <div class=" pt-3 px-3 pb-5">
            <div class="my-3">
                @foreach ($dataagenda as $item)
                    
              <div class="mb-4 p-3 border border-1 ronded rounded-3 bg-lightgreen">
                <div class="btn btn-primary fw-bolder text-white rounded-pill bg-success mb-3">{{ showDateTime($item->event_date, 'l, d F Y') }}</div>
                <p class="fw-bolder"> {{ $item->title }}</p>
                <p class="fs-7 text-muted">{!! $item->content !!} </p>
              </div>
              
              @endforeach

            </div>
            <div class="row justify-content-center my-4">
                {{  $dataagenda->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection