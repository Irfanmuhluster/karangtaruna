@extends('admin::layout')

@section('content')

<div class="row mt-5 min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Banner</a></li>
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
            <h1> Banner </h1>
            <a href="{{ route('admin.banner.create', ['position' => request()->position ?? 'top']) }}" class="btn ml-4 mt-1 mb-4 min-w-auto btn-success">
                <i class="fas fa-plus"></i> Tambah Banner
            </a>
        </div> 

        <div class="row py-3">
            <div class="col-12">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    @foreach ($config['banners'] as $vk => $vp)
                    <li class="nav-item">
                        <a class="btn btn-primary mx-1 {{ ($vk == $position) ? 'active' : '' }}" id="pills-position-{{ $vk }}" href="{{ route('admin.banner.index', ['position' => $vk]) }}">{{ $vp }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Banner" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></span>
            </div>
        </div>
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col">Urutkan</th>
                    <th scope="col"><span class="d-none d-md-block">Judul</span></th>
                    <th scope="col"><span class="d-none d-md-block">Gambar </span></th>
                    <th scope="col"><span class="d-none d-md-block">Status </span></th>
                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($databanner as $index => $banner) 
                <tr>
                    <td scope="row">
                         {{ $rank++ }}
                    </td>
                    <td>
                        @if($index !== 0)
                        <a href="{{ route('admin.banner.sort', ['banner' => $banner, 'type' => 'up', 'position' => request()->position]) }}" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                        </a>
                        @endif
                        @if(!$loop->last)
                        <a href="{{ route('admin.banner.sort', ['banner' => $banner, 'type' => 'down', 'position' => request()->position]) }}" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                            </svg>
                        </a>
                        @endif
                    </td>
                    <td>
                        {{ $banner->title }}
                    </td>
                    <td>
                        <img src="{{ url("storage/{$banner->images}") }}" width="200" height="auto" class="rounded mx-auto d-block" alt="...">
                    </td>
                    <td>
                        @if ($banner->publish == 1)
                            <div class="btn-sm ml-1 mt-1 mb-1 min-w-auto btn-success">
                                <i class="fas fa-circle text-white font-xs mr-1"></i> Terbit                                                                               
                            </div>
                        @else
                            <div class="btn-sm ml-1 mt-1 mb-1 min-w-auto btn-danger">
                                <i class="fas fa-circle bg-danger text-white font-xs mr-1"></i> Draft  
                            </div>
                        @endif
                    </td>
                    <td>
                    <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-edit"></i> Ubah
                    </a>
                    <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{ $index }}" data-id="{{ $index }}">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div class="modal fade scale" id="deleteMenu-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Hapus Berita</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">    
                                    <form id="role-menu-form-delete" action="{{ route('admin.banner.destroy', $banner->id) }}" spellcheck="false"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus data ini ?</div>
                                        <div id="role-menu-form-delete-errors"></div>
                                        <button type="submit" class="btn btn-danger mb-2">Hapus</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <!--Pagination -->
            <div class="d-flex justify-content-center my-4">
                {{  $databanner->links() }}
            </div>
    </div>
</div>
@endsection