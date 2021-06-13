@extends('admin::layout')

@section('content')

<div class="min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin-agenda.html">Pengaturan Website</a></li>
                <li class="breadcrumb-item">Template Email</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Template Email </h1>
         
        </div> 
        <br>
        @if (session()->has('success'))
            <x-alert type="success" /> 
        @endif
        
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col"><span class="d-none d-md-block">Subject Email</span></th>
                    <th scope="col"><span class="d-none d-md-block">Nama Email</span></th>
                    <th scope="col"><span class="d-none d-md-block">Desripsi Email</span></th>
                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dataemailtemplate as $data)
                <tr>
                    <td>
                       {{ $data->subject }}
                    </td>
                    <td>
                        {{ $data->template_name }}
                    </td>
                    <td>
                        {{ $data->template_description }}
                    </td>

                    <td>
                    <a href="{{ route('admin.setting.emailtemplate.edit', $data->id) }}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-edit"></i>
                    </a>
                
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