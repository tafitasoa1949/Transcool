@include('template.header')
@include('template.sidebar')
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-11 col-lg-11 col-md-6 col-sm-12 col-12">
        <!--------------------------------------------------------------------------------------------->
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Liste des {{$typemembre->type}} actifs</h2>

                                <div style="width: 100%; height: auto; border: 1px solid black; border-radius:5px; background: rgb(239,239,246); overflow-x: auto; white-space:nowrap; display:flex; scrollbar-color: #263136 white; scrollbar-width: thin;">
                                    @foreach($listemembre as $row)
                                    <div style="width: 18rem; max-width: height: auto; margin: 10px; border: 1px hidden; border-radius: 5px; background:white;">
                                        <div style="display: grid; grid-template-columns: 80% 20%">
                                            <div><img style="width:100px;" src="{{ asset('assets/images/profil.jpg') }}" class="card-img-top" alt=""></div>
                                            <div style="border: 2px hidden black; margin-top:5px; text-align:center;">
                                                <a href="{{ url('/statsMembre/'.$row->idmembre) }}"><div style="width: 50%; margin:auto; border: 2px solid black;border-radius:100% "><i class="fas fa-fw fa-chart-area"></i></div></a>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <h3 class="card-title">{{ $row->prenom }} {{ $row->nom }}</h3>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b class="card-title">Salaire:</b> {{ $row->salaire }} Ar</li>
                                            <li class="list-group-item"><b class="card-title">Depuis:</b> {{ $row->datedebut }}</li>
                                        </ul>
                                        <div class="card-body">
                                            <a href="{{ url('/modificationMembre/'.$row->idmembre) }}" class="card-link"><span class="badge rounded-pill bg-primary">Modifier</span></a>
                                            <a href="{{ url('/demissionMembre/'.$row->idmembre) }}" class="card-link"><span class="badge rounded-pill bg-danger text-light">Démission</span></a>
                                        </div>
                                        @if(isset($demission) && $demission=="true")
                                            @if($idMembreDemission == $row->idmembre)
                                                <form action="{{ url('/demissioner') }}" method="GET" class="needs-validation">
                                                    <div class="card-body bg-light">
                                                        <input type="hidden" name="idmembre" value="{{ $row->idmembre }}">
                                                        <input type="hidden" name="idtypemembre" value="{{ $row->idtypemembre }}">
                                                        <label for="floatingPassword">Date de démission</label>
                                                        <input type="date" name="datefin" class="form-control" placeholder="">
                                                        <br>
                                                        <input type="submit" value="Confirmer">
                                                        <a href="{{ url('/annulerDemission/'.$row->idmembre) }}" class="card-link"><span class="badge bg-white text-dark">Annuler</span></a>
                                                    </div>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @if(isset($modification) && $modification=="true")
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">* Modification {{$typemembre->type}}: {{ $membre->nom }} *</h2>
                            </div>
                            <form action="{{ url('/modifier') }}" method="GET" class="needs-validation">
                                <input type="hidden" name="idmembre" value="{{ $membre->idmembre }}">
                                <input type="hidden" name="idtypemembre" value="{{ $membre->idtypemembre }}">
                                <div style="width:100%; display:grid; grid-template-columns: 50% 50%; grid-gap: 0%;">
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput">Nom</label>
                                            <input type="text" name="nom" class="form-control" id="floatingInput" placeholder="" value="{{ $membre->nom }}" required>
                                        </div>
                                        <div class="form-floating">
                                            <label for="floatingPassword">Prenom</label>
                                            <input type="text" name="prenom" class="form-control" id="floatingInput" placeholder="" value="{{ $membre->prenom }}" required>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput">Salaire (Ariary)</label>
                                            <input type="number" step="0.1" name="salaire" class="form-control" id="floatingInput" placeholder="" value="{{ $membre->salaire }}" required>
                                        </div>
                                        <div class="form-floating">
                                            <label for="floatingPassword">Date debut</label>
                                            <input type="hidden" name="olddatedebut" value="{{ $membre->datedebut }}">
                                            <input type="date" name="datedebut" class="form-control" id="floatingInput" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button id="top" class="btn btn-primary" type="submit">Modifier</button>
                                    <a href="#"><button id="top" class="btn btn-primary" style="background: lightgrey; border: 1px solid lightgrey;">Annuler</button></a>
                                </div>
                            </form>
                        </div>
                    @endif

                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Nouveau {{$typemembre->type}}</h2>
                            </div>
                            <form action="{{ url('/ajouterMembre') }}" method="GET" class="needs-validation">
                                <input type="hidden" name="idtypemembre" value="{{ $typemembre->id }}">
                                <div style="width:100%; display:grid; grid-template-columns: 50% 50%; grid-gap: 0%;">
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput">Nom</label>
                                            <input type="text" name="nom" class="form-control" id="floatingInput" placeholder="" required>
                                        </div>
                                        <div class="form-floating">
                                            <label for="floatingPassword">Prenom</label>
                                            <input type="text" name="prenom" class="form-control" id="floatingPassword" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput">Salaire (Ariary)</label>
                                            <input type="number" step="0.1" name="salaire" class="form-control" id="floatingInput" placeholder="" required>
                                        </div>
                                        <div class="form-floating">
                                            <label for="floatingPassword">Date debut</label>
                                            <input type="date" name="datedebut" class="form-control" id="floatingPassword" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button id="top" class="btn btn-primary" type="submit">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Liste des anciens {{$typemembre->type}}</h2>

                                <div style="width: 100%; height: auto; border: 1px solid black; border-radius:5px; background: rgb(239,239,246); overflow-x: auto; white-space:nowrap; display:flex; scrollbar-color: #263136 white; scrollbar-width: thin;">
                                    @foreach($listeancienmembre as $row)
                                    <div style="width: 18rem; max-width: height: auto; margin: 10px; border: 1px hidden; border-radius: 5px; background:white;">
                                        <div style="display: grid; grid-template-columns: 80% 20%">
                                            <div><img style="width:100px;" src="{{ asset('assets/images/profil.jpg') }}" class="card-img-top" alt=""></div>
                                            <div style="border: 2px hidden black; margin-top:5px; text-align:center;">
                                                <a href="#"><div style="width: 50%; margin:auto; border: 2px solid black;border-radius:100% ">?</div></a>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <h3 class="card-title">{{ $row->prenom }} {{ $row->nom }}</h3>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b class="card-title">Dernier salaire:</b> {{ $row->salaire }} Ar</li>
                                            <li class="list-group-item">
                                                <span><b class="card-title">Du:</b> {{ $row->datedebut }}</span>
                                                <br>
                                                <span><b class="card-title">Au:</b> {{ $row->datefin }}</span>
                                            </li>
                                        </ul>
                                        <div class="card-body">
                                            <a href="{{ url('/reembaucherMembre/'.$row->idmembre) }}" class="card-link"><span class="badge rounded-pill bg-primary">Réembaucher</span></a>
                                        </div>
                                        @if(isset($reembauche) && $reembauche=="true")
                                            @if($idMembreReembauche == $row->idmembre)
                                                <form action="{{ url('/reembaucher') }}" method="GET" class="needs-validation">
                                                    <div class="card-body bg-light">
                                                        <input type="hidden" name="idmembre" value="{{ $row->idmembre }}">
                                                        <input type="hidden" name="idtypemembre" value="{{ $row->idtypemembre }}">

                                                        <label for="floatingPassword">Date de réembauche</label>
                                                        <input type="date" name="datedebut" class="form-control" placeholder="">
                                                        <label for="floatingPassword">Nouveau Salaire</label>
                                                        <input type="number" step="0.1" name="nouveausalaire" class="form-control" placeholder="">
                                                        <br>
                                                        <input type="submit" value="Confirmer">
                                                        <a href="{{ url('/annulerDemission/'.$row->idmembre) }}" class="card-link"><span class="badge bg-white text-dark">Annuler</span></a>
                                                    </div>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
        <!--------------------------------------------------------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
@include('template.footer')
