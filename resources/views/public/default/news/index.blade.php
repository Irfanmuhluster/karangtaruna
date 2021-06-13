@extends('public::layout')

@section('title', "Berita")
@section('meta_description',  "Informasi Terkini " . $metawebsite->meta_value->title)
@section('meta_keywords',  "Informasi, Berita, Berita Terkini " . $metawebsite->meta_value->title)



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
                            @if(Route::is('public.news.category') )
                                <li class="breadcrumb-item" aria-current="page">
                                    <a class="text-primary text-decoration-none"
                                    href="{{ route('public.news') }}">Berita</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ Request::segment(2) }}</li>
                            @else
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                            @endif
                        </ol>
                    </nav>
                    <h1 class="font-weight-bold h3">{{ (Route::is('public.news.category')) ? 'Kategori '.Request::segment(2)  : 'Berita'}}</h1>

                </div>
            </div>
        </div>
    </div>

</section>
<section>
    <div class="container">
        <div class="row justify-content-md-center">

            @foreach ($datanews as $item)
                
            <div class="col-lg-3 col-md-10 col-sm-12">
            <div class="card border-1  mt-3 pb-5 pt-0">
                <img class="img card-img-top" style="height: 200px;"
                src="{{ $item->image  ? url("storage/news-{$item->image}") : '' }}" alt="{{ $item->title }}" srcset="">
                <div class="card-img-overlay" style="bottom: auto !important;">
                <a href="{{ route('public.news.category',['category' => $item->category->category_name, 'categoryid' => $item->category->id] ) }}"
                    class="btn btn-primary rounded rounded-2 text-white btn-sm">{{ $item->category->category_name }}</a>
                </div>
                <div class="card-body">
                <a class="text-decoration-none" href="{{ route('public.news.detail',$item->slug) }}">
                    <h5 class="my-4 fw-bolder text-decoration-none">{{ $item->title }}</h5>
                </a>
                <span class="badge rounded-pill bg-light fw-light text-muted">{{ $item->createdby->name }}</span>
                <span class="badge rounded-pill bg-light fw-light text-muted"> {{ showDateTime($item->created_at, 'l, d F Y @H:i') }}</span>
                <p class="my-3">
                    {{ Str::words(strip_tags($item->content), 10) }}
                </p>
                <a href="#"
                    class="btn p-2 btn-warning btn-primary rounded-2 position-absolute my-3 mx-3 bottom-0 end-0 text-white"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-right">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                    </svg></a>

                </div>
            </div>
            </div>
            
            @endforeach

        </div>
        <div class="d-flex justify-content-center my-4">
            {{  $datanews->links() }}
        </div>
    </div>
</section>
@endsection