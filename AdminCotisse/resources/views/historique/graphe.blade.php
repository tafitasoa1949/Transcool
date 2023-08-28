@include('template.header')
@include('template.sidebar')
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-11 col-lg-11 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('/historiqueMembre/'.$membre->idtypemembre) }}">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Retour</button>
                                </a>
                                <hr>
                                <h3 class="text-muted">{{ $typemembre->type }}</h3>
                                <h2>{{ $membre->prenom }} {{ $membre->nom }}</h2>
                            </div>
                        </div>
        <!--------------------------------------------------------------------------------------------->
                        @if(isset($grapheVoyage) && $grapheVoyage==true)
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-muted">Voyages</h2>
                                    <div style="width: 50%; display:grid; grid-template-columns: 37% 37% 23%; grid-gap:1.5%;">
                                        <input type="hidden" id="idchauffeurVoyage" value="{{ $membre->idmembre }}">
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
                                        <button type="button" class="btn btn-outline-primary" id="afficher_graphe_voyage">Afficher</button>
                                    </div>
                                    <hr>
                                    <h4>Graphe nombre de voyage/jour:</h4>
                                    <div id="graphe_nbvoyage" class="c3" style="max-height: 350px; position: relative;"></div>
                                    <!-- <div id="c3chart_spline" class="c3" style="max-height: 320px; position: relative;"></div> -->
                                    <hr>
                                    <h4>Graphe revenu generer par ses voyages/jour:</h4>
                                    <div id="graphe_gainsvoyage" class="c3" style="max-height: 350px; position: relative;"></div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"></div>
                                </div>
                            </div>
                        @endif
        <!--------------------------------------------------------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
@include('template.footer')
