@extends('public::layout')

@section('title', "Berita")
@section('meta_description',  \Str::limit(strip_tags($datapage->content), 100))

{{-- keyword --}}
@section('meta_keywords',  $datapage->title)
{{-- facebook --}}
@section('og_title', $datapage->title)
@section('og_description',  \Str::limit(strip_tags($datapage->content), 100))
@section('og_image', url("storage/{$datapage->image}") ?? null)

{{-- twitter --}}
@section('twitter_card', $datapage->title)
@section('twitter_title', $datapage->title)
@section('twitter_description', \Str::limit(strip_tags($datapage->content), 100))
@section('twitter_image', url("storage/{$datapage->image}") ?? null)


@section('content')

<section class="row py-5 bg-lightgreen">
    <div class="col-lg-9 col-md-12">
        <div class="row align-items-center justify-content-md-center">
            <div class="col-lg-9  ">
                <div class=" pr-md-5 mt-3 my-4">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb p-0 bg-transparent small d-print-none">
                            <li class="breadcrumb-item"><a class="text-primary text-decoration-none" href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a class="text-primary text-decoration-none" href="#">Halaman</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $datapage->title }}</li>
                        </ol>
                    </nav>
                    <h1 class="font-weight-bold h3">{{ $datapage->title }}</h1>
                    <span class="badge badge-pill bg-light border text-dark ">Oleh {{ $datapage->user->name }}</span>
                    <span class="badge badge-pill bg-light border text-dark ">{{ showDateTime($datapage->created_at, 'l, d F Y @H:i') }}</span>

                </div>
            </div>
        </div>
    </div>

</section>
<section>
    <div class="col-lg-9 col-md-12 my-5">
        <div class="row align-items-center justify-content-md-center">
            <div class="col-lg-9  ">
                <div class="mb-4">
                    <img src="{{ url("storage/{$datapage->image}") }}" alt="12 Peluang Bisnis Dunia Digital 2020 Apa Itu Peluang Bisnis di Dunia Digital ?" class="img-fluid  rounded-3  shadow-sm">
                
                </div>
                <div class="pr-md-5 mt-3 my-4">
                    <p>
                        {!! $datapage->content !!}    
                    </p>
                </div>
            </div>
        </div>
        
        <div class="title text-center text-primary"><h3>Bagikan</h3></div>
        <div class="d-flex justify-content-center">
            <div class="share mt-3 d-print-none">
                <a href="http://www.facebook.com/share.php?u={{ route('public.page.detail',$datapage->slug) }}" class="btn btn-link rounded-circle wh40 text-light" style="background: #4A90E2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                <a href="http://twitter.com/share?url={{ route('public.page.detail',$datapage->slug) }}" class="btn btn-link rounded-circle wh40 text-light" style="background: #3AAAF2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>

                <button onclick="window.print()" class="btn btn-link rounded-circle wh40 text-light" style="background: #ffc107"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></button>
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