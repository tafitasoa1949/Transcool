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
                                <h2 class="text-muted">Revenu mensuel</h2>
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
                                    <button type="button" class="btn btn-outline-primary" id="afficher_graphe_revenue">Afficher</button>
                                </div>
                                <hr>
                                <div class="card border-success mb-3" style="border-radius:5px; max-width: 18rem; box-shadow: 0px 0px 4px grey, 0px 0px 4px lightgrey;">
                                    <div class="card-header">Revenu <span id="moisactuel"></span></div>
                                    <div class="card-body text-primary">
                                        <!-- <h5 class="card-title">Revenu mois de ...</h5> -->
                                        <p class="card-text" style="font-size: x-large;" id="revenumensuel" ></p>
                                    </div>
                                </div>
                                <hr>
                                <h4>Graphe nombre de voyage/jour:</h4>
                                <div id="graphe_nbvoyages" class="c3" style="max-height: 350px; position: relative;"></div>
                                <hr>
                                <h4>Graphe revenu generer des voyages/jour:</h4>
                                <div id="graphe_revenuvoyages" class="c3" style="max-height: 350px; position: relative;"></div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
@include('template.footer')
