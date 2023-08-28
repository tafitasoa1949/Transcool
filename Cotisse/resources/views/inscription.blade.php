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
      <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />
   </head>
   <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    NOUVEAU MEMBRE
                </div>
                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="GET" action="{{ url('/enregistrer') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">Nom</label>
                                <input type="text" class="form-control" name="nom">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Prenoms</label>
                                <input type="text" class="form-control" name="prenoms">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Mot de passe</label>
                                <input type="password" class="form-control" name="mdp">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">CIN</label>
                                <input type="number" class="form-control" name="cin">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Contact</label>
                                <input type="number" class="form-control" name="contact">
                            </div>
                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary">S'inscrire</button>
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <a href="{{ url('/') }}" id="retour">Connexion</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
   </body>
</html>
