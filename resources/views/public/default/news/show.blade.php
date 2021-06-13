@extends('public::layout')

@section('title', "Berita")
@section('description',  \Str::limit(strip_tags($detnews->content), 100))

{{-- keyword --}}
@section('meta_keywords',  "Informasi, Berita, Berita Terkini ". $metawebsite->meta_value->title)
{{-- facebook --}}
@section('og_title', $detnews->title)
@section('og_description',  \Str::limit(strip_tags($detnews->content), 100))
@section('og_image', url("storage/news-{$detnews->image}") ?? null)

{{-- twitter --}}
@section('twitter_card', $detnews->title)
@section('twitter_title', $detnews->title)
@section('twitter_description', \Str::limit(strip_tags($detnews->content), 100))
@section('twitter_image',  url("storage/news-{$detnews->image}") ?? null)

@section('content')

<section class="row py-5 bg-lightgreen">
    <div class="col-lg-9 col-md-12">
        <div class="row align-items-center justify-content-md-center">
            <div class="col-lg-9  ">
                <div class=" pr-md-5 mt-3 my-4">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb p-0 bg-transparent small d-print-none">
                            <li class="breadcrumb-item"><a class="text-primary text-decoration-none" href="#">Beranda</a></li>
                            <li class="breadcrumb-item"><a class="text-primary text-decoration-none" href="{{ route('public.news') }}">Artikel</a></li>
                            <li class="breadcrumb-item"><a class="text-primary text-decoration-none" href="#">{{ $detnews->category->category_name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Artikel</li>
                        </ol>
                    </nav>
                    <div class="btn btn-sm btn-light border shadow-sm my-4 rounded-3 ">{{ $detnews->category->category_name }}</div>
                    <h1 id="section-to-print-judul" class="font-weight-bold h3">{{ $detnews->title }}</h1>
                    <span class="badge badge-pill bg-light border text-dark ">Oleh {{ $detnews->createdby->name }}</span>
                    <span class="badge badge-pill bg-light border text-dark ">{{ showDateTime($detnews->created_at, 'l, d F Y @H:i') }}</span>

                </div>
            </div>
        </div>
    </div>

</section>
<section>
    <div class="col-lg-9 col-md-12 my-5">
        <div id="section-to-print" class="row align-items-center justify-content-md-center">
            <div class="col-lg-9  ">
                <article>
                <div class="mb-4">
                    <img src="{{ $detnews->image  ? url("storage/news-{$detnews->image}") : '' }}" alt="{{ $detnews->title }}" class="img-fluid  rounded-3  shadow-sm">
                
                </div>
                <div class="pr-md-5 mt-3 my-4">
                    <p>
                        {!! $detnews->content !!}
                    </p>
                </div>
                </article>
            </div>
        </div>
        
        <div class="title text-center text-primary"><h3>Bagikan</h3></div>
        <div class="d-flex justify-content-center">
            <div class="share mt-3 d-print-none">
                <a href="http://www.facebook.com/share.php?u={{ route('public.news.detail',$detnews->slug) }}" class="btn btn-link rounded-circle wh40 text-light" style="background: #4A90E2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                <a href="http://twitter.com/share?url={{ route('public.news.detail',$detnews->slug) }}" class="btn btn-link rounded-circle wh40 text-light" style="background: #3AAAF2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>

                <button onclick="window.print()" class="btn btn-link rounded-circle wh40 text-light" style="background: #ffc107"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></button>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container my-5">
        <div class="col-lg-10">   
            <div class="row">     
                <div class="section-title  py-3">
                    <div class="title fw-bolder text-primary"><h1>Berita Terkait</h1> </div>
                </div>
                @foreach ($artikelterkait as $item)

                    <div class="col-lg-4 col-md-10 col-sm-12">
                        <div class="card shadow border-0  mt-3 pb-5 pt-0">
                            <img class="img card-img-top" style="height: 200px;" src="{{ url("storage/news-{$item->image}") }}" alt="gambar" srcset="">
                            <div class="card-img-overlay" style="bottom: auto !important;">
                                <a href="https://blog.idcodewebs.com/category/php/"  class="btn btn-primary rounded rounded-2 text-white btn-sm">{{ $item->category->category_name }}</a>
                            </div>
                            <div class="card-body">
                            <a class="text-decoration-none" href="{{ route('public.news.detail',$item->slug) }}">
                                <h5 class="my-4 fw-bolder text-decoration-none">{{ $item->title }}</h5>
                            </a>
                            <span class="badge rounded-pill bg-light fw-light text-muted">{{ $item->createdby->name }}</span>
                            <span class="badge rounded-pill bg-light fw-light text-muted">{{ showDateTime($item->created_at, 'l, d F Y @H:i') }}</span>

                            <a href="{{ route('public.news.detail',$item->slug) }}" class="btn p-2 btn-warning btn-primary rounded-2 position-absolute my-3 mx-3 bottom-0 end-0 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                            
                            </div>
                        </div>
                    </div>
                                    
                @endforeach
            </div>
        </div>
    </div>
</section>
<style>
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print-judul {
    padding-left: 1rem;
    visibility: visible;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
/* #section-to-print-title{
    visibility: hidden;
} */
</style>
@endsection