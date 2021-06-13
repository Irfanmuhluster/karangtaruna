@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Berita</a></li>
                <li class="breadcrumb-item">Kategori Berita</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Kategori Berita </h1>
            {{-- <a href="{{ route('admin.newscategory.create') }}"  class="btn btn-success"> <i class="fas fa-plus"></i> Tambah Kategori</a> --}}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div> 
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        
        <form id="search" action="{{ route('admin.newscategory.index') }}" method="GET">
            <div class="input-group mb-3">
                    @foreach (request()->only(['role']) as $q_key => $q_val)
                    <input type="hidden" name="{{ $q_key }}" value="{{ $q_val }}">
                    @endforeach
                    <input type="text" class="form-control" name="search" placeholder="Cari Kategori" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <button type="submit" class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></button>
                    </div>
            </div>
        </form>
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col"><span class="d-none d-md-block">Kategori</span></th>
                    <th scope="col"><span class="d-none d-md-block">Keterangan</span></th>
                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($datacategory as  $index => $item)
                
                <tr>
                    <td scope="row">
                        {{ $rank++ }}
                    </td>
                    <td>
                        {{ $item->category_name }}
                    </td>
                    <td>
                        {{ $item->description }}
                    </td>
                    <td>
                    <a href="#" data-toggle="modal" data-target="#updateNew" type="button" data-id="{{ $item->id }}" title="Ubah" class="btn-edit btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{$index}}" data-id="2">
                        <i class="fas fa-trash-alt"></i>
                    </div>

                    <div class="modal fade scale" id="deleteMenu-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Hapus Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">    
                                    <form id="role-menu-form-delete" action="{{ route('admin.newscategory.destroy',$item->id) }}" spellcheck="false"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus kategori berita ini ?</div>
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
                
                {{-- @endforeach --}}
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center my-4">
                {{-- {{  $datauser->links() }} --}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form spellcheck="false" action="{{ route('admin.newscategory.store') }}" id="role-form"  method="POST">
            <div class="modal-body">
                <div class="modal-body">
                        @csrf
                        <input type="hidden" name="slug" value="">
                        {{-- @error('slug')
                            <div class="alert-error">{{ $message }}</div>
                        @enderror --}}
                            <div class="form-group ">
                                <label for="name"><strong>Kategori</strong> <span class="text-danger">*</span></label>
                                <input type="text" name="category_name" id="name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" placeholder="Nama Kategori" /> 
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <div class="form-group ">
                                <label for="description"><strong>Keterangan</strong></label>
                                <textarea name="description" id="description" class="form-control  texteditor  @error('description') is-invalid @enderror " rows=" 5 " placeholder="">  </textarea>
                                
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="role-form-errors"></div>
                            <button type="submit" class="btn btn-primary mb-2">Tambah Kategori</button>
                        {{-- <div id="role-form-errors"></div> --}}
                
                </div>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="updateNew" tabindex="-1" role="dialog" aria-labelledby="updateNew" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form spellcheck="false" action="{{ route('admin.newscategory.update-category') }}" id="role-form"  method="POST">
            <div class="modal-body">
                <div class="modal-body">
                    
                        @csrf
                        <input type="hidden" id="id-update" name="id" value="">
                        {{-- @error('slug')
                            <div class="alert-error">{{ $message }}</div>
                        @enderror --}}
                            <div class="form-group ">
                                <label for="name"><strong>Kategori</strong> <span class="text-danger">*</span></label>
                                <input type="text" name="category_name" id="category_name-update" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" placeholder="Nama Kategori" /> 
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <div class="form-group ">
                                <label for="description"><strong>Keterangan</strong></label>
                                <textarea name="description" id="description-update" class="form-control  texteditor  @error('description') is-invalid @enderror " rows=" 5 " placeholder="">  </textarea>
                                
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="role-form-errors"></div>
                            <button type="submit" class="btn btn-primary mb-2">Update Kategori</button>
                        {{-- <div id="role-form-errors"></div> --}}
                
                </div>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
$(function () {

    function showData(id){
        $.ajax({
            url: '{{ route('admin.newscategory.show') }}',
            // type : 'POST',
            data:  {_token:"{{ csrf_token() }}",id:id },
            success: function (data) {
                // console.log(data);
                $("#id-update").val(data.newscategory.id);
                $("#category_name-update").val(data.newscategory.category_name);
                $("#description-update").val(data.newscategory.description);
                // $("#description_en-update").val(data.news.description_en);
            }
        });
    }

    $('.btn-edit').click(function (e) {
        $(".invalid-feedback").remove();
        id = $(this).data('id');
        showData(id);
    });

    @if(request()->form_active)
        showData('{{request()->id}}');
        $('#updateNew').modal('show')
    @endif

});
</script>
@endsection