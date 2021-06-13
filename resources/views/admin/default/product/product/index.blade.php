@extends('admin::layout')

@section('content')

<div class="row mt-5 min-h-title">
    <div class="padding-lr">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin-agenda.html">Produk</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1> Produk </h1>
            <a href="#" class="btn ml-4 mt-1 mb-4 min-w-auto btn-success">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div> 

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Produk" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2"><i class="fas fa-search mx-2"></i></span>
            </div>
        </div>
        <table class="table shadow thspan-6" id="tableList">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="7%">No</th>
                    <th scope="col"><span class="d-none d-md-block">Nama Produk</span></th>
                    <th scope="col"><span class="d-none d-md-block">Kategori</span></th>
                    <th scope="col"><span class="d-none d-md-block">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">
                        1
                    </td>
                    <td>
                        Menu Breakfast 1
                    </td>
                    <td>
                        Food
                    </td>
                    <td>
                    <a href="http://127.0.0.1:8000/admin/menus/2/edit" class="btn btn-sm btn-primary pull-right edit">
                        <i class="fas fa-edit"></i> Ubah
                    </a>
                    <div class="btn btn-sm btn-danger pull-right delete" data-id="2">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </div>
                
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <!--Pagination -->
            <nav class="my-4 pt-2">
                <ul class="pagination pagination-circle pg-blue mb-0">
                    <!--First-->
                    <li class="page-item disabled clearfix d-none d-md-block"><a class="page-link">First</a></li>
                    <!--Arrow left-->
                    <li class="page-item disabled">
                        <a class="page-link" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                    </li>
                    <!--Numbers-->
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">4</a></li>
                    <li class="page-item"><a class="page-link">5</a></li>
                    <!--Arrow right-->
                    <li class="page-item">
                        <a class="page-link" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                    </li>
                    <!--First-->
                    <li class="page-item clearfix d-none d-md-block"><a class="page-link">Last</a></li>
                </ul>
            </nav>
            <!--/Pagination -->
        </div>
    </div>
</div>

<div class="modal fade scale" id="addAccess" tabindex="-1" role="dialog" aria-labelledby="addAccessTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" title="Close">×</button>
            <div class="modal-body">
                <h5 class="modal-title" id="addAccessTitle">Tambah Peran Baru</h5>
                <form spellcheck="false" action="http://demo.produk1.test/admin/permission/store" id="role-form">
                    <div class="form-group">
                        <label for="accessTitle"><strong>Nama Peran <span class="text-danger">*</span></strong></label>
                        <div class="form-group">
                            <input type="text" name="role_name" class="form-control">
                        </div>
                    </div>
                    <div id="role-form-errors"></div>
                    <button type="submit" class="btn btn-primary mb-2">Tambah Peran</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection