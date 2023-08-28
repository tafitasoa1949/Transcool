@include('template.header')
@include('template.sidebar')
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Ajouter voyage</h2>
                                <form action="{{ url('/ajouterVoyage') }}" method="GET" class="needs-validation">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label id="top" for="validationCustom01">Vehicule</label>
                                            <select name="idbus" id="idbus" class="form-control" required>
                                                <option value="">Choisissez un ...</option>
                                                @foreach ($listBus as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label id="top" for="validationCustom01">Chauffeur</label>
                                            <select name="idchauffeur" id="idchauffeur" class="form-control" required>
                                                <option value="">Choisissez un ...</option>
                                                @foreach ($listChauffeur as $row)
                                                    <option value="{{ $row->idmembre }}">{{ $row->prenom }} {{ $row->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                            <label id="top" for="validationCustom01">Depart</label>
                                            <select name="idvilledepart" id="idvilledepart" class="form-control" required>
                                                <option value="">Choisisser un ...</option>
                                                @foreach ($listVille as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                            <label id="top" for="validationCustom01">Arrivée</label>
                                            <select name="idvillearrive" id="idvillearrive" class="form-control" required>
                                                <option value="">Choisisser un ...</option>
                                                @foreach ($listVille as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label id="top" for="validationCustom01">Date de depart</label>
                                            <input type="datetime-local" name="datedepart" class="form-control" id="validationCustom01" step="any">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label id="top" for="validationCustom01">Date d'arrivée</label>
                                            <input type="datetime-local" name="datearrive" class="form-control" id="validationCustom01">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label id="top" for="validationCustom01">Prix</label>
                                            <input type="text" name="prix" class="form-control" id="validationCustom01">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <button id="top" class="btn btn-primary" type="submit">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <h2 class="text-muted">Liste voyages</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Vehicule</th>
                                            <th>Chauffeur</th>
                                            <th>Type</th>
                                            <th>Ville de depart</th>
                                            <th>Ville d'arrivée</th>
                                            <th>Date de depart</th>
                                            <th>Date d'arrivée</th>
                                            <th>Prix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $indice)
                                            <tr>
                                                <td>{{ $indice->vehicule }}</td>
                                                <td>{{ $indice->chauffeur }}</td>
                                                <td>{{ $indice->type }}</td>
                                                <td>{{ $indice->depart }}</td>
                                                <td>{{ $indice->arrive }}</td>
                                                <td>{{ $indice->datedepart }}</td>
                                                <td>{{ $indice->datearrive }}</td>
                                                <td>{{ $indice->prix }}</td>
                                                <td><a href="{{ url('supprimerVoyage/'.$indice->id) }}" class="btn btn-danger">Supprimer</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datepicker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: new Date().toISOString().slice(0, 16)
        });
    });
</script>

