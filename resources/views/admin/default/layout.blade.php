<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Dashboard 3</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ theme_asset('backend::default', 'css/fontawesome/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ theme_asset('backend::default', 'css/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ theme_asset('backend::default', 'css/adminlte.min.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  @stack('style')
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
        var _BASE_URL_ADMIN = "{{ url(config('app.setting.backend.slug')) }}";
        $('#role-selectRole').on('change', function () {
              window.location.href = _BASE_URL_ADMIN + `/settingaccess/permission?role=` + $(this).val()
        })

        
      $('.role-menu-edit-btn').on('click', function () {
          let selected = $(this)
          console.log(selected);
          let form = $('form#menu-form-edit')
          form.attr('action',selected.data('route-edit'))
          form.find('input[name="menu_label"]').val(selected.data('label'))
          // form.find('input[name="menu_label_en"]').val(selected.data('labelen'))
          form.find('input[name="menu_route_index"]').val(selected.data('routeindex'))
          form.find('input[name="menu_icon"]').val(selected.data('icon'))
          // form.find('input[name="menu_icon"]').attr('readonly', (selected.data('hideicon')) ? true : false)
          // form.find('input[name="menu_active_if"]').val(selected.data('activeif'))
          form.find('input[name="menu_key"]').val(selected.data('key'))
      })


      $('.permission-group').on('change', function(){
          $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
      });

      function parentChecked(){
            $('.permission-group').each(function(){
                var allChecked = true;
                $(this).siblings('ul').find("input[type='checkbox']").each(function(){
                    if(!this.checked) allChecked = false;
                });
                $(this).prop('checked', allChecked);
            });
        }

        parentChecked();
    
        $('.the-permission').on('change', function(){
                parentChecked();
        });

        // $(function () {
          @error('form_active')
              @if($message == 'store')
                $('#modal-default').modal('show')
              @else
                $('#updateNew').modal('show')
              @endif
          @enderror

          const fileSelect = document.getElementById("exampleFormControlFile1");
      const fileList = document.getElementById("preview-img");

      fileSelect.addEventListener("change", handleFiles);

      function handleFiles() {
          if (!this.files.length) {
              fileList.innerHTML = "<p>No files selected!</p>";
          } else {
              fileList.innerHTML = "";
              const list = document.createElement("ul");
              list.style.listStyle = "none";
              fileList.appendChild(list);
              for (let i = 0; i < this.files.length; i++) {
                    const li = document.createElement("li");
                    list.appendChild(li);
                                  
                    const img = document.createElement("img");
                    img.classList.add("img-thumbnail");
                    img.src = URL.createObjectURL(this.files[i]);
                    img.width = 600;
                    img.onload = function() {
                    URL.revokeObjectURL(this.src);
              }
              li.appendChild(img);                      
              }
          }
      }


      const fileList2 = document.getElementById("preview-img2");

      const fileSelect2 = document.getElementById("exampleFormControlFile2");
      fileSelect2.addEventListener("change", handleFiles2);
      function handleFiles2() {
          if (!this.files.length) {
              fileList2.innerHTML = "<p>No files selected!</p>";
          } else {
              fileList2.innerHTML = "";
              const list = document.createElement("ul");
              list.style.listStyle = "none";
              fileList2.appendChild(list);
              for (let i = 0; i < this.files.length; i++) {
                    const li = document.createElement("li");
                    list.appendChild(li);
                                  
                    const img = document.createElement("img");
                    img.classList.add("img-thumbnail");
                    console.log(this.files[i]);
                    img.src = (URL || webkitURL).createObjectURL(this.files[i]);
                    img.width = 600;
                //     img.onload = function() {
                //     URL.revokeObjectURL(this.src);
                // }
              li.appendChild(img);                      
              }
          }
      }
  })  
  </script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <div id="user" class="d-flex align-items-center">
        <div class="position-relative">
          <div id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle has-dropdown">
              <span>{{ config('username')  }}</span>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="width:2rem;" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </span>
          </div>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute;
          right: 0px;  left: auto !important;">
            <a class="dropdown-item"  href="{{ route('admin.logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
          </div>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
      <img src="{{   general_setting('logo') ? url('storage/' . general_setting('logo')) : theme_asset('backend::default', 'img/logo-dummy.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ general_setting('title') ?? 'welcome message no'  }}</span>
    </a>

    <x-admin.layouts.sidebar>
    </x-admin.layouts.sidebar>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        @yield('content')
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<!-- AdminLTE -->
@stack('js')
<script src="{{ theme_asset('backend::default', 'js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ theme_asset('backend::default', 'js/adminlte.js') }}"></script>

</body>
</html>
