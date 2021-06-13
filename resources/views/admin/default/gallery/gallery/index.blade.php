@extends('admin::layout')

@section('content')

<div class="row mt-5 min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Gallery</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Gallery </h1>
            <a href="{{ route('admin.gallery.create', ['cat' => request()->cat]) }}" class="btn ml-4 mt-1 mb-4 min-w-auto btn-success">
                <i class="fas fa-plus"></i> Tambah Gallery
            </a>
        </div> 

        <div class="row py-3">
            <div class="col-12">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="btn btn-primary mx-1 {{ ( request()->cat == null) ? 'active' : '' }}" id="pills-position" href="{{ route('admin.gallery.index') }}">Semua Kategori</a>
                    </li>
                    @foreach ($getcategory as $vk => $vp)
                    <li class="nav-item">
                        <a class="btn btn-primary mx-1 {{ ($vp->id == request()->cat) ? 'active' : '' }}" id="pills-position-{{ $vk }}" href="{{ route('admin.gallery.index', ['cat' => $vp->id]) }}">{{ $vp->categoryname }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Gallery" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></span>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12  col-md-12 mx-auto">
            <div class="row">
            @foreach ($datagallery as $index => $data) 
            <div class="col-md-3 col-sm-10 my-3">
                <div class="card p-1 m-3">
                    <img src="{{ url("storage/gallery-{$data->images}") }}" class="card-img-top" alt="{{ $data->caption }}">
                        <div class="card-body">
                        <h5 class="card-title">{{ $data->caption }}</h5>
                        
                        <div class="text-right">
                            <div class="pt-3">
                                @if ($data->publish == 1)
                                    <i class="fas fa-circle text-success font-xs m-1"></i> Terbit                                                                               
                                @else
                                    <i class="fas fa-circle text-danger font-xs m-1"></i> Draft  
                                @endif
                            </div>
                            <div class="btn-group pt-1">
                                <a href="{{ route('admin.gallery.edit', $data->id ) }}" class="btn btn-md btn-primary pull-right edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                                </a>
                                <div class="btn btn-md btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{$index}}" data-id="2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade scale" id="deleteMenu-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title">Hapus Gambar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">    
                                <form id="role-menu-form-delete" action="{{ route('admin.gallery.destroy',$data->id) }}" spellcheck="false"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus gambar ini ?</div>
                                    <div id="role-menu-form-delete-errors"></div>
                                    <button type="submit" class="btn btn-danger mb-2">Hapus</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>

            <!--Pagination -->
            <div class="d-flex justify-content-center my-4">
                {{  $datagallery->links() }}
            </div>
    </div>
</div>
@endsection