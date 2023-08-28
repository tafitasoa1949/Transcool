<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/logo.png" type="">
      <title>Transco</title>
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
      {{-- map --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
      <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-right:8.5vw;">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ Request::is('/home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/home') }}">Accueil<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('destination/*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <span class="nav-label">Reservations</span><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($type as $row)
                                    <li>
                                        <a href="{{ url('destination/'.$row->id) }}" class="{{ Request::is('destination/'.$row->id) ? 'active' : '' }}">
                                            {{ $row->nom }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                  <li><a class="nav-link" href="{{ url('/home') }}"><img src="{{url('images/logo.png')}}" alt="" srcset="" class="navbar-image" style="width:100px;"></a></li>
                        </li>
                        <li class="nav-item {{ Request::is('/commentaire') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/commentaire') }}">Commentaire</a>
                        </li>
                        <li class="nav-item {{ Request::is('/deconnexion') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/deconnexion') }}">Deconnexion</a>
                        </li>

                    </ul>
                </div>
               </nav>
            </div>
         </header>
