@extends('admin::layout')

@section('content')
    
    <div class="min-h-title">
        <div class="padding-lr">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb hidden-xs">
                    <li class="breadcrumb-item"><a href="admin.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="admin-agenda.html">Pengaturan Akses</a></li>
                    <li class="breadcrumb-item">Pengguna</li>
                </ol>
            </nav>
        </div>
    </div>

    

    <div class="row">
        <div class="card col-xl-5 col-md-5 col-sm-12 m-2">
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                        <th class="detail">Nama</th>
                            <td>{{ $datacontact->name }}</td>
                        </tr>
                        <tr>
                        <th class="detail">Email</th>
                            <td>{{ $datacontact->email }}</td>
                        </tr>
                        <tr>
                        <th class="detail">Alamat</th>
                            <td>{{ $datacontact->address }}</td>
                        </tr>
                        <tr>
                        <th class="detail">Kota</th>
                            <td>{{ $datacontact->city }}</td>
                        </tr>
                        <th class="detail">Provinsi</th>
                            <td>{{ $datacontact->province }}</td>
                        </tr>
                        <th class="detail">Phone</th>
                            <td>{{ $datacontact->phone }}</td>
                        </tr>
                        <th class="detail">Pesan</th>
                            <td>{{ $datacontact->message }}</td>
                        </tr>
                        <th class="detail">Lampiran</th>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-md-6 col-xl-6 col-sm-12 m-2">
          
            <div class="card-body">
                <label>Balas pesan <span class="text-danger">*</span></label>
                <form action="{{ route('admin.contact.updatereply', $datacontact->id) }}" method="post">
                    @method('put')
                    @csrf
                     <input type="hidden" name="from_page" value="{{ Request::get('from_page') }}">
                     <input type="hidden" name="subject" value="{{ $datacontact->subject }}">
                     <input type="hidden" name="name" value="{{ $datacontact->name }}">
                     <input type="hidden" name="email" value="{{ $datacontact->email }}">
                     <input type="hidden" name="address" value="{{ $datacontact->address }}">
                     <input type="hidden" name="city" value="{{ $datacontact->city }}">
                     <input type="hidden" name="province" value="{{ $datacontact->province }}">
                     <input type="hidden" name="phone" value="{{ $datacontact->phone }}">
                     <input type="hidden" name="message" value="{{ $datacontact->message }}">

                     

                     <textarea name="reply_msg" id="" style="width: 100%; max-width:100%; border-radius:0.25rem" rows="10"> {{ $datacontact->reply_msg }} </textarea>
                     <button type="submit" class="btn btn-primary"> Balas </button>
                </form>
            </div>
        </div>
    </div>

@endsection

