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
      <link rel="shortcut icon" href="images/travel.png" type="">
      <title>Transcool</title>
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
      <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="{{ asset('css/login.css') }}" rel="stylesheet" />
   </head>
   <body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" method="GET" action="{{ route('checklogin') }}">
                    @csrf
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Email" name="email">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Password" name="mdp">
                    </div>
                    @if(!empty($message))
                        <div class="heading_container heading_center">
                            <b class="text-danger">{{ $message }}</b>
                        </div>
                    @endif
                    <button class="button login__submit">
                        <span class="button__text">Connecter</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div class="social-login">
                    <h3><a href="{{ url('/inscription') }}" id="inscription">Inscription</a></h3>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
   </body>
</html>
