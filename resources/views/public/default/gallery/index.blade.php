@extends('public::layout')

@section('title', "Galeri")
@section('meta_description',  "Galeri Gambar " . $metawebsite->meta_value->title)
@section('meta_keywords',  "Galeri, Galeri Gambar " . $metawebsite->meta_value->title)

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
                            <li class="breadcrumb-item active" aria-current="page">Galleri</li>
                        </ol>
                    </nav>

                    <h1 class="font-weight-bold h3">Galleri Gambar</h1>

                </div>
            </div>
        </div>
    </div>

</section>
<section>
    <div class="row mb-4 justify-content-center">
        <div class="col-auto my-3">
            <a class="btn btn-outline-primary rounded-2  {{ ( request()->cat == null) ? 'active text-white' : '' }}" href="{{ route('public.gallery') }}">Semua Gambar</a>
            @foreach ($listcategory as $vk => $vp)
            {{-- <div class="col-auto my-3"> --}}
            <a class="btn btn-outline-primary rounded-2  {{ ($vp->id == request()->cat) ? 'active text-white' : '' }}" href="{{ route('public.gallery', ['cat' => $vp->id]) }}">{{ $vp->categoryname }}</a>
                {{-- </div> --}}
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row  justify-content-md-center align-items-center">
            <div class="col-xl-12  mx-auto">
                <div class="row list-gallery">
                    @foreach ($datagallery as $item)

                    <div class="col-md-3 py-3 item-gallery">
                        <a href="{{ url("storage/gallery-{$item->images}")  }}" data-type="image"  target="_blank" class="col-sm-4">
                            <img src="{{ $item->images  ? url("storage/gallery-{$item->images}") : '' }}" data-bilderrahmen="example-gallery" data-bilderrahmen-title="{{ $item->caption }}" class="img-fluid" alt="{{ $item->caption }}" alt="{{ $item->caption }}">
                        </a>
                    </div>
                                        
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center my-4">
                {{  $datagallery->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
