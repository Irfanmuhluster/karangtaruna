@extends('admin::layout')

@section('content')

<div class="min-h-title">
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
            <div class="col-xl-3 col-lg-4 col-md-12" style="position: relative;">
                <div class="card" style="position: relative;">
                    <div class="card-body px-2 position-relative">
                        <div class="d-flex mt-auto justify-content-center">
                            
                            
                            <div class="item7-card-img item-center justify-content-center text-center">
                                <a href="#"></a>
                                <img src="{{ url("storage/gallery-{$data->images}") }}" alt="img" class="card-img-top rounded">
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="p-4 d-flex" >
                        <div class="media-user mr-2">
                            <div>
                                <h5>{{ $data->caption }}</h5>
                                <small class="d-block text-muted">
                                    @if ($data->publish == 1)
                                        <i class="fas fa-circle text-success font-xs m-1"></i> Terbit                                                                               
                                    @else
                                        <i class="fas fa-circle text-danger font-xs m-1"></i> Draft  
                                    @endif    
                                </small>
                            </div>
                            {{-- <div>
                                <div>
                                    <div class="font-weight-semibold text-warning">Rp. {{ number_format($item->price-($item->price*$item->discount/100)) }}</div>
                                    <small class="d-block text-muted">Rp. <strike>{{ number_format($item->price) }}</strike></small>
                                </div>
                            </div> --}}
                        </div>
                        
                        
                        <div class="ml-auto text-muted" style="position: relative;">
                            <a class="option-dots new-list2" data-toggle="dropdown" role="button" style="cursor: pointer"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg></a>
                            <div class="dropdown-menu tx-13 dropdown-menu-right"  style="z-index: 1001; ">
                                <a class="dropdown-item" href="{{ route('admin.gallery.edit', $data->id ) }}">Edit</a>
                                <a class="dropdown-item" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{$index}}" data-id="2">Hapus</a>
                                
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