@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item">Semua Berita</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Berita </h1>
            <a href="{{ route('admin.news.create') }}" class="btn ml-4 mt-1 mb-4 min-w-auto btn-success">
                <i class="fas fa-plus"></i> Tambah Berita
            </a>
        </div> 
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif

        <form id="search" action="{{ route('admin.news.index') }}" method="GET">
            <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari Berita" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <button type="submit" class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></button>
                    </div>
            </div>
        </form>
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col"><span class="d-none d-md-block">Judul</span></th>
                    <th scope="col"><span class="d-none d-md-block">Kategori</span></th>
                    <th scope="col"><span class="d-none d-md-block">Penulis</span></th>
                    <th scope="col"><span class="d-none d-md-block">Tanggal dibuat</span></th>
                    <th scope="col"><span class="d-none d-md-block">Terakhir diperbarui</span></th>
                    <th scope="col"><span class="d-none d-md-block">Publish</span></th>
                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($datauser as $index => $user) --}}
            @foreach ($datanews as  $index => $news)
                <tr>
                    <td scope="row">
                        {{ $rank++ }}
                    </td>
                    <td>
                       {{ $news->title }}
                    </td>
                    <td>
                        {{ $news->category->category_name }}
                    </td>
                    <td>
                       {{ $news->createdby->name }}
                    </td>
                    <td>
                        {{ showDateTime($news->created_at, 'l, d F Y @H:i') }}
                    </td>
                    <td>
                        {{ showDateTime($news->updated_at, 'l, d F Y @H:i') }}
                    </td>
                    <td>
                        <div class=" list-properties list-detail" id="viewStatus-17">
                            @if ($news->publish == 1)
                                <i class="fas fa-circle text-success font-xs mr-1"></i> Terbit                                                                               
                            @else
                                <i class="fas fa-circle text-danger font-xs mr-1"></i> Draft  
                            @endif
                                    
                        </div>
                    </td>
                    <td>
                    <a href="{{ route('admin.news.edit', $news->id) }}" title="Ubah" class="btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{ $index }}" data-id="2">
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
                                    <form id="role-menu-form-delete" action="{{ route('admin.news.destroy', $news->id) }}" spellcheck="false"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus berita ini ?</div>
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
        
        <div class="d-flex justify-content-center my-4">
                {{  $datanews->links() }}
        </div>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection