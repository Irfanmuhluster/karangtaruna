@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Agenda</li>
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
            <h1> Agenda </h1>
            <a href="{{ route('admin.agenda.create', ['agendatype' => request()->agendatype]) }}" class="btn ml-4 mt-1 mb-4 min-w-auto btn-success">
                <i class="fas fa-plus"></i> Tambah Agenda
            </a>
        </div> 

        <div class="row py-3">
            <div class="col-12">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="btn btn-primary mx-1 {{ ('0' == request()->agendatype) ? 'active' : '' }}" id="pills-position-{{ request()->agendatype }}" href="{{ route('admin.agenda.index', ['agendatype' => 0]) }}">Agenda Terjadwal</a>
                        <a class="btn btn-primary mx-1 {{ ('1' == request()->agendatype) ? 'active' : '' }}" id="pills-position-{{ request()->agendatype }}" href="{{ route('admin.agenda.index', ['agendatype' => 1]) }}">Agenda Rutin</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Agenda" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></span>
            </div>
        </div>
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col"><span class="d-none d-md-block">Judul</span></th>
                    <th scope="col"><span class="d-none d-md-block">Pelaksanaan </span></th>
                    <th scope="col"><span class="d-none d-md-block">Terakhir diperbarui</span></th>
                    <th scope="col"><span class="d-none d-md-block">Status</span></th>
                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dataagenda as $index => $agenda) 
                <tr>
                    <td scope="row">
                        {{ $rank++ }}
                    </td>
                    <td>
                        {{ $agenda->title }}
                    </td>
                    <td>
                        {{ ($agenda->every != null) ? $agenda->every : showDateTime($agenda->event_date, 'l, d F Y') }}
                    </td>
                    <td>
                        {{ showDateTime($agenda->created_at, 'l, d F Y @H:i') }}
                    </td>
                    <td>
                        <div class=" list-properties list-detail" id="viewStatus-17">
                            @if ($agenda->publish == 1)
                                <i class="fas fa-circle text-success font-xs mr-1"></i> Terbit                                                                               
                            @else
                                <i class="fas fa-circle text-danger font-xs mr-1"></i> Draft  
                            @endif
                                    
                        </div>
                    </td>
                    
                    <td>
                        <a href="{{ route('admin.agenda.edit',  [$agenda->id , 'agendatype' => request()->agendatype]) }}" class="btn btn-sm btn-primary pull-right edit">
                            <i class="fas fa-edit"></i> Ubah
                        </a>
                        <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{ $index }}" data-id="">
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
                                        <form id="role-menu-form-delete" action="{{ route('admin.agenda.destroy', [$agenda->id , 'agendatype' => request()->agendatype]) }}" spellcheck="false"  method="POST">
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
                {{  $dataagenda->appends(array('agendatype' => request()->agendatype))->links() }}
            </div>
    </div>
</div>
@endsection