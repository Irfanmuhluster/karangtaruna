<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' id='main-css' href='{{ theme_asset_public('frontend::default', 'css/app.css') }}' type='text/css' media='all' onload="this.onload=null;this.rel='stylesheet'" />
  
  <link href="https://cdn.jsdelivr.net/npm/bilderrahmen@1.0.0/bilderrahmen.css" rel="stylesheet" />

  <meta name="description" content="@yield('meta_description', $metawebsite->meta_value->tagline)">
  <meta name="keywords" content="@yield('meta_keywords', $metawebsite->meta_value->keyword_meta_search)">

  <!-- CSRF Token -->
  <link rel="canonical" href="{{ url('/') }}">
  <meta name="_token" content="{{ csrf_token() }}">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="@yield('og_title', $metawebsite->meta_value->title ?? 'Elegant')">
  <meta property="og:description" content="@yield('og_description', $metawebsite->meta_value->tagline)">
  <meta property="og:image" content="@yield('og_image', url("storage/{$metawebsite->meta_value->logo}"))">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="@yield('og_site_name', $metawebsite->meta_value->title ?? 'Elegant')">
  <meta property="og:url" content="@yield('og_url', url()->current())">
  <!-- Twitter Card -->
  <meta name="twitter:card" content="@yield('twitter_card', 'summary')">
  <meta name="twitter:title" content="@yield('twitter_title', $metawebsite->meta_value->title ?? 'Elegant')">
  <meta name="twitter:description" content="@yield('twitter_description', $metawebsite->meta_value->tagline)">
  <meta name="twitter:image" content="@yield('twitter_image', url("storage/{$metawebsite->meta_value->logo}"))">
  <meta name="twitter:site" content="@yield('twitter_site', $metawebsite->meta_value->title)">

  <link rel="shortcut icon" sizes="16x16 32x32 48x48" href="{{ url("storage/{$metawebsite->meta_value->favicon}") }}">
  <title>@yield('title')</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-primary shadow-sm px-3 py-3" id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
          <img loading="lazy" height="50" src="{{  url("storage/{$metawebsite->meta_value->logo}")  }}" srcset="{{  url("storage/{$metawebsite->meta_value->logo}")  }} 1x, {{  url("storage/{$metawebsite->meta_value->logo}")  }} 2x" alt="{{ $metawebsite->meta_value->title }}">
              <span class="font-weight-bold text-white ml-3">{{ $metawebsite->meta_value->title }}</span>
        </a>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ms-auto text-lg-right mb-2 mb-lg-0">
            {{-- @dd($topnav) --}}
         @foreach($topnav as $item)
          <li class="nav-item {{ ($item->child->count() > 0) ? "dropdown" : "" }}">
            @if ($item->child->count() > 0)
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $item->label }}
                </a>
                    <ul class="dropdown-menu dropdown-menu-right rounded-2" aria-labelledby="navbarDarkDropdownMenuLink">
                        
                        @foreach ($item->child as $sub)   
                        <li>                         
                           <a class="dropdown-item" href="{{ url($sub->link) }}">{{ $sub->label }}</a>
                        </li>
                        @endforeach
                    </ul>
            @else            
                <a class="nav-link" aria-current="page" href="{{ url($item->link) }}">{{ $item->label }}</a>
            @endif
          </li>
          @endforeach
        </ul>
        <form class="d-flex">
          <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
          <button class="btn btn-outline-success text-light" type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24" width="20" height="20" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg></button>
        </form>
      </div>
    </div>
  </nav>
    <main>
        @yield('content')
    </main>
    <footer id="footer" class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
                <img class="img-fluid p-2 w-75" src="{{  url("storage/{$metawebsite->meta_value->logo}") }}" style="height: auto;">
                <p class="lh-base py-2">{{ $metawebsite->meta_value->tagline }} </p>									
            </div>
    
            <div class="col-md-4 mb-3">
              <div> 
                <h4>Kontak</h4>
                <ul class="p-0">
                  <li><p><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg> {{ $metawebsite->meta_value->address }}</p></li>
                  <li><p><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg> <strong>Phone:</strong> {{ $metawebsite->meta_value->phone }}<!--  --></p></li>
                  <li><p><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg> <strong>Email:</strong> <a class="text-muted text-decoration-none" href="mailto:humas@uin-suka.ac.id.com"><!--   -->{{ $metawebsite->meta_value->email }}</a></p></li>
                </ul>
                <div class="d-flex py-2 mb=3">
                  @if (!empty($metasosialmedia->value->link_wa))
                  <div class="px-2"><a href="https://api.whatsapp.com/send?phone={{ $metasosialmedia->value->link_wa }}" class="text-light"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16C12.84 16.27 13.3 16.42 13.66 16.53C14.25 16.72 14.79 16.69 15.22 16.63C15.7 16.56 16.68 16.03 16.89 15.45C17.1 14.87 17.1 14.38 17.04 14.27C16.97 14.17 16.81 14.11 16.56 14C16.31 13.86 15.09 13.26 14.87 13.18C14.64 13.1 14.5 13.06 14.31 13.3C14.15 13.55 13.67 14.11 13.53 14.27C13.38 14.44 13.24 14.46 13 14.34C12.74 14.21 11.94 13.95 11 13.11C10.26 12.45 9.77 11.64 9.62 11.39C9.5 11.15 9.61 11 9.73 10.89C9.84 10.78 10 10.6 10.1 10.45C10.23 10.31 10.27 10.2 10.35 10.04C10.43 9.87 10.39 9.73 10.33 9.61C10.27 9.5 9.77 8.26 9.56 7.77C9.36 7.29 9.16 7.35 9 7.34C8.86 7.34 8.7 7.33 8.53 7.33Z"></path></svg></a></div>    
                  @endif
                  @if (!empty($metasosialmedia->value->link_instagram))
                  <div class="px-2"><a href="{{ url($metasosialmedia->value->link_instagram) }}" class="text-light"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"></path></svg></a></div>
                  @endif
                  @if (!empty($metasosialmedia->value->link_twitter))
                  <div class="px-2"><a href="{{ url($metasosialmedia->value->link_twitter) }}" class="text-light"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"></path></svg></a></div>
                  @endif
                  @if (!empty($metasosialmedia->value->link_fb))
                  <div class="px-2"><a href="{{ url($metasosialmedia->value->link_fb) }}" class="text-light"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"></path></svg></a></div>
                  @endif
                </div>
              </div>
              <!-- <div class="d-flex py-2">
                <div class="social-icon"><a href="https://api.whatsapp.com/send?phone=+6282147439346" class="text-light p-2"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16C12.84 16.27 13.3 16.42 13.66 16.53C14.25 16.72 14.79 16.69 15.22 16.63C15.7 16.56 16.68 16.03 16.89 15.45C17.1 14.87 17.1 14.38 17.04 14.27C16.97 14.17 16.81 14.11 16.56 14C16.31 13.86 15.09 13.26 14.87 13.18C14.64 13.1 14.5 13.06 14.31 13.3C14.15 13.55 13.67 14.11 13.53 14.27C13.38 14.44 13.24 14.46 13 14.34C12.74 14.21 11.94 13.95 11 13.11C10.26 12.45 9.77 11.64 9.62 11.39C9.5 11.15 9.61 11 9.73 10.89C9.84 10.78 10 10.6 10.1 10.45C10.23 10.31 10.27 10.2 10.35 10.04C10.43 9.87 10.39 9.73 10.33 9.61C10.27 9.5 9.77 8.26 9.56 7.77C9.36 7.29 9.16 7.35 9 7.34C8.86 7.34 8.7 7.33 8.53 7.33Z"></path></svg></a></div>
                <div class="social-icon"><a href="https://instagram.com/idwebhostcom" class="text-light p-2"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"></path></svg></a></div>
                <div class="social-icon"><a href="https://twitter.com/idwebhost" class="text-light p-2"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"></path></svg></a></div>
                <div class="social-icon"><a href="https://www.facebook.com/idwebhost/" class="text-light p-2"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"></path></svg></a></div>
              </div> -->
            </div>
            <div class="col-md-4">
              <h4>Menu</h4>
              <div class="d-flex flex-column">
                @foreach($bottomnav as $item)  
                  <a href="{{ url($item->link) }}" class="text-decoration-none text-light py-1">{{ url($item->label) }}</a>
                @endforeach
                
              </div>
            </div>
        </div>
        <div class="bg-primary border-top p-2">
    
                <p>{{ $metawebsite->meta_value->footer }} by <a href="https://idcodewebs.com">Idcodewebs.</a></p>
    
        </div>
      </div>
      </footer>
      
    {{-- <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
      integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/gh/requirejs/requirejs@2.3.5/require.js"></script>
     <script  type="text/javascript" src="{{ theme_asset_public('frontend::default', 'js/app.js') }}"></script>     
      {{--         
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>   --}}
      </body>

</html>
    
    