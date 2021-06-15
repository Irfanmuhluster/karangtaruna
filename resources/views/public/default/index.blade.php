@extends('public::layout')

@section('title', $metawebsite->meta_value->title)
@section('description',  \Str::limit(strip_tags($metawebsite->meta_value->keyword_meta_description), 100))
@section('meta_keywords',  $metawebsite->meta_value->keyword_meta_search)
{{-- facebook --}}
@section('og_title', $metawebsite->meta_value->title)
@section('og_description',  \Str::limit(strip_tags($metawebsite->meta_value->keyword_meta_description), 100))
@section('og_image', url("storage/{$metawebsite->meta_value->logo}") ?? null)
@section('og_url', url("/"))

{{-- twitter --}}
@section('twitter_card', $metawebsite->meta_value->title)
@section('twitter_title', $metawebsite->meta_value->title)
@section('twitter_description', \Str::limit(strip_tags($metawebsite->meta_value->keyword_meta_description), 100))
@section('twitter_image',  url("storage/{$metawebsite->meta_value->logo}") ?? null)
@section('twitter_site', url("/"))

@section('content')
<div id="carouselExampleDark" class="carousel carousel slide overflow-hidden" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($banner as $index => $item)
        <div class="carousel-item {{ ($index==0) ? 'active' : ''}}" data-bs-interval="{{ ($index==0) ? '2000' : '3000'}}">
            <img src="{{ url("storage/{$item->images}")  }}" class="img d-block w-100" alt="{{ $item->title }}" style="height: 500px;">
            <div class="position-absolute text-white bottom-0 d-none d-md-block bg-slider w-100 p-3">
                <h5><a href="{{ url($item->urllink) }}" class="text-decoration-none text-white">{{ $item->title }}</a></h5>
                <p>{{ $item->subtitle }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>
<section>
    <div class="container my-5">
        <div class="row">
          <div class="col-md-6 col-sm-12 p-5">
            <img src="{{ !empty($welcome_message->image)  ? url("storage/{$welcome_message->image}") : url("themes/frontend/default/img/welcome-image.jpg") }}" class="img rounded-3 mx-auto d-block" alt="Responsive Web Design">
          </div>
          <div class="col-md-6 col-sm-12 p-5">
                <div class="text-primary"><h1>{{ $welcome_message->title }}</h1></div>
                <p class="my-2 my-lg-5 text-dark lh-28">
                 {!! $welcome_message->message !!}
                </p>
          </div>
        </div>
      </div>
</section>
<section>
    <div class="container my-5">
        <div class="row">
                <div class="heading-space-between">
                    <div class="section-title  py-3">
                        <div class="title fw-bolder text-primary"><h1>Berita</h1> </div>
                    </div>
                    <a class="d-flex btn-small text-white my-4" href="#">
                        <span class="display-flex-center">Lihat Semua 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" right="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="row justify-content-md-center">

                    @foreach ($news as $item)
           
                    <div class="col-lg-4 col-md-10 col-sm-12">
                        <div class="card shadow border-0  mt-3 pb-5 pt-0">
                            <img class="img card-img-top" style="height: 200px;" src="{{ url("storage/news-{$item->image}")  }}" alt="gambar" srcset="">
                            <div class="card-img-overlay" style="bottom: auto !important;">
                                <a href="#"  class="btn btn-primary rounded rounded-2 text-white btn-sm">{{ $item->category->category_name }}</a>
                            </div>
                            <div class="card-body">
                            <a class="text-decoration-none" href="{{ route('public.news.detail',$item->slug) }}">
                                <h5 class="my-4 fw-bolder text-decoration-none">{{ $item->title }}</h5>
                            </a>
                            <span class="badge rounded-pill bg-light fw-light text-muted"> {{ $item->createdby->name }}</span>
                            <span class="badge rounded-pill bg-light fw-light text-muted"> {{ showDateTime($item->created_at, 'l, d F Y @H:i') }}</span>
                            <p class="my-3">
                                {{ Str::words(strip_tags($item->content), 10) }}
                            </p>
                            <a href="{{ route('public.news.detail',$item->slug) }}" class="btn p-2 btn-warning btn-primary rounded-2 position-absolute my-3 mx-3 bottom-0 end-0 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a> 
                            </div>
                        </div>
                    </div>
                                 
                    @endforeach

                </div>
        </div>
    </div>
</section>
<section>
    <div class="container my-5">
        <div class="row">
            <div class="section-title  py-3">
                <div class="title fw-bolder text-primary"><h1>Agenda</h1> </div>
            </div>
            <div class="col-md-6 col-sm-12 p-3">
                <div class="card pt-3 px-3 pb-5 shadow">
                <div class="section-title  py-3">
                    <div class="text-center text-primary"><h3>Agenda Bulan Ini</h3> </div>
                </div>
                    <div class="my-3">
                        @foreach ($agenda as $item)
                            
                        <div class="m-2 p-3 border border-1 ronded rounded-3 bg-lightgreen">
                            <span class="badge rounded-pill bg-success mb-3">{{ showDateTime($item->event_date, 'l, d F Y') }}</span>
                            <p class="fw-bolder"> {{ $item->title }} </p>
                            <p class="fs-7 text-muted"> {!! $item->content !!}</p>
                        </div>
                        
                        @endforeach
                      
                    </div>
                    <a href="{{ route('public.agenda') }}" class="btn p-2 btn-warning btn-primary rounded-2 position-absolute my-3 mx-3 bottom-0 end-0 text-white">
                        Lihat Semua Agenda
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                     </a>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 p-3">
              <div class="card pt-3 px-3 pb-5 shadow">
                <div class="section-title  py-3">
                    <div class="text-center text-primary"><h3>Agenda Rutin</h3> </div>
                </div>
                    <div class="my-3">
                        @foreach ($agendarutin as $item)
                            
                        <div class="m-2 p-3 border border-1 ronded rounded-3 bg-lightgreen">
                            <div class="btn btn-sm text-white rounded rounded-3 bg-success mb-3">{{ $item->every }}</div>
                            <p class="fw-bolder"> {{ $item->title }} </p>
                            <p class="fs-7 text-muted"> {!! $item->content !!} </p>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
  <div class="container my-5">
    <div class="row">
        <div class="heading-space-between">
            <div class="section-title  py-3">
                <div class="title fw-bolder text-primary"><h1>Gallery</h1> </div>
            </div>
            <a class="d-flex btn-small text-white my-4" href="#">
                <span class="display-flex-center">Lihat Semua 
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" right="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            </a>
        </div>
        <div class="row  justify-content-md-center align-items-center">
              <div class="col-xl-12  mx-auto">
                <div class="row list-gallery">
                    @foreach ($gallery as $item)
                        <div class="col-md-3 py-3 item-gallery">
                            <a href="{{ url("storage/gallery-{$item->images}")  }}" data-type="image"  target="_blank" class="col-sm-4">
                                <img src="{{ url("storage/gallery-{$item->images}")  }}" data-bilderrahmen="example-gallery" data-bilderrahmen-title="{{ $item->caption }}" class="img-fluid" alt="{{ $item->caption }}">
                            </a>
                        </div>
                    @endforeach
                </div>
              </div>
        </div>
      </div>
</section>
@endsection