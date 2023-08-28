@include('template.header')
@include('template.sidebar')
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-11 col-lg-11 col-md-6 col-sm-12 col-12">
                        @if(isset($choixVehicule) && $choixVehicule == true)
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-muted">Liste des vehicules</h2>
                                    <hr>
                                    @foreach($listeType as $type)
                                        <h4>Categorie {{ $type->nom }}</h4>
                                        <ul class="list-group">
                                            @foreach($listeBusParType->get($type->nom) as $bus)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $bus->nom }}
                                                    <a href="{{ url('rapportVehicule/'.$bus->id) }}"><span class="badge bg-light rounded-pill"><i class="fas fa-fw fa-chart-line"></i></span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        @elseif(isset($grapheVehicule) && $grapheVehicule == true)
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ url('/statsVehicule') }}">
                                        <button type="button" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Retour</button>
                                    </a>
                                    <hr>
                                    <h3 class="text-muted">{{ $vehicule->type }}</h3>
                                    <h2>{{ $vehicule->nom }}</h2>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card border-success mb-3" style="border-radius:5px; max-width: 18rem; box-shadow: 0px 0px 4px grey, 0px 0px 4px lightgrey;">
                                        <div class="card-header">Total de voyage accomplit: </div>
                                        <div class="card-body text-primary">
                                            <!-- <h5 class="card-title">Revenu mois de ...</h5> -->
                                            <p class="card-text" style="font-size: xx-large; text-align: center;">{{ $totalVoyage }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-muted">Voyages</h2>
                                    <input type="hidden" id="idvehicule" value="{{ $vehicule->idbus }}">
                                    <div style="width: 50%; display:grid; grid-template-columns: 37% 37% 23%; grid-gap:1.5%;">
                                        <select name="moisChoisit" id="moisChoisit" class="form-control" required>
                                            <option value="">Choisir un mois ...</option>
                                            @foreach ($moisChoix as $mois)
                                                <option value="{{ $mois['code'] }}">{{ $mois['nom'] }}</option>
                                            @endforeach
                                        </select>
                                        <select name="anneeChoisit" id="anneeChoisit" class="form-control" required>
                                            <option value="">Choisir une annee ...</option>
                                            @foreach ($anneeChoix as $annee)
                                                <option value="{{ $annee }}">{{ $annee }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-outline-primary" id="afficher_graphe_vehicule">Afficher</button>
                                    </div>
                                    <hr>
                                    <h3 id="nbVoyageParMois"></h3>
                                    <h4>Graphe nombre de voyage/jour:</h4>
                                    <div id="graphe_vehiculeVoyage" class="c3" style="max-height: 350px; position: relative;"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
@include('template.footer')
