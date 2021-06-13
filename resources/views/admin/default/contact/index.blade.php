@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin-agenda.html">Kontak</a></li>
                <li class="breadcrumb-item">Semua Pesan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> @if(isset($datacontact->is_home))
                Semua Pesan
            @elseif(isset($datacontact->is_unread))
                Pesan Belum Dibalas
            @elseif(isset($datacontact->is_replied))
               Pesan Sudah di Balas
            @endif </h1>
         
        </div> 
        <br>
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif

        @if(isset($datacontact->is_home))
            @php($from_page = 'home')
        @elseif(isset($datacontact->is_unread))
            @php($from_page = 'unread')
        @elseif(isset($datacontact->is_replied))
            @php($from_page = 'replied')
        @endif
        
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col"><span class="d-none d-md-block">Pesan</span></th>
                    <th scope="col"><span class="d-none d-md-block">Nama</span></th>
                    <th scope="col"><span class="d-none d-md-block">Tanggal dibuat</span></th>
                    <th scope="col"><span class="d-none d-md-block">Status</span></th>

                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($datacontact as $message)
                <tr>
                    <td scope="row">
                        {{ $rank++ }}
                    </td>
                    <td>
                       {{ $message->message }}
                    </td>
                    <td>
                        {{ $message->name }}
                    </td>
                    <td>
                       {{ showDateTime($message->created_at, 'l, d F Y @H:i') }}
                    </td>
                    <td>
                        @if ($message->is_reply == 1)
                            <b>Telah dibalas</b>
                        @else
                            <b>Belum dibalas</b>
                        @endif
                     </td>
                    <td>
                    <a href="{{ route('admin.contact.reply', ['id' => $message->id, 'from_page' => $from_page ?? '']) }}" title="reply" class="btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-reply"></i>
                    </a>

                    <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-" data-id="2">
                        <i class="fas fa-trash-alt"></i>
                    </div>

                    <div class="modal fade scale" id="deleteMenu-" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Hapus User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">    
                                    <form id="role-menu-form-delete" action="#" spellcheck="false"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus user ini ?</div>
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
                {{-- {{  $datauser->links() }} --}}
        </div>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection